<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\MemberPrice
 *
 * @property int $price_id
 * @property int $goods_id
 * @property int $user_rank
 * @property string $user_price
 * @method static Builder|MemberPrice newModelQuery()
 * @method static Builder|MemberPrice newQuery()
 * @method static Builder|MemberPrice query()
 * @method static Builder|MemberPrice whereGoodsId($value)
 * @method static Builder|MemberPrice wherePriceId($value)
 * @method static Builder|MemberPrice whereUserPrice($value)
 * @method static Builder|MemberPrice whereUserRank($value)
 * @mixin Eloquent
 */
class MemberPrice extends Model
{
    protected $table = 'ecs_member_price';

    protected $primaryKey = 'price_id';

    public $timestamps = false;

    /**
     * @param int $goods_id
     * @return array
     */
    public function get_member_price(int $goods_id=0): array
    {
        return MemberPrice::where('goods_id',$goods_id)->get()->toArray();
    }
}
