<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\modules\pricefalls\models\PricefallsProductVariants */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Pricefalls Product Variants', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pricefalls-product-variants-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'merchant_id',
            'product_id',
            'variant_id',
            'title:ntext',
            'description:ntext',
            'price',
            'status',
            'attribute_options:ntext',
            'weight',
            'weight_unit',
            'barcode',
            'image:ntext',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
