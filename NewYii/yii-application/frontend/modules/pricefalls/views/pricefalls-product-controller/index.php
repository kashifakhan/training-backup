<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\pricefalls\models\PricefallsProductVariantsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pricefalls Product Variants';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pricefalls-product-variants-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Pricefalls Product Variants', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'merchant_id',
            'product_id',
            'variant_id',
            'title:ntext',
            // 'description:ntext',
            // 'price',
            // 'status',
            // 'attribute_options:ntext',
            // 'weight',
            // 'weight_unit',
            // 'barcode',
            // 'image:ntext',
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
