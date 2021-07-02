<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


/**
 * 购物车
 * Class Cart
 *
 * @package App\Models
 * @property int $rec_id
 * @property int $user_id
 * @property string $session_id
 * @property int $goods_id
 * @property string $goods_sn
 * @property int $product_id
 * @property string $goods_name
 * @property string $market_price
 * @property string $goods_price
 * @property string $split_money
 * @property int $goods_number
 * @property string $goods_attr
 * @property int $is_real
 * @property string $extension_code
 * @property int $parent_id
 * @property int $rec_type
 * @property int $is_gift
 * @property int $is_shipping
 * @property int $can_handsel
 * @property string $goods_attr_id
 * @property int $add_time
 * @property string $package_attr_id
 * @property string $cost_price
 * @property string $promote_price
 * @property string $exclusive 手机专享价格
 * @method static Builder|Cart newModelQuery()
 * @method static Builder|Cart newQuery()
 * @method static Builder|Cart query()
 * @method static Builder|Cart whereAddTime($value)
 * @method static Builder|Cart whereCanHandsel($value)
 * @method static Builder|Cart whereCostPrice($value)
 * @method static Builder|Cart whereExclusive($value)
 * @method static Builder|Cart whereExtensionCode($value)
 * @method static Builder|Cart whereGoodsAttr($value)
 * @method static Builder|Cart whereGoodsAttrId($value)
 * @method static Builder|Cart whereGoodsId($value)
 * @method static Builder|Cart whereGoodsName($value)
 * @method static Builder|Cart whereGoodsNumber($value)
 * @method static Builder|Cart whereGoodsPrice($value)
 * @method static Builder|Cart whereGoodsSn($value)
 * @method static Builder|Cart whereIsGift($value)
 * @method static Builder|Cart whereIsReal($value)
 * @method static Builder|Cart whereIsShipping($value)
 * @method static Builder|Cart whereMarketPrice($value)
 * @method static Builder|Cart wherePackageAttrId($value)
 * @method static Builder|Cart whereParentId($value)
 * @method static Builder|Cart whereProductId($value)
 * @method static Builder|Cart wherePromotePrice($value)
 * @method static Builder|Cart whereRecId($value)
 * @method static Builder|Cart whereRecType($value)
 * @method static Builder|Cart whereSessionId($value)
 * @method static Builder|Cart whereSplitMoney($value)
 * @method static Builder|Cart whereUserId($value)
 * @mixin Eloquent
 */
class Cart extends Model
{
    protected $table = 'ecs_cart';

    protected $primaryKey = 'rec_id';

    public $timestamps = false;


    /**
     * @param int $user_id
     * @return \Illuminate\Support\Collection
     */
    public function get_cart(int $user_id = 0): \Illuminate\Support\Collection
    {
        $where = array();

        $where['ecs_cart.user_id'] = $user_id;

        $where['ecs_cart.is_real'] = 1;

        $where['ecs_cart.is_shipping'] = 1;

        return DB::table('ecs_cart')
            ->where($where)
            ->join('ecs_goods', 'ecs_cart.goods_id', '=', 'ecs_goods.goods_id')
            ->select('ecs_cart.rec_id','ecs_cart.goods_number', 'ecs_goods.goods_id', 'ecs_goods.goods_name', 'ecs_goods.shop_price', 'ecs_goods.goods_img')
            ->get();
    }


}
