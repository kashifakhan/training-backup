<?php

namespace frontend\modules\jet\models;

use Yii;

/**
 * This is the model class for table "jet_test_api".
 *
 * @property integer $id
 * @property integer $merchant_id
 * @property string $user
 * @property string $secret
 * @property string $merchant
 * @property string $fulfillment_node
 * @property integer $contact_number
 * @property string $skype_id
 *
 * @property User $merchant0
 */
class JetTestApi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jet_test_api';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['merchant_id', 'user', 'secret', 'merchant', 'fulfillment_node'], 'required'],
            [['merchant_id', 'contact_number'], 'integer'],
            [['user', 'secret', 'merchant', 'fulfillment_node'], 'string', 'max' => 255],
            [['skype_id'], 'string', 'max' => 100]
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
            'user' => 'User',
            'secret' => 'Secret',
            'merchant' => 'Merchant',
            'fulfillment_node' => 'Fulfillment Node',
            'contact_number' => 'Contact Number',
            'skype_id' => 'Skype ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMerchant0()
    {
        return $this->hasOne(User::className(), ['id' => 'merchant_id']);
    }
}
