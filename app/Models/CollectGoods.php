<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CollectGoods extends Model
{
    protected $table = 'ecs_collect_goods';

    protected $primaryKey = 'rec_id';

    public $timestamps = false;

    private $goods;

    public function __construct(Goods $goods)
    {
        parent::__construct();

        $this->goods = $goods;
    }


    /**
     * @param int $user_id
     * @return array
     */
    public function get_collect_goods(int $user_id = 0): array
    {
        $where = array();

        $where['ecs_collect_goods.user_id'] = $user_id;

        $where['ecs_collect_goods.is_attention'] = 1;

        $goods_list = Db::table('ecs_collect_goods')
            ->where($where)
            ->join('ecs_goods','ecs_collect_goods.goods_id', '=', 'ecs_goods.goods_id')
            ->select('ecs_collect_goods.rec_id', 'ecs_goods.goods_id', 'ecs_goods.goods_name', 'ecs_goods.shop_price', 'ecs_goods.goods_img')
            ->get()
            ->toArray();

        return $this->goods->get_price($goods_list);
    }
}
