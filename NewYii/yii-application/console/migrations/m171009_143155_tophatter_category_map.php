<?php

use yii\db\Migration;
use console\components\TableExists;

class m171009_143155_tophatter_category_map extends Migration
{
    public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m171009_143155_tophatter_category_map cannot be reverted.\n";

        return false;
    }

    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        {
            $tableOptions = null;
            if ($this->db->driverName === 'mysql') {
                // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
                $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
            }
            if (!TableExists::tableExists('{{%tophatter_category_map}}')) {

                $this->createTable('{{%tophatter_category_map}}', [
                    'id' => $this->primaryKey(),
                    'merchant_id'=>$this->integer()->notNull(),
                    'shopify_product_type'=>$this->string(),
                    'tophatter_category'=>$this->string(),
                ], $tableOptions);
                $this->addForeignKey('FKmerchant-category', 'tophatter_category_map', 'merchant_id', 'merchant_db', 'merchant_id', 'CASCADE');

            } else {
                echo "already exist";
            }

        }

    }

    public function down()
    {

        if (TableExists::tableExists('{{%tophatter_category_map}}'))
        {
            $this->dropTable('{{%tophatter_category_map}}');
        }
        else
        {
            echo "There is no such table exists";
        }


    }

}

