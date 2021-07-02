<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\supplier
 *
 * @method static Builder|Supplier newModelQuery()
 * @method static Builder|Supplier newQuery()
 * @method static Builder|Supplier query()
 * @mixin Eloquent
 * @property int $supplier_id
 * @property int $user_id 申请入驻人id
 * @property string $supplier_name 供货商名称
 * @property int $rank_id 店铺等级
 * @property int $type_id 店铺类型
 * @property string $company_name 公司名称
 * @property int $country 公司所在地(国家)
 * @property int $province 公司所在地(省)
 * @property int $city 公司所在地(市)
 * @property int $district 公司所在地(县/区)
 * @property string $address 公司详细地址
 * @property string $tel 公司电话
 * @property string $email 电子邮件
 * @property string $guimo 公司规模
 * @property string $company_type 公司类型
 * @property string $bank
 * @property string $zhizhao 营业执照电子版
 * @property string $contact
 * @property string $id_card
 * @property string $contact_back
 * @property string $contact_shop
 * @property string $contact_yunying
 * @property string $contact_shouhou
 * @property string $contact_caiwu
 * @property string $contact_jishu
 * @property string $system_fee
 * @property string $supplier_bond
 * @property int $supplier_rebate
 * @property int $supplier_rebate_paytime
 * @property string $supplier_remark
 * @property string $nav_list
 * @property int $status 状态
 * @property int $add_time 申请时间
 * @property int $applynum 申请入驻步骤
 * @property string $contacts_name 联系人
 * @property string $contacts_phone 联系人电话
 * @property string $business_licence_number 营业执照号
 * @property string $business_sphere 法定经营范围
 * @property string $organization_code 组织机构代码
 * @property string $organization_code_electronic 组织机构代码证电子版
 * @property string $general_taxpayer 一般纳税人证明
 * @property string $bank_account_name 银行开户名
 * @property string $bank_account_number 公司开户行银行账号
 * @property string $bank_name 开户银行支行名称
 * @property string $bank_code 支行联行号
 * @property string $settlement_bank_account_name 银行开户名(结算)
 * @property string $settlement_bank_account_number 公司银行账号(结算)
 * @property string $settlement_bank_name 开户银行支行名称(结算)
 * @property string $settlement_bank_code 支行联行号(结算)
 * @property string $tax_registration_certificate 税务登记证号
 * @property string $taxpayer_id 纳税人识别号
 * @property string $bank_licence_electronic 开户银行许可证电子版
 * @property string $tax_registration_certificate_electronic 税务登记证号电子版
 * @property string $supplier_money 入驻商的佣金
 * @property string $handheld_idcard 手持身份证照片
 * @property string $idcard_front 身份证证明照片
 * @property string $idcard_reverse 身份证反面照片
 * @property string $id_card_no 身份证号码
 * @property string $latitude
 * @property string $longitude
 * @property int|null $supplier_type 1为厂商 2为经销商 3为大客户
 * @property string|null $promise 承诺书
 * @property float|null $sales_volume 年约销售额
 * @property-read \App\Models\Goods $goods
 * @method static Builder|Supplier whereAddTime($value)
 * @method static Builder|Supplier whereAddress($value)
 * @method static Builder|Supplier whereApplynum($value)
 * @method static Builder|Supplier whereBank($value)
 * @method static Builder|Supplier whereBankAccountName($value)
 * @method static Builder|Supplier whereBankAccountNumber($value)
 * @method static Builder|Supplier whereBankCode($value)
 * @method static Builder|Supplier whereBankLicenceElectronic($value)
 * @method static Builder|Supplier whereBankName($value)
 * @method static Builder|Supplier whereBusinessLicenceNumber($value)
 * @method static Builder|Supplier whereBusinessSphere($value)
 * @method static Builder|Supplier whereCity($value)
 * @method static Builder|Supplier whereCompanyName($value)
 * @method static Builder|Supplier whereCompanyType($value)
 * @method static Builder|Supplier whereContact($value)
 * @method static Builder|Supplier whereContactBack($value)
 * @method static Builder|Supplier whereContactCaiwu($value)
 * @method static Builder|Supplier whereContactJishu($value)
 * @method static Builder|Supplier whereContactShop($value)
 * @method static Builder|Supplier whereContactShouhou($value)
 * @method static Builder|Supplier whereContactYunying($value)
 * @method static Builder|Supplier whereContactsName($value)
 * @method static Builder|Supplier whereContactsPhone($value)
 * @method static Builder|Supplier whereCountry($value)
 * @method static Builder|Supplier whereDistrict($value)
 * @method static Builder|Supplier whereEmail($value)
 * @method static Builder|Supplier whereGeneralTaxpayer($value)
 * @method static Builder|Supplier whereGuimo($value)
 * @method static Builder|Supplier whereHandheldIdcard($value)
 * @method static Builder|Supplier whereIdCard($value)
 * @method static Builder|Supplier whereIdCardNo($value)
 * @method static Builder|Supplier whereIdcardFront($value)
 * @method static Builder|Supplier whereIdcardReverse($value)
 * @method static Builder|Supplier whereLatitude($value)
 * @method static Builder|Supplier whereLongitude($value)
 * @method static Builder|Supplier whereNavList($value)
 * @method static Builder|Supplier whereOrganizationCode($value)
 * @method static Builder|Supplier whereOrganizationCodeElectronic($value)
 * @method static Builder|Supplier wherePromise($value)
 * @method static Builder|Supplier whereProvince($value)
 * @method static Builder|Supplier whereRankId($value)
 * @method static Builder|Supplier whereSalesVolume($value)
 * @method static Builder|Supplier whereSettlementBankAccountName($value)
 * @method static Builder|Supplier whereSettlementBankAccountNumber($value)
 * @method static Builder|Supplier whereSettlementBankCode($value)
 * @method static Builder|Supplier whereSettlementBankName($value)
 * @method static Builder|Supplier whereStatus($value)
 * @method static Builder|Supplier whereSupplierBond($value)
 * @method static Builder|Supplier whereSupplierId($value)
 * @method static Builder|Supplier whereSupplierMoney($value)
 * @method static Builder|Supplier whereSupplierName($value)
 * @method static Builder|Supplier whereSupplierRebate($value)
 * @method static Builder|Supplier whereSupplierRebatePaytime($value)
 * @method static Builder|Supplier whereSupplierRemark($value)
 * @method static Builder|Supplier whereSupplierType($value)
 * @method static Builder|Supplier whereSystemFee($value)
 * @method static Builder|Supplier whereTaxRegistrationCertificate($value)
 * @method static Builder|Supplier whereTaxRegistrationCertificateElectronic($value)
 * @method static Builder|Supplier whereTaxpayerId($value)
 * @method static Builder|Supplier whereTel($value)
 * @method static Builder|Supplier whereTypeId($value)
 * @method static Builder|Supplier whereUserId($value)
 * @method static Builder|Supplier whereZhizhao($value)
 */
class Supplier extends Model
{

    protected $table = 'ecs_supplier';

    protected $primaryKey = 'supplier_id';

    public $timestamps = false;

}
