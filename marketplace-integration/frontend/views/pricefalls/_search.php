<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\pricefalls\models\PricefallsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pricefalls-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'shopname') ?>

    <?= $form->field($model, 'api_key') ?>

    <?= $form->field($model, 'api_secret') ?>

    <?= $form->field($model, 'token') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
