<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\pricefalls\models\PricefallsProductVariantsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pricefalls-product-variants-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'merchant_id') ?>

    <?= $form->field($model, 'product_id') ?>

    <?= $form->field($model, 'variant_id') ?>

    <?= $form->field($model, 'title') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'attribute_options') ?>

    <?php // echo $form->field($model, 'weight') ?>

    <?php // echo $form->field($model, 'weight_unit') ?>

    <?php // echo $form->field($model, 'barcode') ?>

    <?php // echo $form->field($model, 'image') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
