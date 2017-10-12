<?php
/**
 * Created by PhpStorm.
 * User: cedcoss
 * Date: 11/10/17
 * Time: 4:25 PM
 */

namespace frontend\modules\pricefalls\controllers;


use yii\web\Controller;
use yii\web\NotFoundHttpException;
use common\models\LatestUpdates;

class LatestUpdatesController extends Controller
{
    /**
     * @param $id
     * @return string
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * @param $id
     * @return mixed
     */

    protected function findModel($id)
    {
        if (($model = LatestUpdates::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}