<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\pricefalls\models\PricefallsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pricefalls';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pricefalls-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Pricefalls', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'shopname',
            'api_key',
            'api_secret',
            'token',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
