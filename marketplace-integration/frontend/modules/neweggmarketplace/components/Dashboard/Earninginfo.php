<?php
namespace frontend\modules\neweggmarketplace\components\Dashboard;

use Yii;
use yii\base\Component;
use frontend\modules\neweggmarketplace\components\Data;

class Earninginfo extends Component
{
    public static $_today = 0;
    public static $_week = 0;
    public static $_month = 0;
    public static $_total = 0;

    /**
     * To check Revenue
     * @param string $merchant_id
     * @return bool
     */
    public static function getTodayEarning($merchant_id)
    {
        $date=date('Y-m-d');
        $date1 = date('Y-m-d 00:00:00');
        if(is_numeric($merchant_id)) {

            //$query = "SELECT `order_total` FROM `newegg_order_detail` WHERE `order_date` BETWEEN '{$date1}' AND '{$date}' AND `order_status_description` = '".Data::ORDER_STATUS_INVOICED."' AND `merchant_id` ={$merchant_id}";
//            $query = "SELECT `order_total` FROM `newegg_order_detail` WHERE `order_date` LIKE '%{$date}%' AND `order_status_description` = '".Data::ORDER_STATUS_INVOICED."' AND `merchant_id` ={$merchant_id}";
            $query = "SELECT `order_total` FROM `newegg_order_detail` WHERE order_date >= '{$date}' AND `order_status_description` = '".Data::ORDER_STATUS_INVOICED."' AND `merchant_id` ={$merchant_id}  ";
            $result = Data::sqlRecords($query, 'all');
            $total = 0;
            if(is_array($result) && count($result)>0)
            {
                foreach ($result as $val)
                {
                    if(isset($val['order_total']))
                    {
                        $total += $val['order_total'];
                    }
                }
            }
            return (float)$total;
        }

    }

    public static function getMonthlyEarning($merchant_id)
    {
        $date=date('Y-m-d');
        $date1=date('Y-m-d',strtotime('-30 days', strtotime(date('d-m-Y'))));

        if(is_numeric($merchant_id)) {
            $query = "SELECT `order_total` FROM `newegg_order_detail` WHERE `order_date` >= '{$date1}' AND `order_date` <= '{$date}' AND `order_status_description` = '".Data::ORDER_STATUS_INVOICED."' AND `merchant_id` ={$merchant_id}";

            $result = Data::sqlRecords($query, 'all');
            $total = 0;
            if(is_array($result) && count($result)>0)
            {
                foreach ($result as $val)
                {
                    if(isset($val['order_total']))
                    {
                        $total += $val['order_total'];
                    }
                }
            }
            return (float)$total;
        }

    }

    public static function getWeeklyEarning($merchant_id)
    {
        $date=date('Y-m-d');
        $date1=date('Y-m-d',strtotime('-7 days', strtotime(date('d-m-Y'))));

        if(is_numeric($merchant_id)) {

            $query = "SELECT `order_total` FROM `newegg_order_detail` WHERE `order_date` >= '{$date1}' AND `order_date` <= '{$date}' AND `order_status_description` = '".Data::ORDER_STATUS_INVOICED."' AND `merchant_id` ={$merchant_id}";
            $result = Data::sqlRecords($query, 'all');
            $total = 0;
            if(is_array($result) && count($result)>0)
            {
                foreach ($result as $val)
                {
                    if(isset($val['order_total']))
                    {
                        $total += $val['order_total'];
                    }
                }
            }
            return (float)$total;
        }

    }

    public static function getTotalEarning($merchant_id)
    {
        if(is_numeric($merchant_id)) {
            $query = "SELECT `order_total` FROM `newegg_order_detail` WHERE `order_status_description` = '".Data::ORDER_STATUS_INVOICED."' AND `merchant_id`=".$merchant_id;
            $result = Data::sqlRecords($query, 'all');
            $total = 0;
            if(is_array($result) && count($result)>0)
            {
                foreach ($result as $val)
                {
                    if(isset($val['order_total']))
                    {
                        $total += $val['order_total'];
                    }
                }
            }
            return (float)$total;
        }

    }


}
