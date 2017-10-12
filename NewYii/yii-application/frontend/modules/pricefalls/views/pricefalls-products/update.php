<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\pricefalls\models\PricefallsProducts */

$this->title = 'Update Pricefalls Products: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Pricefalls Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pricefalls-products-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
