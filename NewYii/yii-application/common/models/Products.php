<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "products".
 *
 * @property integer $product_id
 * @property integer $merchant_id
 * @property string $title
 * @property integer $inventory
 * @property string $vendor
 * @property string $description
 * @property string $product_type
 * @property string $handle
 * @property string $type
 * @property string $images
 * @property string $created_at
 * @property string $updated_at
 *
 * @property PricefallsProductVariants[] $pricefallsProductVariants
 * @property PricefallsProducts[] $pricefallsProducts
 * @property ProductOptions[] $productOptions
 * @property ProductVariants[] $productVariants
 * @property MerchantDb $merchant
 */
class Products extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('dbpf');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['merchant_id', 'title', 'inventory', 'vendor', 'description', 'product_type', 'handle', 'type', 'images'], 'required'],
            [['merchant_id', 'inventory'], 'integer'],
            [['title', 'description', 'images'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['vendor', 'product_type', 'handle', 'type'], 'string', 'max' => 255],
            [['merchant_id'], 'exist', 'skipOnError' => true, 'targetClass' => MerchantDb::className(), 'targetAttribute' => ['merchant_id' => 'merchant_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'product_id' => 'Product ID',
            'merchant_id' => 'Merchant ID',
            'title' => 'Title',
            'inventory' => 'Inventory',
            'vendor' => 'Vendor',
            'description' => 'Description',
            'product_type' => 'Product Type',
            'handle' => 'Handle',
            'type' => 'Type',
            'images' => 'Images',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPricefallsProductVariants()
    {
        return $this->hasMany(PricefallsProductVariants::className(), ['product_id' => 'product_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPricefallsProducts()
    {
        return $this->hasMany(PricefallsProducts::className(), ['product_id' => 'product_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductOptions()
    {
        return $this->hasMany(ProductOptions::className(), ['product_id' => 'product_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductVariants()
    {
        return $this->hasMany(ProductVariants::className(), ['product_id' => 'product_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMerchant()
    {
        return $this->hasOne(MerchantDb::className(), ['merchant_id' => 'merchant_id']);
    }
}
