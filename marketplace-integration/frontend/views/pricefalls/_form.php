<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\pricefalls\models\Pricefalls */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pricefalls-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'shopname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'api_key')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'api_secret')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'token')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
