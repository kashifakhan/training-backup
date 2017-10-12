<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\pricefalls\models\PricefallsProductsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pricefalls-products-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'merchant_id') ?>

    <?= $form->field($model, 'product_id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'inventory') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'images') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
