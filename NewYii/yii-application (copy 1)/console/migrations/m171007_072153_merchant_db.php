<?php

use yii\db\Migration;

class m171007_072153_merchant_db extends Migration
{
    public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m171007_072153_merchant_db cannot be reverted.\n";

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

        $this->createTable('{{%merchant_db}}', [
            'merchant_id' => $this->primaryKey(),
            'shop_name' => $this->string()->notNull(),
            'db_name' => $this->string()->notNull(),
            'app_name' => $this->string()->notNull(),

        ], $tableOptions);
    }

    public function down()
    {
        /*echo "m171007_072153_merchant_db cannot be reverted.\n";

        return false;*/

        $this->dropTable('{{%merchant_db}}');
    }

}
