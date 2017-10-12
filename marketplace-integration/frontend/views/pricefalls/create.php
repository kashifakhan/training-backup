<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\modules\pricefalls\models\Pricefalls */

$this->title = 'Create Pricefalls';
$this->params['breadcrumbs'][] = ['label' => 'Pricefalls', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pricefalls-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
