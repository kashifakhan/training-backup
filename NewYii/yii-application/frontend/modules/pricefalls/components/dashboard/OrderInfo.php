<?php
/**
 * Created by PhpStorm.
 * User: cedcoss
 * Date: 10/10/17
 * Time: 11:50 AM
 */

namespace frontend\modules\pricefalls\components\dashboard;


use frontend\modules\pricefalls\components\Data;

class OrderInfo
{


    const COMPLETED_ORDERS_STATUS = "complete";
    const ACKNOWLEDGED_ORDER_STATUS = "acknowledged";
    const INPROGRESS_ORDER_STATUS = "inprogress";


    /*
     * only completed orders from market place will be count here
     *  parameter is only merchant_id
     * parameter type is string
     * return is the number of orders count
     * return type is integer
     */
    public static function getCompleteOrderCount($merchant_id)
    {
        $completedOrders = 0;
        if (is_numeric($merchant_id)) {
            $query = "SELECT COUNT(*) FROM `pricefalls_orders` WHERE `merchant_id`='" . $merchant_id . "' AND `order_status`='" . self::COMPLETED_ORDERS_STATUS . "'";
            $result = Data::sqlRecord($query, 'one', 'select');

            if (isset($result['COUNT(*)']) && $result) {
                $completedOrders = $result['COUNT(*)'];
            }
        }
        return $completedOrders;
    }

    /*
    * only Acknowledged orders from market place will be count here
    *  parameter is only merchant_id
    * parameter type is string
    * return is the number of orders count
    * return type is integer
    */

    public static function getAcknowledgedOrderCount($merchant_id)
    {

        if (is_numeric($merchant_id)) {
            $result = [];
            $total = 0;
            $query = "SELECT COUNT(*) FROM `pricefalls_orders` WHERE `merchant_id`='" . $merchant_id . "' AND `order_status`='" . self::ACKNOWLEDGED_ORDER_STATUS . "'";
            $result = Data::sqlRecord($query, 'all');
            $total = is_array($result) ? $result[0]["COUNT(*)"] : 0;

        }
        return $total;
    }

    /*
* only  orders from market place which are in progress will be count here
*  parameter is only merchant_id
* parameter type is string
* return is the number of orders count
* return type is integer
*/

    public static function getOrdersInProgress($merchant_id)
    {

        if (is_numeric($merchant_id)) {
            $result = [];
            $total = 0;
            $query = "SELECT COUNT(*) FROM `pricefalls_orders` WHERE `merchant_id`='" . $merchant_id . "' AND `order_status`='" . self::INPROGRESS_ORDER_STATUS . "'";
            $result = Data::sqlRecord($query, 'all');
            $total = is_array($result) ? $result[0]["COUNT(*)"] : 0;

        }
        return $total;
    }

    /*
* all orders from market will be count here
*  parameter is only merchant_id
* parameter type is string
* return is the number of orders count
* return type is integer
*/

    public static function getTotalOrder($merchant_id)
    {
        if (is_numeric($merchant_id)) {
            $result = [];
            $total = 0;
            $query = "SELECT COUNT(*) FROM `pricefalls_orders` WHERE `merchant_id`='" . $merchant_id . "'";
            $result = Data::sqlRecord($query, 'all');
            $total = is_array($result) ? $result[0]["COUNT(*)"] : 0;

        }

        return $result;
    }

    /*
* Failed orders from market will be count here
*  parameter is only merchant_id
* parameter type is string
* return is the number of orders count
* return type is integer
*/

    public static function getFailedOrdersCount($merchant_id)
    {

        if (is_numeric($merchant_id)) {
            $result = [];
            $total = 0;
            $query = "SELECT COUNT(*) FROM `pricefalls_failed_orders` WHERE `merchant_id`='" . $merchant_id . "'";
            $result = Data::sqlRecord($query, 'all');
            $total = is_array($result) ? $result[0]["COUNT(*)"] : 0;

        }
        return $total;
    }

    /*
* Failed orders will be removed here
*  parameter is only merchant_id
* parameter type is string
* return is the number of orders count
* return type is integer
*/
    public function removeFailedOrders($merchant_id)
    {
        $failedOrder = array();
        $failedOrder = [];
        $query = "SELECT `pricefalls_order_id` FROM `pricefalls_failed_orders` WHERE `merchant_id`='" . $merchant_id . "'";
        $failedOrder = Data::sqlRecord($query, 'all', 'select');

        if (is_array($failedOrder) && count($failedOrder) > 0) {
            $failedOrderList = array_column($failedOrder, 'merchant_order_id');
        }
        if (count($failedOrderList) > 0) {

            $orderExist = array();
            $query = "SELECT `pricefalls_order_id` FROM `pricefalls_orders` WHERE `merchant_id`='" . $merchant_id . "' AND `pricefalls_order_id` IN('" . implode($failedOrderList) . "')";
            $orderExist = Data::sqlRecords($query, "all", "select");
            if (is_array($orderExist) && count($orderExist) > 0) {
                $orderExistList = array_column($orderExist, 'merchant_order_id');
                if (count($orderExistList) > 0) {
                    Data::sqlRecord("DELETE FROM `pricefalls_failed_orders` WHERE `merchant_id`='" . $merchant_id . "' AND `pricefalls_order_id` IN('" . implode("' , '", $orderExistList) . "') ", null, "update");
                }
            }


        }
    }

    /*
*All orders will be removed here
*  parameter is only merchant_id
* parameter type is string
* return is the number of orders count
* return type is integer
*/
    public function getOrdersCount($merchant_id,$month)
    {
    $result=[];
    $response=0;
    $respose['revenue']=0;
    $total=0;
    $revenue=0;
     $query="SELECT `id`,`order_data` FROM `pricefalls_orders` WHERE `merchant_id`='.{$merchant_id}.' AND `order_status`='complete' AND `order_real_status`=' ' AND `shipped_at` LIKE '%".$month."%'";
        $result = Data::sqlRecord($query, 'all','select');
        if (!empty($result))
        {
            $revenue =  self::calculateRevenue($result);
            $response = ['revenue'=>$revenue];
            $total = count($result);
            $response = ['order'=>$total,'revenue'=>$revenue];
        }

        return $response;
    }

    public function calculateRevenue($result)
    {
        $total=0.00;
        foreach ($result as $val)
        {
            $priceData = json_decode($val['order_data'],true);
           $total +=  $priceData['price_total']['item_price']['item_tax'] + $priceData['price_total']['item_price']['item_shipping_price']+ $priceData['price_total']['item_price']['item_shipping_tax']+ $priceData['price_total']['item_price']['base_price'];
        }
        return (float)$total;
    }
}


