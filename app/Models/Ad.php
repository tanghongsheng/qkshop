<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

//广告

/**
 * App\Models\Ad
 *
 * @property int $ad_id
 * @property int $position_id
 * @property int $media_type
 * @property string $ad_name
 * @property string $ad_link
 * @property string $ad_code
 * @property int $start_time
 * @property int $end_time
 * @property string $link_man
 * @property string $link_email
 * @property string $link_phone
 * @property int $click_count
 * @property int $enabled
 * @method static Builder|Ad newModelQuery()
 * @method static Builder|Ad newQuery()
 * @method static Builder|Ad query()
 * @method static Builder|Ad whereAdCode($value)
 * @method static Builder|Ad whereAdId($value)
 * @method static Builder|Ad whereAdLink($value)
 * @method static Builder|Ad whereAdName($value)
 * @method static Builder|Ad whereClickCount($value)
 * @method static Builder|Ad whereEnabled($value)
 * @method static Builder|Ad whereEndTime($value)
 * @method static Builder|Ad whereLinkEmail($value)
 * @method static Builder|Ad whereLinkMan($value)
 * @method static Builder|Ad whereLinkPhone($value)
 * @method static Builder|Ad whereMediaType($value)
 * @method static Builder|Ad wherePositionId($value)
 * @method static Builder|Ad whereStartTime($value)
 * @mixin Eloquent
 */
class Ad extends Model
{
    protected $table = "ecs_ad";      //定义数据表

    protected $primaryKey = "ad_id";       //定义主键

    public $timestamps = false;
    /**
     * 首页轮播图
     * @param null $id
     * @return mixed
     */
    public function banner_index($id = null)
    {
        return Cache::remember('banner',604800,function () use ($id) {

            return $this->where('position_id',$id)->get();

        });

    }
}
