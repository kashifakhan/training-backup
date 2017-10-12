<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\modules\pricefalls\models\PricefallsProductVariants */

$this->title = 'Create Pricefalls Product Variants';
$this->params['breadcrumbs'][] = ['label' => 'Pricefalls Product Variants', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pricefalls-product-variants-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
