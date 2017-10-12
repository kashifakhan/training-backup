<?php
/**
 * Created by PhpStorm.
 * User: cedcoss
 * Date: 11/10/17
 * Time: 9:43 AM
 */

namespace frontend\modules\pricefalls\components\dashboard;


use frontend\modules\pricefalls\components\Data;
use yii\base\Component;

class SalesInfo extends Component
{

    public static function getTodayEarning($merchant_id)
    {
        $date=date('Y-m-d  H:i:s');
        $date1 = date('Y-m-d 00:00:00');
        if(is_numeric($merchant_id))
        {
            $result1 = [];
            $query = "SELECT `order_data` FROM `pricefalls_orders` WHERE `shipped_at` BETWEEN '{$date1}' AND '{$date}' AND `order_status` = 'complete' AND `merchant_id` ={$merchant_id}";
            $result1 = Data::sqlRecord($query, 'all');
            $total=0.00;
            if(!empty($result1) && is_array($result1))
            {
                foreach ($result1 as $val)
                {
                    $priceData = json_decode($val['order_data'],true);
                    $total +=  $priceData['order_total']['item_price']['item_tax'] + $priceData['order_total']['item_price']['item_shipping_price']+ $priceData['order_total']['item_price']['item_shipping_tax']+ $priceData['order_totals']['item_price']['base_price'];
                }
            }
            return (float)$total;
        }
    }

    public static function getMonthlyEarning($merchant_id)
    {
        $date=date('Y-m-d');
        $date1=date('Y-m-d',strtotime('-30 days', strtotime(date('Y-m-d'))));
        if(is_numeric($merchant_id))
        {
            $query = "SELECT `order_data` FROM `pricefalls_orders` WHERE `shipped_at` BETWEEN '{$date1}' AND '{$date}' AND `order_status` = 'complete' AND `merchant_id` ={$merchant_id}";
            $result1 = Data::sqlRecord($query, 'all');
            $total=0.00;
            if(is_array($result1) && !empty($result1))
            {
                foreach ($result1 as $val)
                {
                    $priceData = json_decode($val['order_data'],true);
                    $total +=  $priceData['order_totals']['item_price']['item_tax'] + $priceData['order_totals']['item_price']['item_shipping_cost']+ $priceData['order_totals']['item_price']['item_shipping_tax']+ $priceData['order_totals']['item_price']['base_price'];
                }
            }
            return (float)$total;
        }

    }
    public static function getWeeklyEarning($merchant_id)
    {
        $date=date('Y-m-d');
        $date1=date('Y-m-d',strtotime('-7 days', strtotime(date('Y-m-d'))));
        if(is_numeric($merchant_id))
        {

            $query = "SELECT `order_data` FROM `pricefalls_orders` WHERE `shipped_at` BETWEEN '{$date1}' AND '{$date}' AND `order_status` = 'complete' AND `merchant_id` ={$merchant_id}";
            $result1 = Data::sqlRecord($query, 'all');
            $total=0.00;
            if(is_array($result1) && !empty($result1))
            {
                foreach ($result1 as $val)
                {
                    $priceData = json_decode($val['order_data'],true);
                    $total +=  $priceData['order_totals']['item_price']['item_tax'] + $priceData['order_totals']['item_price']['item_shipping_cost']+ $priceData['order_totals']['item_price']['item_shipping_tax']+ $priceData['order_totals']['item_price']['base_price'];
                }
            }
            return (float)$total;
        }
    }
    public static function getTwoWeeklyEarning($merchant_id)
    {
        $total=0.00;
        $date=date('Y-m-d 00:00:00');
        $date1=date('Y-m-d 00:00:00',strtotime('-15 days', strtotime(date('Y-m-d 00:00:00'))));
        if(is_numeric($merchant_id))
        {

            $query = "SELECT `order_data` FROM `pricefalls_orders` WHERE `merchant_id` ='{$merchant_id}' AND `order_real_status`='' AND `shipped_at` BETWEEN ('{$date1}' AND '{$date}') AND `order_status` = 'complete' ";
            $result1 = Data::sqlRecord($query, 'all');
            if(is_array($result1) && !empty($result1))
            {
                foreach ($result1 as $val)
                {
                    $priceData = json_decode($val['order_data'],true);
                    $total +=  $priceData['order_totals']['item_price']['item_tax'] + $priceData['order_totals']['item_price']['item_shipping_cost']+ $priceData['order_totals']['item_price']['item_shipping_tax']+ $priceData['order_totals']['item_price']['base_price'];
                }
            }
        }
        return (float)$total;
    }
public static function getTotalSales($merchant_id)
{

    $query="SELECT `order_data` FROM `pricefalls_orders` WHERE `merchant_id`={$merchant_id} AND `order_status`='complete'";
    $result=Data::sqlRecord($query,'one','select');
    $result=json_decode(trim($result['order_data']),true);

    $total=0.00;
    $total=$result['price_total']['item_price']['item_tax']
        +$result['price_total']['item_price']['item_shipping_price']
        +$result['price_total']['item_price']['item_shipping_tax']+
        +$result['price_total']['item_price']['base_price'];

    return $total;

}
}