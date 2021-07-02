<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


/**
 * App\Models\Goods
 *
 * @property int $goods_id
 * @property int $cat_id
 * @property string $goods_sn
 * @property string $goods_name
 * @property string $goods_name_style
 * @property int $click_count
 * @property int $brand_id
 * @property string $provider_name
 * @property int $goods_number
 * @property string $goods_weight
 * @property string $market_price
 * @property string $shop_price
 * @property string $promote_price
 * @property int $promote_start_date
 * @property int $promote_end_date
 * @property int $is_buy
 * @property int $buymax
 * @property int $buymax_start_date
 * @property int $buymax_end_date
 * @property int $warn_number
 * @property string $keywords
 * @property string $goods_brief
 * @property string $goods_desc
 * @property string $goods_thumb
 * @property string $goods_img
 * @property string $original_img
 * @property int $is_real
 * @property string $extension_code
 * @property int $is_on_sale
 * @property int $is_alone_sale
 * @property int $is_shipping
 * @property int $integral
 * @property int $add_time
 * @property int $sort_order
 * @property int $is_delete
 * @property int $is_best
 * @property int $is_new
 * @property int $is_hot
 * @property int $is_promote
 * @property string $zhekou
 * @property int $bonus_type_id
 * @property int $last_update
 * @property int $goods_type
 * @property string $seller_note
 * @property int $give_integral
 * @property int $rank_integral
 * @property int|null $suppliers_id
 * @property int $supplier_id
 * @property int $supplier_status
 * @property string $supplier_status_txt
 * @property int|null $is_check
 * @property int $is_catindex
 * @property string $cost_price
 * @property int|null $valid_date
 * @property int $is_virtual
 * @property string $exclusive 手机专享价格
 * @property int $ghost_count
 * @method static Builder|Goods newModelQuery()
 * @method static Builder|Goods newQuery()
 * @method static Builder|Goods query()
 * @method static Builder|Goods whereAddTime($value)
 * @method static Builder|Goods whereBonusTypeId($value)
 * @method static Builder|Goods whereBrandId($value)
 * @method static Builder|Goods whereBuymax($value)
 * @method static Builder|Goods whereBuymaxEndDate($value)
 * @method static Builder|Goods whereBuymaxStartDate($value)
 * @method static Builder|Goods whereCatId($value)
 * @method static Builder|Goods whereClickCount($value)
 * @method static Builder|Goods whereCostPrice($value)
 * @method static Builder|Goods whereExclusive($value)
 * @method static Builder|Goods whereExtensionCode($value)
 * @method static Builder|Goods whereGhostCount($value)
 * @method static Builder|Goods whereGiveIntegral($value)
 * @method static Builder|Goods whereGoodsBrief($value)
 * @method static Builder|Goods whereGoodsDesc($value)
 * @method static Builder|Goods whereGoodsId($value)
 * @method static Builder|Goods whereGoodsImg($value)
 * @method static Builder|Goods whereGoodsName($value)
 * @method static Builder|Goods whereGoodsNameStyle($value)
 * @method static Builder|Goods whereGoodsNumber($value)
 * @method static Builder|Goods whereGoodsSn($value)
 * @method static Builder|Goods whereGoodsThumb($value)
 * @method static Builder|Goods whereGoodsType($value)
 * @method static Builder|Goods whereGoodsWeight($value)
 * @method static Builder|Goods whereIntegral($value)
 * @method static Builder|Goods whereIsAloneSale($value)
 * @method static Builder|Goods whereIsBest($value)
 * @method static Builder|Goods whereIsBuy($value)
 * @method static Builder|Goods whereIsCatindex($value)
 * @method static Builder|Goods whereIsCheck($value)
 * @method static Builder|Goods whereIsDelete($value)
 * @method static Builder|Goods whereIsHot($value)
 * @method static Builder|Goods whereIsNew($value)
 * @method static Builder|Goods whereIsOnSale($value)
 * @method static Builder|Goods whereIsPromote($value)
 * @method static Builder|Goods whereIsReal($value)
 * @method static Builder|Goods whereIsShipping($value)
 * @method static Builder|Goods whereIsVirtual($value)
 * @method static Builder|Goods whereKeywords($value)
 * @method static Builder|Goods whereLastUpdate($value)
 * @method static Builder|Goods whereMarketPrice($value)
 * @method static Builder|Goods whereOriginalImg($value)
 * @method static Builder|Goods wherePromoteEndDate($value)
 * @method static Builder|Goods wherePromotePrice($value)
 * @method static Builder|Goods wherePromoteStartDate($value)
 * @method static Builder|Goods whereProviderName($value)
 * @method static Builder|Goods whereRankIntegral($value)
 * @method static Builder|Goods whereSellerNote($value)
 * @method static Builder|Goods whereShopPrice($value)
 * @method static Builder|Goods whereSortOrder($value)
 * @method static Builder|Goods whereSupplierId($value)
 * @method static Builder|Goods whereSupplierStatus($value)
 * @method static Builder|Goods whereSupplierStatusTxt($value)
 * @method static Builder|Goods whereSuppliersId($value)
 * @method static Builder|Goods whereValidDate($value)
 * @method static Builder|Goods whereWarnNumber($value)
 * @method static Builder|Goods whereZhekou($value)
 * @mixin Eloquent
 * @property-read Category $category
 * @property-read Supplier|null $supplier
 */
class Goods extends Model
{
    protected $table = 'ecs_goods';

    protected $primaryKey = 'goods_id';

    public $timestamps = false;

    private $request;


    public function __construct(Request $request)
    {
        parent::__construct();

        $this->request = $request;
    }

    /**
     * @return array
     * 获取分类楼层推荐商品,每个大分类为八个
     */
    public function get_floor_goods(): array
    {

        $category = new Category();

        $where = array();

        $where['is_on_sale'] = 1;

        $where['is_best'] = 1;

        $category_key = $category->get_category_children();

        $category_list = array();

        foreach ($category_key as $k => $v)
        {
            $goods_list = Db::table('ecs_goods')
                ->whereIn('cat_id',$v)
                ->where($where)
                ->limit(8)
                ->join('ecs_supplier','ecs_goods.supplier_id','=','ecs_supplier.supplier_id')
                ->select('ecs_goods.goods_id','ecs_goods.shop_price','ecs_goods.goods_name','ecs_goods.goods_img','ecs_goods.supplier_id','ecs_supplier.company_name')
                ->get()
                ->toArray();

            $goods_list = $this->get_price($goods_list);

            $category_list[$k] = $goods_list;
        }

        return $category_list;

    }

    //获取推荐商品
    public function get_recommend_goods(): array
    {
        $recommend_goods = array();

        $where = array();

        $name = 'is_best';

        $where['is_on_sale'] = 1;

        //查询三个推荐商品,分别是 is_best is_new is_hot
        for ($i=0; $i < 3; $i++)
        {
            if ($i == 0){
                $name = 'is_best';
            }

            if ($i ==1){
                $name = 'is_new';
            }

            if ($i ==2){
                $name = 'is_hot';
            }

            $where[$name] = 1;

            $goods_list = Db::table('ecs_goods')
                ->where($where)
                ->limit(5)
                ->join('ecs_supplier','ecs_goods.supplier_id','=','ecs_supplier.supplier_id')
                ->select('ecs_goods.goods_id','ecs_goods.shop_price','ecs_goods.goods_name','ecs_goods.goods_img','ecs_goods.supplier_id','ecs_supplier.company_name')
                ->get()
                ->toArray();

            $goods_list = $this->get_price($goods_list);

            $recommend_goods[$name] = $goods_list;
        }

        return $recommend_goods;
    }


    /**
     * 获取会员等级价格
     * @param array $goods_list
     * @return array
     */
    public function get_price(array $goods_list): array
    {
        $memberPrice = new MemberPrice();

        if ($this->request->session()->has('user')&&$this->request->session()->get('user.user_rank')>0) {

            $user_rank = $this->request->session()->get('user.user_rank');

            foreach ($goods_list as $k => $v)
            {

                $goods_id = !empty($v->goods_id)?$v->goods_id:$v['goods_id'];

                $price_list = $memberPrice->get_member_price($goods_id);

                if (is_array($price_list)){

                    foreach ($price_list as $k1 => $v1)
                    {
                        if ($v1['user_rank'] == $user_rank){

                            $goods_list[$k]->shop_price = $v1['user_price'];

                        }

                    }
                }

            }

        }
        return $goods_list;
    }

}
