<?php

use yii\db\Migration;
use console\components\TableExists;

class m171009_093402_merchant extends Migration
{
    public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m171009_093402_merchant cannot be reverted.\n";

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
        if (!TableExists::tableExists('{{%merchant}}')) {

            $this->createTable('{{%merchant}}', [
                'id' => $this->primaryKey(),
                'merchant_id' => $this->integer()->unique(),
                //  $this->addForeignKey('fk-merchant-merchant_id', 'merchant', 'merchant_id', 'merchant_db', 'merchant_id','CASCADE','CASCADE'),
                'shopurl' => $this->string()->notNull(),
                'shopname' => $this->string()->notNull(),
                'owner_name' => $this->string()->notNull(),
                'email' => $this->string()->unique(),
                'currency' => $this->string()->notNull(),
                'shop_json' => $this->text(),


                'status' => $this->smallInteger()->notNull()->defaultValue(1),
                'created_at' => $this->dateTime()->notNull(),
                'updated_at' => $this->dateTime()->notNull(),

            ], $tableOptions);
            $this->addForeignKey('fk-merchant-merchant_id', 'merchant', 'merchant_id', 'merchant_db', 'merchant_id', 'CASCADE', 'CASCADE');

        } else {
            echo "already exist";
        }

    }

    public function down()
    {
        /*echo "m171009_093402_merchant cannot be reverted.\n";

        return false;*/

        if (TableExists::tableExists('{{%merchant}}'))
        {
            $this->dropTable('{{%merchant}}');
        }
        else
        {
            echo "There is no such table exists";
        }
    }

}
