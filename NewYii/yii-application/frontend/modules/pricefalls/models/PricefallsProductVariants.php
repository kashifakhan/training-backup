<?php

namespace frontend\modules\pricefalls\models;

use Yii;
use common\models\MerchantDb;
use common\models\Products;
use common\models\ProductVariants;

/**
 * This is the model class for table "pricefalls_product_variants".
 *
 * @property integer $id
 * @property integer $merchant_id
 * @property integer $product_id
 * @property integer $variant_id
 * @property string $title
 * @property string $description
 * @property string $price
 * @property string $status
 * @property string $attribute_options
 * @property string $weight
 * @property string $weight_unit
 * @property integer $barcode
 * @property string $image
 * @property string $created_at
 * @property string $updated_at
 *
 * @property MerchantDb $merchant
 * @property Products $product
 * @property ProductVariants $variant
 */
class PricefallsProductVariants extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pricefalls_product_variants';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['merchant_id', 'product_id', 'variant_id', 'title', 'description', 'price', 'status', 'attribute_options', 'weight_unit', 'barcode', 'image'], 'required'],
            [['merchant_id', 'product_id', 'variant_id', 'barcode'], 'integer'],
            [['title', 'description', 'attribute_options', 'image'], 'string'],
            [['weight'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['price', 'status', 'weight_unit'], 'string', 'max' => 255],
            [['merchant_id'], 'exist', 'skipOnError' => true, 'targetClass' => MerchantDb::className(), 'targetAttribute' => ['merchant_id' => 'merchant_id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Products::className(), 'targetAttribute' => ['product_id' => 'product_id']],
//            [['variant_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductVariants::className(), 'targetAttribute' => ['variant_id' => 'variant_id']],
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
            'product_id' => 'Product ID',
            'variant_id' => 'Variant ID',
            'title' => 'Title',
            'description' => 'Description',
            'price' => 'Price',
            'status' => 'Status',
            'attribute_options' => 'Attribute Options',
            'weight' => 'Weight',
            'weight_unit' => 'Weight Unit',
            'barcode' => 'Barcode',
            'image' => 'Image',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMerchant()
    {
        return $this->hasOne(MerchantDb::className(), ['merchant_id' => 'merchant_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Products::className(), ['product_id' => 'product_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVariant()
    {
        return $this->hasOne(ProductVariants::className(), ['variant_id' => 'variant_id']);
    }
}
