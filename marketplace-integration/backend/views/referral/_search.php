<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ReferralUserSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="referral-user-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'referrer_id') ?>

    <?= $form->field($model, 'merchant_id') ?>

    <?= $form->field($model, 'app') ?>

    <?= $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'installation_date') ?>

    <?php // echo $form->field($model, 'payment_date') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
