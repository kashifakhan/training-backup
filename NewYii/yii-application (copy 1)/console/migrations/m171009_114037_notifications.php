<?php

use yii\db\Migration;
use console\components\TableExists;

class m171009_114037_notifications extends Migration
{
    public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m171009_114037_notifications cannot be reverted.\n";

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
        if (!TableExists::tableExists('{{%notifications}}')) {

            $this->createTable('{{%notifications}}', [
                'id' => $this->primaryKey(),
                'html_content' => $this->string(),
                'sort_order'=>$this->text(),
                'from_date'=>$this->dateTime()->notNull(),
                'to_date' => $this->dateTime()->notNull(),
                'enable' => $this->integer(),
                'marketplace'=>$this->string(),
                'enable_merchant'=>$this->integer(),
                'seen_clients'=>$this->text(),
            ], $tableOptions);

        } else {
            echo "already exist";
        }

    }

    public function down()
    {
        /*echo "m171009_114037_notifications cannot be reverted.\n";

        return false;*/
        if (TableExists::tableExists('{{%notifications}}'))
        {
            $this->dropTable('{{%notifications}}');
        }
        else
        {
            echo "There is no such table exists";
        }
    }

}
