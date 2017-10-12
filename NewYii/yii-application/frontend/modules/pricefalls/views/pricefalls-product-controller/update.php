<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\pricefalls\models\PricefallsProductVariants */

$this->title = 'Update Pricefalls Product Variants: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Pricefalls Product Variants', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pricefalls-product-variants-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
