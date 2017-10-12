<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\AddProductsForm*/

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'AddProduct';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-addproduct">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to Add products:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-addproduct']); ?>

            <?= $form->field($model, 'product_id')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'product_name')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'product_price')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'product_image')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'product_quantity')->textInput(['autofocus' => true]) ?>

            <div class="form-group">
                <?= Html::submitButton('AddProducts', ['class' => 'btn btn-primary', 'name' => 'addproduct-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>