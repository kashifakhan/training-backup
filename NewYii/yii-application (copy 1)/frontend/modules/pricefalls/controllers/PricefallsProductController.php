<?php
/**
 * Created by PhpStorm.
 * User: cedcoss
 * Date: 11/10/17
 * Time: 5:40 PM
 */

namespace frontend\modules\pricefalls\controllers;

use frontend\modules\pricefalls\controllers\PricefallsMainController;
use yii\filters\VerbFilter;
use yii\web\Controller;

class PricefallsProductController extends Controller
{

    protected $sc,$jetHelper;


    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }



    public function beforeAction($action)
    {
        echo "kkkkk";die;
    }


    public function actionIndex()
    {
        echo "ghffh";die;
    }
}