<?php

use yii\db\Migration;
use console\components\TableExists;

class m171009_110600_latest_updates extends Migration
{
    public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m171009_110600_latest_updates cannot be reverted.\n";

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
        if (!TableExists::tableExists('{{%latest_updates}}')) {

            $this->createTable('{{%latest_updates}}', [
                'id' => $this->primaryKey(),
                'title' => $this->string(),
                'description'=>$this->text(),
                'marketplace'=>$this->string(),
                'created_at' => $this->dateTime()->notNull(),
                'updated_at' => $this->dateTime()->notNull(),
            ], $tableOptions);

        } else {
            echo "already exist";
        }

    }

    public function down()
    {

        if (TableExists::tableExists('{{%latest_updates}}'))
        {
            $this->dropTable('{{%latest_updates}}');
        }
        else
        {
            echo "There is no such table exists";
        }
    }

}
