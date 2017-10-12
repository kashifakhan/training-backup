<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\modules\pricefalls\models\PricefallsProducts */

$this->title = 'Create Pricefalls Products';
$this->params['breadcrumbs'][] = ['label' => 'Pricefalls Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pricefalls-products-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
