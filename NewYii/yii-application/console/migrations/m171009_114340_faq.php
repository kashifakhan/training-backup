<?php

use yii\db\Migration;
use console\components\TableExists;

class m171009_114340_faq extends Migration
{
    public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m171009_114340_faq cannot be reverted.\n";

        return false;
    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        if (!TableExists::tableExists('{{%faq}}')) {

            $this->createTable('{{%faq}}', [
                'id' => $this->primaryKey(),
                'query' => $this->text()->notNull(),
                'description' => $this->text()->notNull(),
                'marketplace' => $this->string()->notNull(),
                'created_at' => $this->dateTime()->notNull(),
                'updated_at' => $this->dateTime()->notNull(),
            ], $tableOptions);
        } else {
            echo "Table already exists";
        }
    }


public function down()
    {
        if (TableExists::tableExists('{{%faq}}'))
        {
            $this->dropTable('{{%faq}}');
        }
        else
        {
            echo "There is no such table exists";
        }
    }


}
