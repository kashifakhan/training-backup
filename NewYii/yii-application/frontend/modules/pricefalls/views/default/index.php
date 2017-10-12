<?php
//$merchant_id=MERCHANT_ID;
//$TotalProducts = $objProductInfo->getTotalProducts($merchant_id,$type);
$merchant_id=1;
$month=10;
$type=" ";

use frontend\modules\pricefalls\components\dashboard\ProductInfo;
use frontend\modules\pricefalls\components\dashboard\OrderInfo;
use frontend\modules\pricefalls\components\dashboard\LatestUpdateInfo;
use frontend\modules\pricefalls\components\dashboard\LowStockAlert;
use frontend\modules\pricefalls\components\dashboard\SalesInfo;
use frontend\modules\pricefalls\components\Data;


$objectProductInfo=new ProductInfo();
$objectOrderInfo=new OrderInfo();
$objectLatestUpdateInfo=new LatestUpdateInfo();
$objectStockInfo=new LowStockAlert();
$objectSalesInfo=new SalesInfo();

$total_products=$objectProductInfo->getAllProduct($merchant_id,$type);
$live_products=$objectProductInfo->getLiveProduct($merchant_id);
$under_pricefalls_reviewproduct=$objectProductInfo->getPricefallsUnderReviewProduct($merchant_id);
$archived_product=$objectProductInfo->getArchivedProduct($merchant_id);
$excluded_product=$objectProductInfo->getExcludedProduct($merchant_id);
$notuploaded_product=$objectProductInfo->getNotUploadedProduct($merchant_id);
$missingdata_product=$objectProductInfo->getMissingDataProduct($merchant_id);
$unauthorised_product=$objectProductInfo->getUnAuthorisedProduct($merchant_id);

$completed_orders=$objectOrderInfo->getCompleteOrderCount($merchant_id);
$acknowledged_orders=$objectOrderInfo->getAcknowledgedOrderCount($merchant_id);
$inprogress_orders=$objectOrderInfo->getOrdersInProgress($merchant_id);
$total_orders=$objectOrderInfo->getTotalOrder($merchant_id);
$orders_count=$objectOrderInfo->getOrdersCount($merchant_id,$month);
//$revenue=$objectOrderInfo->calculateRevenue($merchant_id);
$failed_order=$objectOrderInfo->getFailedOrdersCount($merchant_id);

$all_updates=$objectLatestUpdateInfo->getLatestUpdates();

$inventory=$objectStockInfo->getStockDetails($merchant_id);
$lowstosk_alert=$objectStockInfo->getLowStockAlert($merchant_id);

$threshold_quantity=$objectStockInfo->getThresholdquantity($merchant_id);

$total_earning=$objectSalesInfo->getTotalSales($merchant_id);
$todays_earning=$objectSalesInfo->getTodayEarning($merchant_id);
$mothly_earning=$objectSalesInfo->getMonthlyEarning($merchant_id);
$weekly_earning=$objectSalesInfo->getWeeklyEarning($merchant_id);
$toweekly_earning=$objectSalesInfo->getTwoWeeklyEarning($merchant_id);


//var_dump($total_earning)
?>
<?php //\frontend\modules\pricefalls\components\UpgradePlan::remainingDays($merchant_id);?>
<div class="pricefalls-default-index">
    <div class="bottom-header">
        <div class="row">
            <div class="col-md-3 col-lg-3 col-sm-6 col-xs-12">
                <span class="earnings">STORE EARNING</span>
                <p class="days">TODAY</p>
                <p class="prices"> <?= Data::custom_number_format($todays_earning,3) ?> $</p>
            </div>
            <div class="col-md-3 col-lg-3 col-sm-6 col-xs-12">
                <span class="earnings">STORE EARNING</span>
                <p class="days">THIS WEEK</p>
                <p class="prices"> <?= Data::custom_number_format($weekly_earning,3) ?> $</p>
            </div>
            <div class="col-md-3 col-lg-3 col-sm-6 col-xs-12">
                <span class="earnings">STORE EARNING</span>
                <p class="days">THIS MONTH</p>
                <p class="prices"><?= Data::custom_number_format($mothly_earning,3) ?> $</p>
            </div>
            <div class="col-md-3 col-lg-3 col-sm-6 col-xs-12">
                <span class="earnings">STORE EARNING</span>
                <p class="days">TOTAL</p>
                <p class="prices" id="total"><?= Data::custom_number_format($total_earning,3) ?> $</p>
            </div>
        </div>
    </div>
</div>

<div class="main-content-wrapper container">
    <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
            <div class="tab-section new-section">
                <div class="row">
                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                        <ul class="nav nav-tabs">
                            <li id="product" class="tabs active"><a data-toggle="tab" href="#home">Product Information</a></li>
                            <li id="order" class="tabs"><a data-toggle="tab" href="#menu1">Order Information</a></li>
                        </ul>

                        <div class="tab-content">
                            <div id="home" class="tab-pane fade in active">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="live-box new-section grey-bg">
                                            <span class="heading earnings">Live Products</span>
                                            <div class="product-count">
                                                <h4><?= $live_products; ?></h4>

                                                <a data-toggle="tooltip" title="Click to see 'Available for Purchase state' products on jet" href="<?=Yii::getAlias('@webpricefallsurl');?>/jetproduct/index?JetProductSearch[status]=Available+for+Purchase"><span>know more</span></a>
                                                <a data-toggle="tooltip" title="Click to see 'Available for Purchase state' products on jet" class="icon" href="<?=Yii::getAlias('@webpricefallsurl');?>/jetproduct/index?JetProductSearch[status]=Available+for+Purchase"><i class="fa fa-line-chart" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="jet-review-box new-section purple-bg">
                                            <span class="heading earnings ">Under jet review</span>
                                            <div class="product-count">
                                                <h4><?= $under_pricefalls_reviewproduct; ?></h4>

                                                <a data-toggle="tooltip" title="Click to see 'Under review state' products on jet" href="<?=Yii::getAlias('@webpricefallsurl');?>/jetproduct/index?JetProductSearch[status]=Under+Jet+Review"><span>know more</span></a>
                                                <a data-toggle="tooltip" title="Click to see 'Under review state' products on jet" class="icon" href="<?=Yii::getAlias('@webpricefallsurl');?>/jetproduct/index?JetProductSearch[status]=Under+Jet+Review"><i class="fa fa-eye" aria-hidden="true"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="missing-listings new-section purple-bg">
                                            <span class="heading earnings">Missing listing data</span>
                                            <div class="product-count">
                                                <h4><?= $missingdata_product; ?></h4>

                                                <a  data-toggle="tooltip" title="Click to see 'Missing Listing Data state' products on jet"  href="<?=Yii::getAlias('@webpricefallsurl');?>/jetproduct/index?JetProductSearch[status]=Missing+Listing+Data"><span>know more</span></a>
                                                <a  data-toggle="tooltip" title="Click to see 'Missing Listing Data state' products on jet"  class="icon" href="<?=Yii::getAlias('@webpricefallsurl');?>/jetproduct/index?JetProductSearch[status]=Missing+Listing+Data"><i class="fa fa-question-circle-o" aria-hidden="true"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="archieves new-section grey-bg">
                                            <span class="heading earnings">Archived</span>
                                            <div class="product-count">
                                                <h4><?= $archived_product; ?></h4>

                                                <a data-toggle="tooltip" title="Click to see 'Archived state' products on jet" href="<?=Yii::getAlias('@webpricefallsurl');?>/jetproduct/index?JetProductSearch[status]=Archived"><span>know more</span></a>
                                                <a data-toggle="tooltip" title="Click to see 'Archived state' products on jet" class="icon" href="<?=Yii::getAlias('@webpricefallsurl');?>/jetproduct/index?JetProductSearch[status]=Archived"><i class="fa fa-folder-open" aria-hidden="true"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="not-uploaded new-section black-bg">
                                            <span class="heading earnings">Not uploaded</span>
                                            <div class="upload-wrap">
                                                <div class="left">
                                                    <h4><?= $notuploaded_product; ?></h4>
                                                </div>
                                                <div class="right">

                                                    <a data-toggle="tooltip" title="Click to see 'Not Uploaded state' products on jet" class="icon" href="<?=Yii::getAlias('@webpricefallsurl');?>/jetproduct/index?JetProductSearch[status]=Not+Uploaded"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                                    </a>
                                                    <a data-toggle="tooltip" title="Click to see 'Not Uploaded state' products on jet" href="<?=Yii::getAlias('@webpricefallsurl');?>/jetproduct/index?JetProductSearch[status]=Not+Uploaded"><span>know more</span></a>
                                                </div>
                                                <div class="clear"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="menu1" class="tab-pane fade">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="live-box new-section grey-bg">
                                            <span class="heading earnings">Completed Orders</span>
                                            <div class="product-count">
                                                <h4><?= $completed_orders; ?></h4>

                                                <a data-toggle="tooltip" title="Click to see orders shipped on jet" href="<?=Yii::getAlias('@webpricefallsurl');?>/jetorderdetail/index?JetOrderDetailSearch[status]=complete"><span>know more</span></a>
                                                <a data-toggle="tooltip" title="Click to see orders shipped on jet"class="icon" href="<?=Yii::getAlias('@webpricefallsurl');?>/jetorderdetail/index?JetOrderDetailSearch[status]=complete"><i class="fa fa-list-alt" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="jet-review-box new-section purple-bg">
                                            <span class="heading earnings ">Acknowledged Orders</span>
                                            <div class="product-count">
                                                <h4><?= $acknowledged_orders; ?></h4>

                                                <a data-toggle="tooltip" title="Click to see orders 'received' from jet" href="<?=Yii::getAlias('@webpricefallsurl');?>/jetorderdetail/index?JetOrderDetailSearch[status]=acknowledged"><span>know more</span></a>
                                                <a data-toggle="tooltip" title="Click to see orders 'received' from jet" class="icon" href="<?=Yii::getAlias('@webpricefallsurl');?>/jetorderdetail/index?JetOrderDetailSearch[status]=acknowledged"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="missing-listings new-section purple-bg">
                                            <span class="heading earnings">Inprogress Orders</span>
                                            <div class="product-count">
                                                <h4><?=$inprogress_orders; ?></h4>
                                                <a data-toggle="tooltip" title="Click to see orders 'Inprogress' on jet" href="<?=Yii::getAlias('@webpricefallsurl');?>/jetorderdetail/index?JetOrderDetailSearch[status]=inprogress"><span>know more</span></a>
                                                <a data-toggle="tooltip" title="Click to see orders 'Inprogress' on jet"  class="icon" href="<?=Yii::getAlias('@webpricefallsurl');?>/jetorderdetail/index?JetOrderDetailSearch[status]=inprogress"><i class="fa fa-truck" aria-hidden="true"></i>

                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="archieves new-section grey-bg">
                                            <span class="heading earnings">Failed Orders</span>
                                            <div class="product-count">
                                                <h4><?= $failed_order; ?></h4>
                                                <a data-toggle="tooltip" title="Click to see orders 'Unable to accept' from jet"  href="<?=Yii::getAlias('@webpricefallsurl');?>/jetorderimporterror/index"><span>know more</span></a>
                                                <a data-toggle="tooltip" title="Click to see orders 'Unable to accept' from jet"  class="icon" href="<?=Yii::getAlias('@webpricefallsurl');?>/jetorderimporterror/index"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="not-uploaded new-section black-bg">
                                            <span class="heading earnings">Total Orders</span>
                                            <div class="upload-wrap">
                                                <div class="left">
                                                    <h4><?= $total_orders + $failed_order; ?></h4>
                                                </div>
                                                <div class="right">

                                                    <a data-toggle="tooltip" title="Click to see orders 'total order' process through app" class="icon" href="<?=Yii::getAlias('@webpricefallsurl');?>/jetorderdetail/index"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                                    </a>
                                                    <a data-toggle="tooltip" title="Click to see orders 'total order' process through app" href="<?=Yii::getAlias('@webpricefallsurl');?>/jetorderdetail/index"><span>know more</span></a>
                                                </div>
                                                <div class="clear"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                        <!-- Products Pie Chart -->
                        <div class="outer-wrapper">
                            <div class="inner-wrapper" id="product_piechart">
                                <section>
                                    <div class="productPie pie">
                                        <div class="caption">

<!--                                            --><?php //die;?>
                                            <span>Total Products <br><?php if($type){ echo "(with variants)";}?><br><?= $total_products; ?></span>
                                        </div>
                                    </div>
                                    <ul class="productPie legend">
                                        <li>
                                            <em>Live Products</em>
                                            <span><?= $live_products; ?></span>
                                        </li>
                                        <li>
                                            <em>Under Review Products</em>
                                            <span><?= $under_pricefalls_reviewproduct; ?></span>
                                        </li>
                                        <li>
                                            <em>Archived Products</em>
                                            <span><?= $archived_product; ?></span>
                                        </li>
                                        <li>
                                            <em>Not Uploaded Products</em>
                                            <span><?= $notuploaded_product; ?></span>
                                        </li>
                                        <li>
                                            <em>Missing Data Products</em>
                                            <span><?= $missingdata_product; ?></span>
                                        </li>
                                        <li>
                                            <em>Excluded Products</em>
                                            <span><?= $excluded_product; ?></span>
                                        </li>
                                        <li>
                                            <em>Unauthorized Products</em>
                                            <span><?= $unauthorised_product; ?></span>
                                        </li>
<!--                                        <li>-->
<!--                                            <em>Category Not Mapped</em>-->
<!--                                            <span>--><?//= $CategoryNotMapped; ?><!--</span>-->
<!--                                        </li>-->
                                    </ul>
                                </section>
                            </div>
                        </div>

                        <!-- Orders Pie Chart -->
                        <div class="outer-wrapper">
                            <div class="inner-wrapper" id="order_piechart" style="display: none;">
                                <section>
                                    <div class="orderPie pie">
                                        <div class="caption">
                                            <span>Total Orders<br><?= $total_orders + $failed_order; ?></span>
                                        </div>
                                    </div>
                                    <ul class="orderPie legend">
                                        <li>
                                            <em>Completed Orders</em>
                                            <span><?= $completed_orders ?></span>
                                        </li>
                                        <li>
                                            <em>Acknowledged Orders</em>
                                            <span><?= $acknowledged_orders ?></span>
                                        </li>
                                        <li>
                                            <em>Inprogress Orders</em>
                                            <span><?=$inprogress_orders; ?></span>
                                        </li>
                                        <li>
                                            <em>Failed Orders</em>
                                            <span><?= $failed_order ?></span>
                                        </li>
                                    </ul>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <div class="box-update-sections">
                <div class="row">

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="update-section new-section no-pad">
                            <div class="update-heading grey-heading">
                                <h5>Latest Updates</h5>
                            </div>
                            <div class="update-content">
                                <ul class="update-list list-style">
                                    <?php if(count($all_updates)) : ?>
                                        <?php foreach ($all_updates as $latestUpdate) : ?>
                                            <?php 	$time = $objectLatestUpdateInfo->timeDifference($latestUpdate['updated_at']);?>
                                            <li>
                                                <p><a href="<?= Data::getUrl('latest-updates/view?id='.$latestUpdate['id']) ?>"><?= $latestUpdate['title'] ?></a></p>
                                                <span><?= $time." ago" ?></span>
                                            </li>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <li>No Latest Updates Found.</li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="inventory-update new-section no-pad">
                            <div class="inventory-heading grey-heading">
                                <h5>Inventory Updates</h5>
                            </div>
                            <div class="inventory-content">
                                <ul class="update-list list-style">
<!--                                    --><?php if(isset($lowstosk_alert) && !(empty($lowstosk_alert)))
                                    {
                                        $i = 0;
                                        foreach($lowstosk_alert as $key=>$value)
                                        {
                                            ?>
                                            <li>
                                                <p>Attention !<a href="<?=$value['title']?>=<?=urlencode($value['inventory']);?>"> <?=$value['title']?></a></p>
                                                <span>Less than <?=$threshold_quantity?> in inventory.</span>
                                            </li>
                                            <?php $i++;?>
                                            <?php if($i==3){break;}?>
                                        <?php }?>

                                        <?php if(count($lowstosk_alert) < 3){?>
                                        <li>
                                            <a class="btn btn-primary" href="<?=Yii::getAlias('@webpricefallsurl');?>/pricefalls-products/index?low=<?=$threshold_quantity?>" target="_blank">Check For More</a>
                                        </li>
                                    <?php }?>
                                    <?php }else{?>
                                        <li>
                                            <p>No New Updates.</p>
                                        </li>
                                    <?php }?>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
</div>
</div>
</div>
<style type="text/css">
    .content-section {
        padding: 0;
    }
</style>
<?php $get = Yii::$app->request->get();
if(isset($get['tour'])) :
    ?>

    <script type="text/javascript">
        $(document).ready(function(){
            var dashboardQuicktour = introJs().setOptions({
                doneLabel: 'Next page',
                showStepNumbers: false,
                exitOnOverlayClick: false,
                steps: [
                    {
                        element: '.bottom-header',
                        intro: 'You can view your  STORE EARNING from here.',
                        position: 'bottom',
                        scrollToElement: true,
                    },
                    {
                        element: '#product',
                        intro: "Your Products Statistics.",
                        position: 'top',
                        scrollToElement: true,
                    },
                    {
                        element: '#order',
                        intro: "Your Product’s Order Statistics.",
                        position: 'top',
                        scrollToElement: true,
                    },

                    {
                        element: '.update-section',
                        intro: "Get all the latest updates related to Jet.",
                        position: 'bottom',
                        scrollToElement: true,
                    },
                    {
                        element: '.inventory-update',
                        intro: "Get Inventory-related Alerts.",
                        position: 'bottom',
                        scrollToElement: true,
                    }
                ]
            });
//            setTimeout(function () {
//                dashboardQuicktour.start().oncomplete(function() {
//                    window.location.href = '<?//= Data::getUrl("categorymap/index?tour") ?>//';
//                });
//            },1000);
        });
    </script>
<?php endif; ?>


