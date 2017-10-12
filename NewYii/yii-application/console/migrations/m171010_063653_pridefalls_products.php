<?php

use yii\db\Migration;
use console\components\TableExists;

class m171010_063653_pridefalls_products extends Migration
{
    public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m171010_063653_pridefalls_products cannot be reverted.\n";

        return false;
    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        if(!TableExists::tableExists('pricefalls_products'))
        {
            $tableOptions = null;
            if ($this->db->driverName === 'mysql') {
                // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
                $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
            }

            $this->createTable('{{%pricefalls_products}}', [
                'id' => $this->primaryKey(),
                'merchant_id' => $this->integer()->notNull(),
                'product_id' => $this->integer()->notNull(),
                'title' =>$this->text()->notNull(),
                'inventory'=>$this->integer(),
                'description' =>$this->text()->notNull(),
                'images' => $this->text()->notNull(),
                'created_at' =>$this->dateTime()->notNull(),
                'updated_at' => $this->dateTime()->notNull(),
            ], $tableOptions);

            $this->addForeignKey('fk-pricefalls_products-merchant_id', 'pricefalls_products', 'merchant_id', 'merchant_db', 'merchant_id', 'CASCADE', 'CASCADE');
            $this->addForeignKey('fk-pricefalls_products-product_id', 'pricefalls_products', 'product_id', 'products', 'product_id', 'CASCADE', 'CASCADE');

        }
        else
        {
            echo "table already exists";
        }
    }

    public function down()
    {
        if (TableExists::tableExists('pricefalls_products'))
        {
            $this->dropTable('{{%pricefalls_products}}');
        }
        else
        {
            echo "There is no such table exists";
        }
    }

}
