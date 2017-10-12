<?php

namespace frontend\modules\pricefalls\models;

use Yii;
use common\models\MerchantDb;
use common\models\Products;


/**
 * This is the model class for table "pricefalls_products".
 *
 * @property integer $id
 * @property integer $merchant_id
 * @property integer $product_id
 * @property string $title
 * @property integer $inventory
 * @property string $description
 * @property string $images
 * @property string $created_at
 * @property string $updated_at
 *
 * @property MerchantDb $merchant
 * @property Products $product
 */
class PricefallsProducts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pricefalls_products';
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
            [['merchant_id', 'product_id', 'title', 'inventory', 'description', 'images'], 'required'],
            [['merchant_id', 'product_id', 'inventory'], 'integer'],
            [['title', 'description', 'images'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['merchant_id'], 'exist', 'skipOnError' => true, 'targetClass' => MerchantDb::className(), 'targetAttribute' => ['merchant_id' => 'merchant_id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Products::className(), 'targetAttribute' => ['product_id' => 'product_id']],
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
            'title' => 'Title',
            'inventory' => 'Inventory',
            'description' => 'Description',
            'images' => 'Images',
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
}
