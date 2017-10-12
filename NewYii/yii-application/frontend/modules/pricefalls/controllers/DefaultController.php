<?php

namespace frontend\modules\pricefalls\controllers;


use yii\web\Controller;
use Yii;

/**
 * Default controller for the `pricefalls` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */

    public function beforeAction($action)

    {

        $this->layout='newmain';
        return true;
//        echo Yii::$app->user->identity->merchant_id;die;

    }

    /**
     * @return string
     */
    public function actionIndex()
    {

        return $this->render('index');
    }
    public function actionTest()
    {

    }
}
