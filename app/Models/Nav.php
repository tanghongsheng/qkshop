<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;

/**
 * App\Models\Nav
 *
 * @property int $id
 * @property string|null $ctype
 * @property int|null $cid
 * @property string $name
 * @property int $ifshow
 * @property int $vieworder
 * @property int $opennew
 * @property string $url
 * @property string $type
 * @method static Builder|Nav newModelQuery()
 * @method static Builder|Nav newQuery()
 * @method static Builder|Nav query()
 * @method static Builder|Nav whereCid($value)
 * @method static Builder|Nav whereCtype($value)
 * @method static Builder|Nav whereId($value)
 * @method static Builder|Nav whereIfshow($value)
 * @method static Builder|Nav whereName($value)
 * @method static Builder|Nav whereOpennew($value)
 * @method static Builder|Nav whereType($value)
 * @method static Builder|Nav whereUrl($value)
 * @method static Builder|Nav whereVieworder($value)
 * @mixin Eloquent
 */
class Nav extends Model
{

    protected $table = 'ecs_nav';

    public $timestamps = false;


    /**
     * @return array
     */
    public function get_nav(): array
    {
        $where = array();

        $where['ifshow'] = 1;

        $nav_list = array();

        $where['type'] = 'bottom';

        $bottom = Nav::where($where)->get()->toArray();

        $where['type'] = 'middle';

        $middle = Nav::where($where)->get()->toArray();

        $where['type'] = 'top';

        $top = Nav::where($where)->get()->toArray();

        $nav_list['bottom'] = $bottom;

        $nav_list['middle'] = $middle;

        $nav_list['top'] = $top;

        return $nav_list;

    }


}
