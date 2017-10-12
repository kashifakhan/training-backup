<?php

namespace frontend\modules\pricefalls\controllers;

use frontend\modules\pricefalls\components\dashboard\ProductInfo;
use frontend\modules\pricefalls\components\Data;
use Yii;
use frontend\modules\pricefalls\models\PricefallsProducts;
use frontend\modules\pricefalls\models\PricefallsProductsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\LoginForm;

/**
 * PricefallsProductsController implements the CRUD actions for PricefallsProducts model.
 */
class PricefallsProductsController extends Controller
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
     * Lists all PricefallsProducts models.
     * @return mixed
     */

    public function beforeAction($action)
    {
        $this->layout='newmain';
        return true;
    }
    public function actionIndex()
    {

//        if(Yii::$app->user->isGuest)
//        {
//            Yii::$app->response->redirect(Yii::$app->getUser());
//        }
        $model = new LoginForm();
        $model->login("owner_1");
        $merchant_id=Yii::$app->user->getId();

        $searchModel = new PricefallsProductsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $query="SELECT * FROM `pricefalls_product_variants` WHERE `merchant_id`='".$merchant_id."'";
        $merchant_product=Data::sqlRecord($query,'all','select');

         $query="SELECT `product_id` FROM `pricefalls_products` WHERE `merchant_id`='".$merchant_id."'";
         $products=Data::sqlRecord($query,'all','select');

         $query="SELECT `value` FROM `pricefalls_configuration_setting` WHERE `merchant_id`='".$merchant_id."' AND `config_path`='dynemic_pricing'";
         $dynamic_pricing=Data::sqlRecord($query,'one','select');

         $query="SELECT `id` FROM `pricefalls_product_variants` WHERE `merchant_id`='".$merchant_id."' AND `status`='Available for Purchase'";
         $published_prod=Data::sqlRecord($query,'all','select');


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'products'=>$products,
            'dynamic_pricing'=>$dynamic_pricing,
            'published_prod'=>$published_prod,
            'merchant_id'=>$merchant_id,
            'merchant_product'=>$merchant_product
        ]);
    }


    public function actionBulk()
    {

    }

    /**
     * Displays a single PricefallsProducts model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new PricefallsProducts model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PricefallsProducts();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing PricefallsProducts model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing PricefallsProducts model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PricefallsProducts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PricefallsProducts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PricefallsProducts::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
