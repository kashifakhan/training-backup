<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CommonNotificationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Common Notifications';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="common-notification-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Common Notification', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'html_content:ntext',
            'sort_order',
            'from_date',
            'to_date',
            // 'enable',
            // 'marketplace',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
