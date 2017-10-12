<?php

use yii\db\Migration;
use console\components\TableExists;

class m171010_065102_pridefalls_product_variants extends Migration
{
    public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m171010_065102_pridefalls_product_variants cannot be reverted.\n";

        return false;
    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {


        if(!TableExists::tableExists('pricefalls_product_variants'))
        {
            $tableOptions = null;
            if ($this->db->driverName === 'mysql') {
                // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
                $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
            }

            $this->createTable('{{%pricefalls_product_variants}}', [
                'id' => $this->primaryKey(),
                'merchant_id' => $this->integer()->notNull(),
                'product_id' => $this->integer()->notNull(),
                'variant_id' => $this->integer()->notNull(),
                'title' =>$this->text()->notNull(),
                'description' =>$this->text()->notNull(),
                'price' =>$this->string()->notNull(),
                'status' =>$this->string()->notNull(),
                'attribute_options' =>$this->text()->notNull(),
                'weight' =>$this->decimal(10,2),
                'weight_unit' =>$this->string()->notNull(),
                'barcode' =>$this->bigInteger(13)->notNull(),
                'image' => $this->text()->notNull(),
                'created_at' =>$this->dateTime()->notNull(),
                'updated_at' => $this->dateTime()->notNull(),
            ], $tableOptions);

            $this->addForeignKey('fk-pricefalls_product_variants-merchant_id',
                'pricefalls_product_variants',
                'merchant_id',
                'merchant_db',
                'merchant_id',
                'CASCADE',
                'CASCADE');
            $this->addForeignKey('fk-pricefalls_product_variants-product_id',
                'pricefalls_product_variants',
                'product_id',
                'products',
                'product_id',
                'CASCADE',
                'CASCADE');
            $this->addForeignKey('fk-pricefalls_product_variants-variant_id',
                'pricefalls_product_variants',
                'variant_id',
                'product_variants',
                'variant_id',
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
        if (TableExists::tableExists('pricefalls_product_variants'))
        {
            $this->dropTable('{{%pricefalls_product_variants}}');
        }
        else
        {
            echo "There is no such table exists";
        }
    }
}
