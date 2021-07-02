<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use App\Models\Brand;
use App\Models\Cart;
use App\Models\Category;
use App\Models\CollectGoods;
use App\Models\Goods;
use App\Models\Nav;
use App\Models\ShopConfig;
use App\Models\Users;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class IndexController extends Controller
{

    protected $res = array();
    /**
     * @param Nav $nav
     * @param Category $category
     * @param Ad $ad
     * @param Goods $goods
     * @param Brand $brand
     * @return JsonResponse
     */
    public function index(Nav $nav,Category $category,Ad $ad, Goods $goods,Brand $brand): JsonResponse
    {
        $res =(object) array();

        $res->nav_list = $nav->get_nav();

        //获取分类列表
        $res->category_list = $category->get_category_list();

        //获取轮播图列表
        $res->banner_list = $ad->banner_index(65);

        //获取推荐商品列表
        $res->recommend_goods = $goods->get_recommend_goods();

        //获取推荐品牌
        $res->recommend_brand = $brand->recommend_brand();

        //获取楼层名称 以及分类楼层推荐的商品
        $floor = $category->get_floor();

        //获取楼层商品列表
        $floor_recommend_goods = $goods->get_floor_goods();

        $floor_list = array();

        foreach ($floor as $k => $v){
            $floor_list[$k]['cat_id'] = $v['cat_id'];
            $floor_list[$k]['cat_name'] = $v['cat_name'];
            $floor_list[$k]['goods_list'] = $floor_recommend_goods[$k+1];
        }

        $res->floor_goods = $floor_list;

        //获取分类列表
        return response()->json($res);

    }

    /**
     * 头部数据
     * @param ShopConfig $shopConfig
     * @return JsonResponse
     */
    public function header(ShopConfig $shopConfig): JsonResponse
    {
        $res =(object) array();

        //获取商品配置
        $res->shop_config = $shopConfig->get_shop_header_config();

        //获取分类列表
        return response()->json($res);

    }

    /**
     * 尾部数据
     * @param ShopConfig $shopConfig
     * @return JsonResponse
     */
    public function footer(ShopConfig $shopConfig): JsonResponse
    {
        $res =(object) array();

        //获取商品配置
        $res->shop_config = $shopConfig->get_shop_footer_config();

        //获取分类列表
        return response()->json($res);

    }


    /**
     * 获取侧边栏信息
     * 用户信息
     * 购物车信息
     * 关注的店铺
     * 收藏的商品
     */
    public function get_sidebar(Request $request, Cart $cart, CollectGoods $collectGoods): JsonResponse
    {

        //获取会员名称 和会员级别
        $this->res['user_name'] = $request->session()->get('user.user_name');

        $this->res['user_rank'] = $request->session()->get('user.user_rank');

        //获取购物车信息

        $this->res['cart_list'] = $cart->get_cart($request->session()->get('user.user_id'));

        //获取收藏的商品
        $this->res['collect_list'] = $collectGoods->get_collect_goods($request->session()->get('user.user_id'));

        return response()->json($this->res);

    }


}
