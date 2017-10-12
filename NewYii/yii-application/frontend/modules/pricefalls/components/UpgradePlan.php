<?php
/**
 * Created by PhpStorm.
 * User: cedcoss
 * Date: 11/10/17
 * Time: 1:07 PM
 */

namespace frontend\modules\pricefalls\components;



use yii\base\Component;
use frontend\modules\pricefalls\components\Data;

class UpgradePlan extends Component
{


//    public static function remainingDays($merchant_id)
//    {
//        $query="SELECT `expire_date` FROM `pricefalls_shop_details` WHERE `merchant_id`='".$merchant_id."'";
//        $result=Data::sqlRecord($query,'one','select');
//        $diff=date_diff(date_create(date("Y-m-d H:i:s")),date_create($result['expire_date']));
//var_dump($diff);die;
//    }
}