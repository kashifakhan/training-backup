<?php

namespace frontend\modules\walmart\models;

use Yii;

/**
 * This is the model class for table "walmart_registration".
 *
 * @property integer $id
 * @property integer $merchant_id
 * @property string $fname
 * @property string $lname
 * @property string $legal_company_name
 * @property string $store_name
 * @property string $mobile
 * @property string $email
 * @property string $annual_revenue
 * @property string $website
 * @property string $shipping_source
 * @property string $other_shipping_source
 * @property integer $product_count
 * @property string $company_address
 * @property string $country
 * @property string $have_valid_tax
 * @property string $usa_warehouse
 * @property string $products_type_or_category
 * @property string $selling_on_walmart
 * @property string $selling_on_walmart_source
 * @property string $other_selling_source
 * @property string $contact_to_walmart
 * @property string $approved_by_walmart
 * @property string $reference
 * @property string $other_reference
 * @property string $agreement
 */
class WalmartRegistration extends \yii\db\ActiveRecord
{
   // public $custom_sku;
    public $time_format;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'walmart_registration';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

            [['merchant_id', 'fname', 'lname','mobile', 'email', 'shipping_source','agreement','time_zone','time_slot','time_format'], 'required'],
            [['merchant_id'], 'integer'],
            [[ 'other_reference'], 'string'],
            [['fname', 'lname', 'legal_company_name', 'store_name', 'email', 'website', 'amazon_seller_url', 'shipping_source', 'other_shipping_source', 'products_type_or_category', 'other_selling_source', 'reference'], 'string', 'max' => 255],
            [[ 'agreement'], 'string', 'max' => 10],
            [['time_zone'], 'string', 'max'=>30],
            [['mobile'], 'number','message' => '"{value}" is invalid {attribute}. Only Numbers are allowed.'],
            [['merchant_id'], 'unique'],
            [['email'],'email','message'=>'Please enter a valid {attribute}.'],
            [['website'], 'url'],
            ['agreement', 'required', 'requiredValue' => 1, 'message' => 'You must agree to the terms and conditions.'],
            ['other_reference', 'required', 'message' => 'This field cannot be blank.', 'when' => function ($model) {
                return $model->reference == 'Other';
            }, 'whenClient' => "function (attribute, value) {
                    return $('#walmartregistration-reference').val() == 'Other';
            }"],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'merchant_id' => 'Merchant ID',
            'fname' => 'First Name',
            'lname' => 'Last Name',
            'mobile' => 'Mobile',
            'email' => 'Email',
            'time_zone' => 'Your Primary Time Zone',
            'time_slot' => 'Your Preffered Time Slot',
            'shipping_source' => 'Shipping Source',
            'other_shipping_source' => 'Other Shipping Source',
            'reference' => 'How did you hear about us?',
            'other_reference' => 'Other Reference',
            'agreement' => 'Agreement',
        ];
    }
}
