<?php
/**
 * Created by PhpStorm.
 * User: cedcoss
 * Date: 11/10/17
 * Time: 5:39 PM
 */

namespace frontend\modules\pricefalls\controllers;


use yii\web\Controller;
use Yii;

class PricefallsMainController extends Controller
{
    protected $sc, $jetHelper;
    public function beforeAction($action)
    {
        $this->layout = 'newmain';
        $session = Yii::$app->session;
    }

}