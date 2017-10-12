<?php

use yii\db\Migration;
use console\components\TableExists;

class m171009_120946_product_options extends Migration
{
    public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m171009_120946_product_options cannot be reverted.\n";

        return false;
    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        if(!TableExists::tableExists('product_options'))
        {
            $tableOptions = null;
            if ($this->db->driverName === 'mysql') {
                // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
                $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
            }

            $this->createTable('{{%product_options}}', [
                'id' => $this->primaryKey(),
                'product_id' => $this->integer()->notNull(),
                'title' => $this->text(),
                'variant_id' => $this->integer()->notNull(),
                'option_name' => $this->string()->notNull(),
                'option_value'=>$this->decimal(10,2),

            ], $tableOptions);
            $this->addForeignKey(
                'fk-product_options-merchant_id',
                'product_options',
                'product_id',
                'products',
                'product_id',
                'CASCADE'
            );

            $this->addForeignKey(
                'fk-product_options-product_id',
                'product_options',
                'variant_id',
                'product_variants',
                'variant_id',
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
        if (TableExists::tableExists('{{%product_options}}'))
        {
            $this->dropTable('{{%product_options}}');
        }
        else
        {
            echo "There is no such table exists";
        }
    }

}
