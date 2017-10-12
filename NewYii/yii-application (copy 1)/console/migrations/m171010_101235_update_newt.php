<?php

use yii\db\Migration;

class m171010_101235_update_newt extends Migration
{
    public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m171010_101235_update_newt cannot be reverted.\n";

        return false;
    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->alterColumn( 'product_variants','created_at',$this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'));
        $this->alterColumn( 'product_variants','updated_at',$this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'));

        $this->alterColumn('tophatter_shopdetails','created_at', $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'));
        $this->alterColumn('tophatter_shopdetails','updated_at', $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'));

        $this->alterColumn('pricefalls_shop_details','created_at' ,$this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'));
        $this->alterColumn('pricefalls_shop_details','updated_at', $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'));

        $this->alterColumn('pricefalls_product_variants','created_at', $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'));
        $this->alterColumn('pricefalls_product_variants','updated_at', $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'));

        $this->alterColumn('pricefalls_products','created_at', $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'));
        $this->alterColumn('pricefalls_products','updated_at', $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'));

        $this->alterColumn('pricefalls_payment','billing_on', $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'));
        $this->alterColumn('pricefalls_registration','created_at', $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'));

        $this->alterColumn('merchant','updated_at', $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'));
        $this->alterColumn('merchant','created_at', $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'));

        $this->alterColumn('latest_updates','updated_at', $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'));
        $this->alterColumn('latest_updates','created_at', $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'));


        $this->alterColumn('pricefalls_failed_orders','updated_at', $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'));
        $this->alterColumn('pricefalls_failed_orders','created_at', $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'));


        $this->alterColumn('pricefalls_orders','updated_at', $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'));
        $this->alterColumn('pricefalls_orders','created_at', $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'));


        $this->alterColumn('products','updated_at', $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'));
        $this->alterColumn('products','created_at', $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'));
    }

    public function down()
    {
        echo "m171010_101235_update_newt cannot be reverted.\n";

        return false;
    }

}
