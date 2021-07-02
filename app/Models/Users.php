<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Users
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Users newModelQuery()
 * @method static Builder|Users newQuery()
 * @method static Builder|Users query()
 * @method static Builder|Users whereCreatedAt($value)
 * @method static Builder|Users whereEmail($value)
 * @method static Builder|Users whereEmailVerifiedAt($value)
 * @method static Builder|Users whereId($value)
 * @method static Builder|Users whereName($value)
 * @method static Builder|Users wherePassword($value)
 * @method static Builder|Users whereRememberToken($value)
 * @method static Builder|Users whereUpdatedAt($value)
 * @mixin Eloquent
 * @property int $user_id
 * @property string $aite_id
 * @property string $user_name
 * @property int $is_surplus_open 是否开启余额支付密码功能
 * @property string $surplus_password 余额支付密码
 * @property string $question
 * @property string $answer
 * @property int $sex
 * @property string $birthday
 * @property string $user_money
 * @property string $frozen_money
 * @property int $pay_points
 * @property int $rank_points
 * @property int $address_id
 * @property int $reg_time
 * @property int $last_login
 * @property string $last_time
 * @property string $last_ip
 * @property int $visit_count
 * @property int $user_rank
 * @property int $is_special
 * @property string|null $ec_salt
 * @property string $salt
 * @property int $parent_id
 * @property int $flag
 * @property string $alias
 * @property string $msn
 * @property string $qq
 * @property string $office_phone
 * @property string $home_phone
 * @property string $mobile_phone
 * @property int $is_validated
 * @property int $validated
 * @property string $credit_line
 * @property string|null $passwd_question
 * @property string|null $passwd_answer
 * @property int $is_fenxiao
 * @property string $real_name
 * @property string $card
 * @property string $face_card
 * @property string $back_card
 * @property int $country
 * @property int $province
 * @property int $city
 * @property int $district
 * @property string $address
 * @property int $status
 * @property string $mediaUID
 * @property int $mediaID
 * @property string $froms pc:电脑,mobile:手机,app:应用
 * @property string $headimg
 * @method static Builder|Users whereAddress($value)
 * @method static Builder|Users whereAddressId($value)
 * @method static Builder|Users whereAiteId($value)
 * @method static Builder|Users whereAlias($value)
 * @method static Builder|Users whereAnswer($value)
 * @method static Builder|Users whereBackCard($value)
 * @method static Builder|Users whereBirthday($value)
 * @method static Builder|Users whereCard($value)
 * @method static Builder|Users whereCity($value)
 * @method static Builder|Users whereCountry($value)
 * @method static Builder|Users whereCreditLine($value)
 * @method static Builder|Users whereDistrict($value)
 * @method static Builder|Users whereEcSalt($value)
 * @method static Builder|Users whereFaceCard($value)
 * @method static Builder|Users whereFlag($value)
 * @method static Builder|Users whereFroms($value)
 * @method static Builder|Users whereFrozenMoney($value)
 * @method static Builder|Users whereHeadimg($value)
 * @method static Builder|Users whereHomePhone($value)
 * @method static Builder|Users whereIsFenxiao($value)
 * @method static Builder|Users whereIsSpecial($value)
 * @method static Builder|Users whereIsSurplusOpen($value)
 * @method static Builder|Users whereIsValidated($value)
 * @method static Builder|Users whereLastIp($value)
 * @method static Builder|Users whereLastLogin($value)
 * @method static Builder|Users whereLastTime($value)
 * @method static Builder|Users whereMediaID($value)
 * @method static Builder|Users whereMediaUID($value)
 * @method static Builder|Users whereMobilePhone($value)
 * @method static Builder|Users whereMsn($value)
 * @method static Builder|Users whereOfficePhone($value)
 * @method static Builder|Users whereParentId($value)
 * @method static Builder|Users wherePasswdAnswer($value)
 * @method static Builder|Users wherePasswdQuestion($value)
 * @method static Builder|Users wherePayPoints($value)
 * @method static Builder|Users whereProvince($value)
 * @method static Builder|Users whereQq($value)
 * @method static Builder|Users whereQuestion($value)
 * @method static Builder|Users whereRankPoints($value)
 * @method static Builder|Users whereRealName($value)
 * @method static Builder|Users whereRegTime($value)
 * @method static Builder|Users whereSalt($value)
 * @method static Builder|Users whereSex($value)
 * @method static Builder|Users whereStatus($value)
 * @method static Builder|Users whereSurplusPassword($value)
 * @method static Builder|Users whereUserId($value)
 * @method static Builder|Users whereUserMoney($value)
 * @method static Builder|Users whereUserName($value)
 * @method static Builder|Users whereUserRank($value)
 * @method static Builder|Users whereValidated($value)
 * @method static Builder|Users whereVisitCount($value)
 */
class Users extends Model
{
    protected $table = 'ecs_users';

    protected $primaryKey = 'user_id';

    public $timestamps = false;

    protected $fillable = [
        'user_name',
        'email',
        'password',
        'birthday',
        'aite_id',
        'surplus_password',
        'last_time',
        'sex',
        'pay_points',
        'rank_points',
        'address_id',
        'reg_time',
        'last_login',
        'visit_count',
        'user_rank',
        'is_special',
        'flag',
        'is_validated',
        'credit_line',
        'alias',
        'msn',
        'qq',
        'office_phone',
        'mobile_phone',
        'validated',
        'is_fenxiao',
        'real_name',
        'card',
        'face_card',
        'back_card',
        'home_phone',
        'province',
        'city',
        'district',
        'address',
        'status',
        'mediaID',
        'mediaUID',
        'headimg',
        'country',
    ];


    /**
     * 获取会员信息
     */
    public function user_info($user_id = 0)
    {
        return Users::where('use_id',$user_id)->get(['user_name']);
    }





}
