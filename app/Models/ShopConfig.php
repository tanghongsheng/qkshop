<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ShopConfig
 *
 * @property int $id
 * @property int $parent_id
 * @property string $code
 * @property string $type
 * @property string $store_range
 * @property string $store_dir
 * @property string $value
 * @property int $sort_order
 * @method static Builder|ShopConfig newModelQuery()
 * @method static Builder|ShopConfig newQuery()
 * @method static Builder|ShopConfig query()
 * @method static Builder|ShopConfig whereCode($value)
 * @method static Builder|ShopConfig whereId($value)
 * @method static Builder|ShopConfig whereParentId($value)
 * @method static Builder|ShopConfig whereSortOrder($value)
 * @method static Builder|ShopConfig whereStoreDir($value)
 * @method static Builder|ShopConfig whereStoreRange($value)
 * @method static Builder|ShopConfig whereType($value)
 * @method static Builder|ShopConfig whereValue($value)
 * @mixin Eloquent
 */
class ShopConfig extends Model
{
    protected $table = 'ecs_shop_config';

    public $timestamps = false;

    /**
     * 获取头部配置
     * @return array
     */
    public function get_shop_header_config(): array
    {

        $config = array();

        $shop_config_list = $this::where('parent_id',1)->get();

        foreach ($shop_config_list as $k => $v)
        {
            $config[$v['code']] = $v['value'];
        }

        return $config;

    }

    /**
     * 获取底部配置
     */
    public function get_shop_footer_config(): array
    {
        $config = array();

        $shop_config_list = $this::where('parent_id',2)->get();

        foreach ($shop_config_list as $k => $v)
        {
            $config[$v['code']] = $v['value'];
        }

        return $config;
    }


    /**
     * 登录成功后获取购物车信息
     */
    public function get_cart()
    {

    }


    /**
     * 登录成功后获取会员等级,拉取会员折扣价
     */
    public function get_user_level()
    {

    }


    /**
     * 获取会员身份,判定是否可以购物
     */
    public function get_user_identity()
    {

    }







}
