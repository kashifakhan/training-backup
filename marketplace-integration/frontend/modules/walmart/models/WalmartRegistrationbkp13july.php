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

            [['merchant_id', 'fname', 'lname','mobile', 'email', 'annual_revenue', 'shipping_source','country','selling_on_walmart', 'reference', 'agreement'], 'required'],
            [['merchant_id', 'product_count'], 'integer'],
            [['company_address', 'other_reference'], 'string'],
            [['fname', 'lname', 'legal_company_name', 'store_name', 'email', 'website', 'amazon_seller_url', 'shipping_source', 'other_shipping_source', 'products_type_or_category', 'other_selling_source', 'reference'], 'string', 'max' => 255],
            //[['mobile'], 'string', 'max' => 15],
            [['annual_revenue', 'position_in_company'], 'string', 'max' => 200],
            [['country', 'selling_on_walmart_source'], 'string', 'max' => 50],
            [['have_valid_tax', 'usa_warehouse', 'selling_on_walmart', 'contact_to_walmart', 'approved_by_walmart', 'agreement'], 'string', 'max' => 10],
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
            ['have_valid_tax', 'required', 'message' => 'This field cannot be blank.', 'when' => function ($model) {
                return $model->country == 'Other';
            }, 'whenClient' => "function (attribute, value) {
                    return $('#walmartregistration-country').val() === 'Other';
            }"],
            ['usa_warehouse', 'required', 'message' => 'This field cannot be blank.', 'when' => function ($model) {
                return $model->country == 'Other';
            }, 'whenClient' => "function (attribute, value) {
                    return $('#walmartregistration-country').val() === 'Other';
            }"],
            ['selling_on_walmart_source', 'required', 'message' => 'This field cannot be blank.', 'when' => function ($model) {
                return $model->selling_on_walmart == 'yes';
            }, 'whenClient' => "function (attribute, value) {
                    return $('#walmartregistration-selling_on_walmart').val() === 'yes';
            }"],
            ['other_selling_source', 'required', 'message' => 'This field cannot be blank.', 'when' => function ($model) {
                return $model->selling_on_walmart_source == 'yes';
            }, 'whenClient' => "function (attribute, value) {
                    return $('#walmartregistration-selling_on_walmart_source').val() === 'yes';
            }"],
            ['contact_to_walmart', 'required', 'message' => 'This field cannot be blank.', 'when' => function ($model) {
                return $model->selling_on_walmart == 'no';
            }, 'whenClient' => "function (attribute, value) {
                    return $('#walmartregistration-selling_on_walmart').val() === 'no';
            }"],
            ['approved_by_walmart', 'required', 'message' => 'This field cannot be blank.', 'when' => function ($model) {
                return $model->selling_on_walmart == 'no';
            }, 'whenClient' => "function (attribute, value) {
                    return $('#walmartregistration-selling_on_walmart').val() === 'no';
            }"],
            ['other_selling_source', 'required', 'message' => 'This field cannot be blank.', 'when' => function ($model) {
                return $model->selling_on_walmart_source == 'other';
            }, 'whenClient' => "function (attribute, value) {
                    return $('#walmartregistration-selling_on_walmart_source').val() === 'other';
            }"]
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
            'legal_company_name' => 'Legal Company Name',
            'store_name' => 'DBA Seller Store Name',
            'mobile' => 'Mobile',
            'email' => 'Email',
            'annual_revenue' => 'Annual Revenue',
            'website' => 'Website',
            'amazon_seller_url' => 'Amazon Seller Url',
            'position_in_company' => 'Job Title/Position in Company',
            'time_zone' => 'Your Primary Time Zone',
            'shipping_source' => 'Shipping Source',
            'other_shipping_source' => 'Other Shipping Source',
            'product_count' => 'Estimated No of Sku\'s',
            'company_address' => 'Company Address',
            'country' => 'Country',
            'have_valid_tax' => 'Do you have a Valid Tax Id and W9 Form?',
            'usa_warehouse' => 'Do you have a warehouse in USA?',
            'products_type_or_category' => 'Products Type Or Category',
            'selling_on_walmart' => 'Are you already selling on WalMart Marketplace?',
            'selling_on_walmart_source' => 'How do you integrate with WalMart Marketplace?',
            'other_selling_source' => 'Other Selling Source',
            'contact_to_walmart' => 'Have you contacted WalMart Marketplace before?',
            'approved_by_walmart' => 'Have you been approved by WalMart to sell on the Marketplace?',
            'reference' => 'How did you hear about us?',
            'other_reference' => 'Other Reference',
            'agreement' => 'Agreement',
           /* 'custom_sku'=>'Custom Sku',*/
        ];
    }
}
