<?php
/**
 * Created by PhpStorm.
 * User: cedcoss
 * Date: 10/10/17
 * Time: 3:02 PM
 */

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\web\IdentityInterface;
use yii\base\NotSupportedException;

/**
 * Merchant model
 *
 * @property integer $id
 * @property string $merchant_id
 * @property string $shopurl
 * @property string $shopname
 * @property string $owner_name
 * @property string $email
 * @property string $currency
 * @property string $shop_json
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class Merchant extends ActiveRecord implements IdentityInterface
{
    public $manager = null;

    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;

    public static function tableName()
    {
        return '{{%merchant}}';
    }
    /*
        public function behaviors()
        {
            return [
                TimestampBehavior::className(),
            ];
        }*/

    public function rules()
    {
        return [
            [['merchant_id', 'shopurl', 'shopname','owner_name','email','currency'], 'required'],
            [['shop_json'],'text'],
            [['merchant_id'], 'integer'],
            [['shopurl', 'shopname','owner_name', 'email'], 'string', 'max' => 200],
            [['currency'], 'string', 'max' => 50],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
        ];
    }


    /**
     * @param int|string $id
     * @return static
     */
    public static function findIdentity($id)
    {
        $session = Yii::$app->getSession();

        $managerLoginIndex = 'manager_login_'.$id;
        $data = $session->get($managerLoginIndex);
        if ($data)
        {
            $merchant = static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
            //$user->manager = true;

            return $merchant;
        }
        else
        {
            return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
        }
    }


    /**
     * @param mixed $token
     * @param null $type
     * @throws NotSupportedException
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }


    /**
     * @param $ownername
     * @return static
     */
    public static function findByUsername($ownername)
    {
        return static::findOne(['owner_name' => $ownername, 'status' => self::STATUS_ACTIVE]);
    }


    /**
     * @param string $authKey
     */
    public function validateAuthKey($authKey)
    {
        //return $this->getAuthKey() === $authKey;
        return;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        //return $this->auth_key;
        return;
    }


}