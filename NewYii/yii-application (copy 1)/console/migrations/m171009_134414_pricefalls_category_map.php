<?php

use yii\db\Migration;
use console\components\TableExists;

class m171009_134414_pricefalls_category_map extends Migration
{
    public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m171009_134414_pricefalls_category_map cannot be reverted.\n";

        return false;
    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        if(!TableExists::tableExists('pricefalls_category_map'))
        {
            $tableOptions = null;
            if ($this->db->driverName === 'mysql') {
                // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
                $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
            }

            $this->createTable('{{%pricefalls_category_map}}', [
                'id' => $this->primaryKey(),
                'merchant_id' => $this->integer()->notNull(),
                'token' => $this->string()->notNull(),
                'shopify_product_type' =>$this->string()->notNull(),
                'pricefalls_category' =>$this->string()->notNull(),

            ], $tableOptions);

            $this->addForeignKey('fk-pricefalls_category_map-merchant_id', 'pricefalls_category_map', 'merchant_id', 'merchant_db', 'merchant_id', 'CASCADE', 'CASCADE');


        }
        else
        {
            echo "table already exists";
        }
    }

    public function down()
    {
        if (TableExists::tableExists('{{%pricefalls_category_map}}'))
        {
            $this->dropTable('{{%pricefalls_category_map}}');
        }
        else
        {
            echo "There is no such table exists";
        }
    }

}
