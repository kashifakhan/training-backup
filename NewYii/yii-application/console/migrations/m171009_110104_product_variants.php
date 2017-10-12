<?php

use yii\db\Migration;
use console\components\TableExists;


class m171009_110104_product_variants extends Migration
{
    public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m171009_110104_product_variants cannot be reverted.\n";

        return false;
    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
if(!TableExists::tableExists('product_variants'))
        {
            $tableOptions = null;
            if ($this->db->driverName === 'mysql') {
                // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
                $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
            }

            $this->createTable('{{%product_variants}}', [
                'variant_id' => $this->primaryKey(),
                'product_id' => $this->integer()->notNull(),
                'title' => $this->text(),
                'merchant_id' => $this->integer()->notNull(),
                'SKU' => $this->string()->notNull(),
                'price'=>$this->decimal(10,2),
                'position'=>$this->integer()->notNull(),
                'inventory'=>$this->integer()->notNull(),
                'barcode'=>$this->bigInteger(11)->notNull(),
                'image'=>$this->string(),
                'inventory_policy'=>$this->string()->notNull(),
                'weight'=>$this->decimal(),
                'weight_unit'=>$this->string()->notNull(),
                'created_at'=>$this->dateTime(),
                'updated_at'=>$this->dateTime(),
            ], $tableOptions);
            $this->addForeignKey(
                'fk-product_variants-merchant_id',
                'product_variants',
                'merchant_id',
                'merchant_db',
                'merchant_id',
                'CASCADE'
            );

            $this->addForeignKey(
                'fk-product_variants-product_id',
                'product_variants',
                'product_id',
                'products',
                'product_id',
                'CASCADE'
            );

        }
        else
        {
            echo "table already exists";
        }
    }

    public function down()
    {
        if (TableExists::tableExists('{{%product_variants}}'))
        {
            $this->dropTable('{{%product_variants}}');
        }
        else
        {
            echo "There is no such table exists";
        }
    }
}
