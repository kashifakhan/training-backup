<?php

use yii\db\Migration;
use console\components\TableExists;

class m171009_134439_pricefalls_attribute_map extends Migration
{
    public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m171009_134439_pricefalls_attribute_map cannot be reverted.\n";

        return false;
    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        if(!TableExists::tableExists('pricefalls_attribute_map'))
        {
            $tableOptions = null;
            if ($this->db->driverName === 'mysql') {
                // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
                $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
            }

            $this->createTable('{{%pricefalls_attribute_map}}', [
                'id' => $this->primaryKey(),
                'merchant_id' => $this->integer()->notNull(),
                'token' => $this->string()->notNull(),
                'shopify_attribute_code' =>$this->string()->notNull(),
                'attribute_value_type' =>$this->string()->notNull(),
                'attribute_value' =>$this->string()->notNull(),

            ], $tableOptions);

            $this->addForeignKey('fk-pricefalls_attribute_map-merchant_id', 'pricefalls_attribute_map', 'merchant_id', 'merchant_db', 'merchant_id', 'CASCADE', 'CASCADE');


        }
        else
        {
            echo "table already exists";
        }
    }

    public function down()
    {
        if (TableExists::tableExists('{{%pricefalls_attribute_map}}'))
        {
            $this->dropTable('{{%pricefalls_attribute_map}}');
        }
        else
        {
            echo "There is no such table exists";
        }
    }

}
