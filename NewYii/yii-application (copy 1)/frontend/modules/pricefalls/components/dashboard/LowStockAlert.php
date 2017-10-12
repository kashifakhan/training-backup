<?php
/**
 * Created by PhpStorm.
 * User: cedcoss
 * Date: 11/10/17
 * Time: 9:46 AM
 */

namespace frontend\modules\pricefalls\components\dashboard;


use frontend\modules\pricefalls\components\Data;
use yii\base\Component;

class LowStockAlert extends Component
{
    public static function getStockDetails($merchant_id)
    {
        $query="SELECT `value` FROM `pricefalls_configuration_setting` WHERE `merchant_id`={$merchant_id} AND `config_path`='inventory' ";
        $result=Data::sqlRecord($query,'one','select');
        return $result;
    }

    /**
     * @param $merchant_id
     * @return array|false|string
     */
    public static function getLowStockAlert($merchant_id)
    {
        $threshold_inventory=self::getThresholdquantity($merchant_id);
        $query="SELECT * FROM `pricefalls_products` WHERE `merchant_id`={$merchant_id} AND `inventory`<{$threshold_inventory} order by `inventory` ASC LIMIT 0,5";
        $result=Data::sqlRecord($query,'all','select');
        return $result;
    }

    /**
     * @param $merchant_id
     * @return array|false|int
     */

    public static function getThresholdquantity($merchant_id)
    {
        $query="SELECT `value` FROM `pricefalls_configuration_setting` WHERE `merchant_id`={$merchant_id} AND `config_path`='inventory_threshold'";
        $result=Data::sqlRecord($query,'one','select');
        return $result['value'];
    }


}