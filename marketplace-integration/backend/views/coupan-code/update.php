<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CoupanCode */

$this->title = 'Update Coupan Code: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Coupan Codes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="coupan-code-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
