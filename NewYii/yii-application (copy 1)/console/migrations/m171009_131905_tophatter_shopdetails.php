<?php

use yii\db\Migration;
use console\components\TableExists;

class m171009_131905_tophatter_shopdetails extends Migration
{
    public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m171009_131905_tophatter_shopdetails cannot be reverted.\n";

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
        if (!TableExists::tableExists('{{%tophatter_shopdetails}}')) {

            $this->createTable('{{%tophatter_shopdetails}}', [
                'id' => $this->primaryKey(),
                'merchant_id'=>$this->integer()->notNull(),
                'token' => $this->string(),
                'install_status'=>$this->integer()->defaultValue('0'),
                'install_date'=>$this->dateTime()->notNull(),
                'uninstall_dates' => $this->dateTime(),
                'purchase_status' => $this->integer(),
                'expire_date'=>$this->dateTime(),
                'created_at'=>$this->dateTime(),
                'updated_at'=>$this->dateTime(),
            ], $tableOptions);
            $this->addForeignKey('FKmerchant', 'tophatter_shopdetails', 'merchant_id', 'merchant_db', 'merchant_id', 'CASCADE');

        } else {
            echo "already exist";
        }

    }

    public function down()
    {

        if (TableExists::tableExists('{{%tophatter_shopdetails}}'))
        {
            $this->dropTable('{{%tophatter_shopdetails}}');
        }
        else
        {
            echo "There is no such table exists";
        }


    }

}
