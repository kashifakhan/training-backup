<?php

use yii\db\Migration;
use console\components\TableExists;

class m171010_065200_pridefalls_orders extends Migration
{
    public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m171010_065200_pridefalls_orders cannot be reverted.\n";

        return false;
    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

        if(!TableExists::tableExists('pricefalls_orders'))
        {
            $tableOptions = null;
            if ($this->db->driverName === 'mysql') {
                // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
                $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
            }

            $this->createTable('{{%pricefalls_orders}}', [
                'id' => $this->primaryKey(),
                'merchant_id' => $this->integer()->notNull(),
                'pricefalls_order_id' => $this->integer()->unique(),
                'shopify_order_id' => $this->integer()->notNull()->unique(),
                'shopify_order_name' =>$this->text()->notNull(),
                'order_status' =>$this->string()->notNull(),
                'order_real_status'=>$this->string(),
                'SKU' =>$this->string()->notNull(),
                'order_data' =>$this->text()->notNull(),
                'created_at' =>$this->dateTime()->notNull(),
                'updated_at' => $this->dateTime()->notNull(),
            ], $tableOptions);

            $this->addForeignKey('fk-pricefalls_orders-merchant_id',
                'pricefalls_orders',
                'merchant_id',
                'merchant_db',
                'merchant_id',
                'CASCADE',
                'CASCADE');


        }
        else
        {
            echo "table already exists";
        }
    }

    public function down()
    {
        if (TableExists::tableExists('pricefalls_orders'))
        {
            $this->dropTable('{{%pricefalls_orders}}');
        }
        else
        {
            echo "There is no such table exists";
        }
    }

}
