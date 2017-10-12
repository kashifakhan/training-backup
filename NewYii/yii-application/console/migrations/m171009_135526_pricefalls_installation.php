<?php

use yii\db\Migration;
use console\components\TableExists;

class m171009_135526_pricefalls_installation extends Migration
{
    public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m171009_135526_pricefalls_installation cannot be reverted.\n";

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
        if (!TableExists::tableExists('{{%pricefalls_installation}}')) {

            $this->createTable('{{%pricefalls_installation}}', [
                'id' => $this->primaryKey(),
                'merchant_id' => $this->integer()->notNull(),
                //  $this->addForeignKey('fk-merchant-merchant_id', 'merchant', 'merchant_id', 'merchant_db', 'merchant_id','CASCADE','CASCADE'),
                'status' => $this->string()->notNull(),
                'step' => $this->integer()->notNull(),

            ], $tableOptions);
            $this->addForeignKey('fk-pricefalls_installation-merchant_id', 'pricefalls_installation', 'merchant_id', 'merchant_db', 'merchant_id', 'CASCADE');

        } else {
            echo "already exist";
        }
    }

    public function down()
    {
        if (TableExists::tableExists('{{%pricefalls_installation}}'))
        {
            $this->dropTable('{{%pricefalls_installation}}');
        }
        else
        {
            echo "There is no such table exists";
        }
    }

}
