<?php 
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */
use yii\helpers\Html;
//use yii\bootstrap\ActiveForm;

$this->title = 'Hello ';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-hello">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Welcome user thanks for visiting Us:</p>

    <div class="row">
        <div class="col-lg-5">
           


                <div style="color:#999;margin:1em 0">
                    If you forgot your password you can <?= Html::a('reset it', ['site/request-password-reset']) ?>.
                </div>

               
        </div>
    </div>
</div>
