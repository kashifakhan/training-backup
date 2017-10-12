<?php

use yii\db\Migration;
use console\components\TableExists;

class m171009_133923_pricefalls_configuration_setting extends Migration
{
    public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m171009_133923_pricefalls_configuration_setting cannot be reverted.\n";

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
        if (!TableExists::tableExists('{{%pricefalls_configuration_setting}}')) {

            $this->createTable('{{%pricefalls_configuration_setting}}', [
                'id' => $this->primaryKey(),
                'merchant_id' => $this->integer()->notNull(),
                //  $this->addForeignKey('fk-merchant-merchant_id', 'merchant', 'merchant_id', 'merchant_db', 'merchant_id','CASCADE','CASCADE'),
                'config_path' => $this->string()->notNull(),
                'value' => $this->string()->notNull(),

            ], $tableOptions);
            $this->addForeignKey('fk-pricefalls_configuration_setting-merchant_id', 'pricefalls_configuration_setting', 'merchant_id', 'merchant_db', 'merchant_id', 'CASCADE');

        } else {
            echo "already exist";
        }
    }

    public function down()
    {
        /*echo "m171009_093402_merchant cannot be reverted.\n";

        return false;*/

        if (TableExists::tableExists('{{%pricefalls_configuration_setting}}'))
        {
            $this->dropTable('{{%pricefalls_configuration_setting}}');
        }
        else
        {
            echo "There is no such table exists";
        }
    }

}
