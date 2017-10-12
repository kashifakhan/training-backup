<?php

use yii\db\Migration;
use console\components\TableExists;
use yii\db\Schema;

class m171009_110043_products extends Migration
{
    public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m171009_110043_products cannot be reverted.\n";

        return false;
    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        if(!TableExists::tableExists('products'))
        {
            $tableOptions = null;
            if ($this->db->driverName === 'mysql') {
                // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
                $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
            }

            $this->createTable('{{%products}}', [
                'product_id' => $this->primaryKey(),
                'merchant_id' => $this->integer()->notNull(),
                'title' => $this->text()->notNull(),
                'inventory'=>$this->integer()->notNull(),
                'vendor' =>$this->string()->notNull(),
                'description' =>$this->text()->notNull(),
                'product_type' => $this->string()->notNull(),
                'handle' =>$this->string()->notNull(),
                'type' => $this->string()->notNull(),
                'images' => $this->text()->notNull(),
                'created_at' =>$this->dateTime()->notNull(),
                'updated_at' => $this->dateTime()->notNull(),
            ], $tableOptions);

            $this->addForeignKey('fk-products-merchant_id', 'products', 'merchant_id', 'merchant_db', 'merchant_id', 'CASCADE', 'CASCADE');


        }
        else
        {
            echo "table already exists";
        }
    }

    public function down()
    {
        if (TableExists::tableExists('{{%products}}'))
        {
            $this->dropTable('{{%products}}');
        }
        else
        {
            echo "There is no such table exists";
        }
    }

}
