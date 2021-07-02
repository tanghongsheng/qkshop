<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Cache;


/**
 * Class Category
 *
 * @property int $cat_id
 * @property string $cat_name
 * @property string $keywords
 * @property string $cat_desc
 * @property int $parent_id
 * @property int $sort_order
 * @property string $template_file
 * @property string $measure_unit
 * @property int $show_in_nav
 * @property string $style
 * @property int $is_show
 * @property int $grade
 * @property string $filter_attr
 * @property int $category_index
 * @property int $category_index_dwt
 * @property string|null $index_dwt_file
 * @property int $show_in_index
 * @property string $cat_index_rightad
 * @property string $cat_adimg_1
 * @property string $cat_adurl_1
 * @property string $cat_adimg_2
 * @property string $cat_adurl_2
 * @property string $cat_nameimg
 * @property string $brand_qq
 * @property string $attr_wwwecshop68com
 * @property string $path_name
 * @property int $is_virtual
 * @property int $show_goods_num
 * @property int|null $level 等级
 * @property string $type_img 微信商城分类图标
 * @method static Builder|Category newModelQuery()
 * @method static Builder|Category newQuery()
 * @method static Builder|Category query()
 * @method static Builder|Category whereAttrWwwecshop68com($value)
 * @method static Builder|Category whereBrandQq($value)
 * @method static Builder|Category whereCatAdimg1($value)
 * @method static Builder|Category whereCatAdimg2($value)
 * @method static Builder|Category whereCatAdurl1($value)
 * @method static Builder|Category whereCatAdurl2($value)
 * @method static Builder|Category whereCatDesc($value)
 * @method static Builder|Category whereCatId($value)
 * @method static Builder|Category whereCatIndexRightad($value)
 * @method static Builder|Category whereCatName($value)
 * @method static Builder|Category whereCatNameimg($value)
 * @method static Builder|Category whereCategoryIndex($value)
 * @method static Builder|Category whereCategoryIndexDwt($value)
 * @method static Builder|Category whereFilterAttr($value)
 * @method static Builder|Category whereGrade($value)
 * @method static Builder|Category whereIndexDwtFile($value)
 * @method static Builder|Category whereIsShow($value)
 * @method static Builder|Category whereIsVirtual($value)
 * @method static Builder|Category whereKeywords($value)
 * @method static Builder|Category whereLevel($value)
 * @method static Builder|Category whereMeasureUnit($value)
 * @method static Builder|Category whereParentId($value)
 * @method static Builder|Category wherePathName($value)
 * @method static Builder|Category whereShowGoodsNum($value)
 * @method static Builder|Category whereShowInIndex($value)
 * @method static Builder|Category whereShowInNav($value)
 * @method static Builder|Category whereSortOrder($value)
 * @method static Builder|Category whereStyle($value)
 * @method static Builder|Category whereTemplateFile($value)
 * @method static Builder|Category whereTypeImg($value)
 * @mixin Eloquent
 * @property-read Collection|Goods[] $goods
 * @property-read int|null $goods_count
 */
class Category extends Model
{
    protected $table = "ecs_category";      //定义数据表

    protected $primaryKey = "cat_id";       //定义主键

    public $timestamps = false;

    /**
     * @return array
     */
    public function get_category_list(): array
    {
        $where = array();

        $where['level'] = 1;

        $where['is_show'] = 1;

        $res = array();

        if (!Cache::has('category')){

            $category1 = $this->where($where)
                ->orderBy('sort_order')
                ->get(['cat_id','cat_name','parent_id','level'])
                ->toArray();

            foreach ($category1 as $k1 => $v1)
            {
                //第一级
                $res[$k1]['current'] = $v1;

                $where1['parent_id'] = $v1['cat_id'];

                //获取二级
                $category2 = $this->where($where1)
                    ->orderBy('sort_order')
                    ->get(['cat_id','cat_name','parent_id','level'])
                    ->toArray();

                foreach ($category2 as $k2 => $v2)
                {
                    $res[$k1]['children'][$k2]['current'] = $v2;

                    $where2['parent_id'] = $v2['cat_id'];

                    //获取三级
                    $category3 = $this->where($where2)
                        ->orderBy('sort_order')
                        ->get(['cat_id','cat_name','parent_id','level'])
                        ->toArray();

                    foreach ($category3 as $k3 => $v3)
                    {
                        $res[$k1]['children'][$k2]['children'][$k3]['current'] = $v3;

                        $where3['parent_id'] = $v2['cat_id'];

                        $res[$k1]['children'][$k2]['children'][$k3]['children'] = [];

                    }

                }

            }

            Cache::put('category',$res,604800);

        }else{

            $res = Cache::get('category');

        }

        return $res;

    }

    /**
     * @return mixed
     * 获取楼层
     */
    public function get_floor()
    {
        $floor = Cache::remember('floor', 604800, function () {

            $where = array();

            $where['level'] = 1;

            $where['is_show'] = 1;

            return $this::where($where)
                ->orderBy('sort_order')
                ->get(['cat_id','cat_name'])
                ->toArray();
        });

        return $floor;


    }

    /**
     *获取分类的子级分类合集
     */
    public function get_category_children(): array
    {
        $category1 = $this->get_floor();


        $category = array();

        foreach ($category1 as $v1)
        {
            $z = 0;

            $category[$v1['cat_id']][$z] = $v1['cat_id'];

            $z = $z+1;

            //获取二级
           $category2 = $this::where('parent_id',$v1['cat_id'])->get('cat_id')->toArray();

           foreach ($category2 as $v2){

               $category[$v1['cat_id']][$z] = $v2['cat_id'];

               $category3 = $this::where('parent_id',$v2['cat_id'])->get('cat_id')->toArray();

               foreach($category3 as $v3)
               {

                   $category[$v1['cat_id']][$z] = $v3['cat_id'];

                   $z++;

               }

               $z ++;

           }

        }

        return $category;

    }


}
