<?php
/**
 * Created by PhpStorm.
 * User: cedcoss
 * Date: 12/10/17
 * Time: 12:55 PM
 */

namespace frontend\modules\pricefalls\controllers;


use frontend\modules\pricefalls\components\Data;
use yii\web\Controller;
use yii\filters\VerbFilter;
use Yii;
use frontend\modules\pricefalls\components\dashboard\OrderInfo;

class PricefallsReportController extends Controller
{


    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * @param \yii\base\Action $action
     * @return bool
     */
    public function beforeAction($action)
    {
        $merchant_id=Yii::$app->user->getId();
        define('MERCHANT',$merchant_id);
        $this->layout='newmain';
        return true;
    }

    /**
     * @return string
     */
         public function actionIndex()
         {
             $result = $orderData = $revinue = $orderCount = [];
            for($i=0;$i<12;$i++)
            {
                $date = date('Y-m', strtotime("-{$i} month"));
                $orderCount[date("M", strtotime($date))]= OrderInfo::getOrdersCount(MERCHANT,$date);
            }
           $query="SELECT `SKU`,COUNT(`shopify_order_id`) as count FROM `pricefalls_orders` WHERE `merchant_id`='".MERCHANT."' group by SKU  order by count desc limit 10";
           $result=Data::sqlRecord($query,'all','select');

            return $this->render('index',
                ['orders'=>$result,
             'revenue'=>$orderCount]
         );
         }
}