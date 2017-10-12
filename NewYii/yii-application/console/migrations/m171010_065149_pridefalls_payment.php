<?php

use yii\db\Migration;
use console\components\TableExists;

class m171010_065149_pridefalls_payment extends Migration
{
    public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m171010_065149_pridefalls_payment cannot be reverted.\n";

        return false;
    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

        if(!TableExists::tableExists('pricefalls_payment'))
        {
            $tableOptions = null;
            if ($this->db->driverName === 'mysql') {
                // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
                $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
            }

            $this->createTable('{{%pricefalls_payment}}', [
                'id' => $this->primaryKey(),
                'merchant_id' => $this->integer()->notNull(),
                'plan_type' => $this->string()->notNull(),
                'status' =>$this->string()->notNull(),
                'payment_data' =>$this->text()->notNull(),
                'order_data' =>$this->text()->notNull(),
                'billing_on' =>$this->dateTime()->notNull(),
                'archived_on' => $this->dateTime()->notNull(),
            ], $tableOptions);

            $this->addForeignKey('fk-pricefalls_payment-merchant_id',
                'pricefalls_payment',
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
        if (TableExists::tableExists('pricefalls_payment'))
        {
            $this->dropTable('{{%pricefalls_payment}}');
        }
        else
        {
            echo "There is no such table exists";
        }
    }

}