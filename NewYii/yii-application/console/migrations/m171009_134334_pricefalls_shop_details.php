<?php

use yii\db\Migration;
use console\components\TableExists;

class m171009_134334_pricefalls_shop_details extends Migration
{
    public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m171009_134334_pricefalls_shop_details cannot be reverted.\n";

        return false;
    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        if(!TableExists::tableExists('pricefalls_shop_details'))
        {
            $tableOptions = null;
            if ($this->db->driverName === 'mysql') {
                // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
                $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
            }

            $this->createTable('{{%pricefalls_shop_details}}', [
                'id' => $this->primaryKey(),
                'merchant_id' => $this->integer()->notNull(),
                'token' => $this->string()->notNull(),
                'install_status' =>$this->string()->notNull(),
                'install_date' =>$this->date()->notNull(),
                'uninstall_date' => $this->date()->notNull(),
                'uninstall_status' =>$this->string()->notNull(),
                'expire_date' => $this->date()->notNull(),
                'purchase_status'=>$this->string(),
                'created_at' =>$this->dateTime()->notNull(),
                'updated_at' => $this->dateTime()->notNull(),
            ], $tableOptions);

            $this->addForeignKey('fk-pricefalls_shop_details-merchant_id', 'pricefalls_shop_details', 'merchant_id', 'merchant_db', 'merchant_id', 'CASCADE', 'CASCADE');


        }
        else
        {
            echo "table already exists";
        }
    }

    public function down()
    {
        if (TableExists::tableExists('{{%pricefalls_shop_details}}'))
        {
            $this->dropTable('{{%pricefalls_shop_details}}');
        }
        else
        {
            echo "There is no such table exists";
        }
    }

}
