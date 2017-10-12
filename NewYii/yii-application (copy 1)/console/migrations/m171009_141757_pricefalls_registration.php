<?php

use yii\db\Migration;
use console\components\TableExists;

class m171009_141757_pricefalls_registration extends Migration
{
    public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m171009_141757_pricefalls_registration cannot be reverted.\n";

        return false;
    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        if (!TableExists::tableExists('{{%pricefalls_registration}}')) {

            $this->createTable('{{%pricefalls_registration}}', [
                'id' => $this->primaryKey(),
                'merchant_id' => $this->integer()->notNull(),
                //  $this->addForeignKey('fk-merchant-merchant_id', 'merchant', 'merchant_id', 'merchant_db', 'merchant_id','CASCADE','CASCADE'),
                'agreement' => $this->string()->notNull(),
                'reference' => $this->string()->notNull(),
                'other_reference' => $this->string()->notNull(),
                'shipping_source' => $this->string()->notNull(),
                'other_shipping_source' => $this->string()->notNull(),

                'created_at' => $this->dateTime()->notNull(),


            ], $tableOptions);
            $this->addForeignKey('fk-pricefalls_registration-merchant_id', 'pricefalls_registration', 'merchant_id', 'merchant_db', 'merchant_id', 'CASCADE', 'CASCADE');

        } else {
            echo "already exist";
        }

    }

    public function down()
    {
       /* echo "m171009_141757_pricefalls_registration cannot be reverted.\n";

        return false;*/
        if (TableExists::tableExists('{{%pricefalls_registration}}'))
        {
            $this->dropTable('{{%pricefalls_registration}}');
        }
        else
        {
            echo "There is no such table exists";
        }
    }

}
