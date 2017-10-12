<?php

namespace frontend\modules\pricefalls\models;

use Yii;

/**
 * This is the model class for table "pricefalls".
 *
 * @property integer $id
 * @property string $shopname
 * @property string $api_key
 * @property string $api_secret
 * @property string $token
 */
class Pricefalls extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pricefalls';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['shopname', 'api_key', 'api_secret', 'token'], 'required'],
            [['shopname', 'api_key', 'api_secret', 'token'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'shopname' => 'Shopname',
            'api_key' => 'Api Key',
            'api_secret' => 'Api Secret',
            'token' => 'Token',
        ];
    }
}
