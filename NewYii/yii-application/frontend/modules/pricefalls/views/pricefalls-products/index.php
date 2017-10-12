<?php

use yii\helpers\Html;
use yii\grid\GridView;
use frontend\modules\pricefalls\models\PricefallsProducts;
use yii\grid\CheckboxColumn;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\pricefalls\models\PricefallsProductsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pricefalls Products';
//$this->params['breadcrumbs'][] = $this->title;
?>

<?php if(PricefallsProducts::find()->select('id')->where(['merchant_id'=>$merchant_id])->count()==0):?>
    <div class="yii_notice no_product_error">
        Either there is no product(s) in your shopify store or all product(s) having no sku.Please fill sku for all product(s) from Shopify Store.
    </div>
<?php endif;?>
<div class="title-need-help">
    <h1 class="pricefalls_Products_style"><?= Html::encode($this->title) ?></h1>
</div>
<script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
<div class="shopify-product-index content-section">
    <div class="form new-section">
        <?=Html::beginForm(['pricefalls-products/bulk'],'post',['id'=>'pricefalls_bulk_product'/*,'onsubmit'=>'return validateBulkAction()'*/]);?>
        <div class="pricefalls-pages-heading ">

            <div class="product-upload-menu m-menu confirmbox">
                <?= Html::a('Sync status', yii\helpers\Url::toRoute('pricefalls-report/index'), ['data-step'=>'8', 'data-position'=>'left', 'data-intro'=>'Sync status(s)' ,'class' => 'btn btn-primary']) ?>
                <button type="button" class="btn btn-primary" id="sync_with_btn" data-step='9' data-position='left' data-intro='Click to select and Sync product details from shopify store to app' onclick="cnfrmSync()">Select & Sync Product(s)</button>
                <?=Html::a('Bulk Upload Products', yii\helpers\Url::toRoute('pricefalls-products-fileupload/startupload'),['class'=>'btn btn-primary','data-step'=>'11', 'data-position'=>'left']);?>
                <?= Html::a('Validate Product(s)', ['pricefallsvalidate/index'], [ 'id' => 'product_validate', 'data-step'=>'13', 'data-position'=>'left', 'data-intro'=>'Validate Product(s) as per pricefalls Requirements.' ,'class' => 'btn btn-primary']) ?>
                <?php if($published_prod)
                {
                    ?>
                    <?=Html::a('Fetch Marketplace Pricing', yii\helpers\Url::toRoute('pricefallsrepricing/getrepricing'),['class'=>'btn btn-primary','data-step'=>'14', 'data-position'=>'left','title'=>'Get and compare your product price with competitor price','data-intro'=>'Get and compare your product price with competitor price']);?>
                    <?php
                }
                ?>
                <?= Html::a('Reset Filter', ['pricefalls-products/index'], [ 'data-toggle'=>'tooltip','title'=>'Click to reset all filters','data-position'=>'top','class' => 'btn btn-primary', 'data-step'=>'10', 'data-position'=>'bottom', 'data-intro'=>'Click to reset all filters']) ?>
            </div>
            <div class="product-upload-menu confirmbox">
                <div class="pricefalls-upload-submit"></div>
                <?= Html::a('Sync status', yii\helpers\Url::toRoute('pricefalls-report/index'), ['data-step'=>'8', 'data-position'=>'left', 'data-intro'=>'Sync status(s)' ,'class' => 'btn btn-primary']) ?>
                <button type="button" class="btn btn-primary" id="sync_with_btn" data-step='9' data-position='left' data-intro='Click to select and Sync product details from shopify store to app' onclick="cnfrmSync()">Select & Sync Product(s)</button>

                <?=Html::a('Bulk Upload Products', yii\helpers\Url::toRoute('pricefalls-products-fileupload/index'),['class'=>'btn btn-primary','data-step'=>'10', 'data-position'=>'left','data-intro'=>'Upload all valid products to pricefalls in one click']);?>
                <span class="pop_up" id="view_more_options" data-step="11" data-position="bottom" data-intro="Click to see more features" data-toggle = 'tooltip' title="Click to see more features"><i class="fa fa-bars" aria-hidden="true"></i></span>

                <div class="popup-box confirmbox" style="display: none;">
                    <?= Html::a('Reset Filter', ['pricefalls-products/index'], ['data-position'=>'top','class' => 'btn btn-primary', 'data-step'=>'12', 'data-position'=>'bottom', 'data-intro'=>'Click to reset all filters']) ?>
                    <?/*<?=Html::a('Manual Sync Products(s)', yii\helpers\Url::toRoute('pricefalls-products/batchproductupdate'),['class'=>'btn btn-primary','data-step'=>'13','data-intro'=>'Click to sycn product information', 'data-position'=>'left']);*/?>
                    <?php /*<a class="btn btn-primary" href="<?= yii\helpers\Url::toRoute('pricefalls-products/batchproductupdate') ?>" data-step="13" data-position="left" data-intro="Synchronize shopify products with pricefalls">Manual Sync Products(s)<?php if($countUpdate>0){?><span class="sync_notication"><?php echo $countUpdate;?></span><?php }?></a>
                        */?>
                    <?= Html::a('Validate Product(s)', ['pricefallsvalidate/index'], [ 'id' => 'product_validate','data-step'=>'13', 'data-position'=>'left', 'data-intro'=>'Validate Product(s) as per pricefalls Requirements.' ,'class' => 'btn btn-primary']) ?>
                    <?php if($published_prod)
                    {?>
                        <?=Html::a('Fetch Marketplace Pricing', yii\helpers\Url::toRoute('pricefallsrepricing/getrepricing'),['class'=>'btn btn-primary','data-step'=>'14', 'data-position'=>'left','title'=>'Get and compare your product price with competitor price','data-intro'=>'Get and compare your product price with competitor price']);?>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div class="clear"></div>
        </div>
<div class="pricefalls-products-index">

<?= Html::dropDownList('action',null, [''=>'-- select bulk action --','batch-upload'=>'Upload Products', 'batch-inventory' => 'Upload Inventory','batch-resend' => 'Resend Variants', 'batch-price' => 'Upload Price', 'archieved-batch'=>'Archive Products', 'unarchieved-batch' => 'Unarchive Products'], ['id'=>'jet_product_select','class'=>'form-control','data-step'=>'2','data-intro'=>"Select the BULK ACTION you want to operate.",'data-position'=>'bottom']);?>
    <?= Html::button('Action',['class'=>'btn btn-primary', 'onclick'=>'validateBulkAction()', 'data-step'=>'3','data-intro'=>"Submit the operated bulk action.",'data-position'=>'bottom']);
    ?>
<p>
        <?= Html::a('Create Pricefalls Products', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
            "id"=>"product listing",
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['class'=>'yii\grid\CheckboxColumn'],
            [
                'attribute' => 'images',
                'format' => 'html',
                'contentOptions'=>['class'=>'prod-img-class '],
                'label' => 'Image',
                //'headerOptions' => ['data-toggle'=>'tooltip1','title'=>'Product Image'],
                'value' => function ($data)
                {
                    if(trim($data['images'])!="")
                    {
                        $imageSrc=explode(',',$data['images']);
                        if(count($imageSrc)>0)
                        {
                            return Html::img($imageSrc[0],['width' => '80px','height'=>'80px','class'=>'image_hover']);

                        } else {
                            return Html::img($data['images'], ['width' => '80px','height'=>'80px','class'=>'image_hover']);
                        }
                    }
                    else {
                        return Html::img(Yii::$app->getUrlManager()->getBaseUrl().'/images/noimage.png',
                            ['width' => '80px','height'=>'80px','class'=>'image_hover']);
                    }
                },
            ],
            [
                'attribute'=>'title',
                'contentOptions'=>['style'=>'width: 400px;'],

                'format'=>'raw',
                'value' => function($data){
//                    //print_r($data);die();
//                    if (trim($data->update_title)!="") {
//                        return $data->update_title;
//                    }
                    return $data['title'];
                },
            ],
            [
                'attribute'=>'id',
                'contentOptions'=>['style'=>'width: 300px;'],

                'format'=>'raw',
                'value' => function($data){
//                    //print_r($data);die();
//                    if (trim($data->update_title)!="") {
//                        return $data->update_title;
//                    }
                    return $data['id'];
                },
            ],
            [
                'attribute'=>'merchant_id',
                'contentOptions'=>['style'=>'width: 300px;'],

                'format'=>'raw',
                'value' => function($data){
//                    //print_r($data);die();
//                    if (trim($data->update_title)!="") {
//                        return $data->update_title;
//                    }
                    return $data['merchant_id'];
                },
            ],
            [
                'attribute'=>'inventory',
                'contentOptions'=>['style'=>'width: 300px;'],

                'format'=>'raw',
                'value' => function($data){
//                    //print_r($data);die();
//                    if (trim($data->update_title)!="") {
//                        return $data->update_title;
//                    }
                    return $data['inventory'];
                },
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
<?= Html::endForm()?>
        <script type="text/javascript" src="<?=Yii::getAlias('@pricefallsbasepath');?>/assets/js/jquery-1.8.2.min--.js"></script>
<script>
            function  cnfrmSync() {
                alert("hello");
            }


            function validateBulkAction() {
                var checkedItems = $("#comp input:checked");
                console.log(checkedItems);
                alert(checkedItems);
            }

    </script>