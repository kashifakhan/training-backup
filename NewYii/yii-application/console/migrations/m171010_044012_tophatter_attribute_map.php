<?php

use yii\db\Migration;
use console\components\TableExists;

class m171010_044012_tophatter_attribute_map extends Migration
{
    public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m171010_044012_tophatter_attribute_map cannot be reverted.\n";

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
           // var_dump(TableExists::getTable());die;
            if (!TableExists::tableExists('{{%tophatter_attribute_map}}')) {
               // die("jjjcvf");
                $this->createTable('{{%tophatter_attribute_map}}', [
                    'id' => $this->primaryKey(),
                    'merchant_id'=>$this->integer()->notNull(),
                    'shopify_product_type'=>$this->string(),
                    'attribut_value_type'=>$this->string(),
                    'tophatter_attribute_code'=>$this->string(),
                    'attribute_value'=>$this->string(),
                ], $tableOptions);
                $this->addForeignKey('FKmerchant-attribute', 'tophatter_attribute_map', 'merchant_id', 'merchant_db', 'merchant_id', 'CASCADE');

            } else {
                echo "already exist";
            }

        }
    }

    public function down()
    {
        if (TableExists::tableExists('{{%tophatter_attribute_map}}'))
        {
            $this->dropTable('{{%tophatter_attribute_map}}');
        }
        else
        {
            echo "There is no such table exists";
        }
    }
    
}
