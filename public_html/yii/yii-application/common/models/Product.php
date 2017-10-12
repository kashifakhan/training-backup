<?php
class Product
{

    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;

    public static function tableName()
    {
        return '{{%product}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
        ];
    }

    public static function findIdentity($product_id)
    {
        return static::findOne(['product_id' => $product_id, 'status' => self::STATUS_ACTIVE]);
    }

    public static function findByProductrname($product_name)
    {
        return static::findOne(['product_name' => $product_name, 'status' => self::STATUS_ACTIVE]);
    }
    public function getId()
    {
        return $this->getPrimaryKey();
    }
}
?>