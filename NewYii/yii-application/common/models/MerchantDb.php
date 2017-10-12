<?php
/**
 * Created by PhpStorm.
 * User: cedcoss
 * Date: 10/10/17
 * Time: 12:50 PM
 */

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use frontend\ApplicationPricefalls;

class MerchantDb extends ActiveRecord
{
    public static function tableName()
    {
        return 'merchant_db';
    }

    public function rules()
    {
        return [
            [['shop_name', 'db_name','app_name'], 'required'],
            [['shop_name'], 'string', 'max' => 255],
            [['db_name'], 'string', 'max' => 250],
            [['app_name'],'string','max' =>225]
        ];
    }

    public function attributeLabels()
    {
        return [
            'merchant_id' => 'Merchant ID',
            'shop_name' => 'Shop Name',
            'db_name' => 'Db Name',
            'app_name' => 'App Name',
        ];
    }

    public static function getDb()
    {
        $appPricefalls=new ApplicationPricefalls();
        return Yii::$app->get($appPricefalls->getBaseDb());
    }
}