<?php
/**
 * Created by PhpStorm.
 * User: cedcoss
 * Date: 13/2/17
 * Time: 3:30 PM
 */
/* @var $this yii\web\View */
use yii\helpers\Html;
use app\models\JetProduct;
use app\models\JetErrorfileInfo;
use app\models\JetOrderDetail;
use app\models\JetOrderImportError;

use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;

?>

<div id="home-page">
    <?php
    $this->registerCssFile(Yii::$app->request->baseUrl . "/css/animate.min.css");
    $this->registerCssFile(Yii::$app->request->baseUrl . "/css/creative.css");

    ?>
    <div class="trial-nav-wrap">
        <nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <a class="navbar-brand page-scroll" href="#home-page"><img alt="Ced Commerce"
                                                                               src="<?= Yii::$app->request->baseUrl; ?>/images/logo.png"></a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a class="page-scroll" href="#features">Features</a>
                        </li>
                        <li>
                            <a class="page-scroll" href="#services">Services</a>
                        </li>
                        <li>
                            <a class="page-scroll" href="#pricing">Pricing</a>
                        </li>
                        <li>
                            <a class="page-scroll" href="#contact">Contact</a>
                        </li>
                        <li>
                            <a class="page-scroll"
                               href="<?php echo Yii::$app->request->baseUrl ?>/newegg-marketplace/sell-on-newegg"
                               target="_blank">How to Sell on Walmart?</a>
                        </li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right navbar-2">
                        <li>
                            <a class="page-scroll" href="#features">Features</a>
                        </li>
                        <li>
                            <a class="page-scroll" href="#services">Services</a>
                        </li>
                        <li>
                            <a class="page-scroll" href="#pricing">Pricing</a>
                        </li>
                        <li>
                            <a class="page-scroll" href="#contact">Contact</a>
                        </li>
                        <li>
                            <a class="page-scroll"
                               href="<?php echo Yii::$app->request->baseUrl ?>/newegg-marketplace/sell-on-newegg"
                               target="_blank">How to Sell on Walmart?</a>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container-fluid -->
        </nav>
    </div>
    <header class="header-section">
        <div class="header-overlay"></div>
        <div class="header-content">
            <div class="header-content-inner">
                <h1 class="wow fadeInUp">Start Selling On</h1>
                <img class="img-responsive wow fadeInUp walmart-img" data-wow-delay="0.2s"
                     style="margin-top: 0;  width: 250px;"
                     src=<?= Yii::$app->request->getBaseUrl() . '/images/NeweggLogo1.png' ?>>
                <hr>
                <p>All in one platform for merchants to list products on Newegg marketplace and manage their inventory,
                    order and shipping</p>
                <?php $form = ActiveForm::begin([
                    'id' => 'login-form',
                    'options' => ['class' => 'form-horizontal'],
                    'action' => \yii\helpers\Url::toRoute(['/neweggcanada/site/login']),
                    'fieldConfig' => [
                        'template' => "{label}\n<div class=\"col-lg-12 shop-url-wrap\">{input}</div>",
                    ],
                ]); ?>

                <?= $form->field($model, 'username')->textInput(['placeholder' => 'example.myshopify.com']) ?>

                <?= Html::submitButton('Install', ['class' => 'install-me btn btn-primary button-inline btn btn-primary btn-xl page-scroll button-install ', 'name' => 'login-button']) ?>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </header>
    <section class="bg-primary" id="features">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                    <h2 class="section-heading text-center">Most Useful Features</h2>
                    <hr class="">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 text-center columns wow bounceIn">
                    <div class="panels panels-shortcode">
                        <div class="panel-item margin-bottom-60">
                            <div class="panels-icon text-color-theme">
                                <img src="<?= Yii::$app->request->baseUrl; ?>/img/icons/Auto-Acknowledge-Orders.png">
                            </div>
                            <div class="panels-text">
                                <h6>Auto Acknowledge Orders</h6>
                                Auto acknowledgement within 15 minutes of order placed on Newegg.com.
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 text-center columns wow bounceIn">
                    <div class="panels panels-shortcode">
                        <div class="panel-item margin-bottom-60">
                            <div class="panels-icon text-color-theme">
                                <img src="<?= Yii::$app->request->baseUrl; ?>/img/icons/Products-Synchronization.png">
                            </div>
                            <div class="panels-text">
                                <h6>Products Synchronization</h6>
                                Synchronized product information on Newegg with revised inventory.
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 text-center columns wow bounceIn">
                    <div class="panels panels-shortcode">
                        <div class="panel-item margin-bottom-60">
                            <div class="panels-icon text-color-theme">
                                <img src="<?= Yii::$app->request->baseUrl; ?>/img/icons/Orders-Management_2.png">
                            </div>
                            <div class="panels-text">
                                <h6>Orders Management</h6>
                                Easy listing and fulfilment with tracking information of Newegg orders from shopify
                                store.
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 text-center columns">
                    <div class="panels panels-shortcode wow bounceIn">
                        <div class="panel-item margin-bottom-60">
                            <div class="panels-icon text-color-theme">
                                <img src="<?= Yii::$app->request->baseUrl; ?>/img/icons/Variants-Product-Support.png">
                            </div>
                            <div class="panels-text">
                                <h6>Variants Product Support</h6>
                                Variant products are one of the mostly used products in any E-Commerce store. Shopify
                                variant products support is provided with this app.
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 text-center columns">
                    <div class="panels panels-shortcode wow bounceIn">
                        <div class="panel-item margin-bottom-60">
                            <div class="panels-icon text-color-theme">
                                <img src="<?= Yii::$app->request->baseUrl; ?>/img/icons/Realtime-Error-Handling.png">
                            </div>
                            <div class="panels-text">
                                <h6>Realtime Error Handling</h6>
                                Realtime error handling is achieved with our app. If issues occur in any product
                                uploaded on Newegg.com, proper messages are shown in the notification section for
                                errors.
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 text-center columns">
                    <div class="panels panels-shortcode wow bounceIn">
                        <div class="panel-item margin-bottom-60">
                            <div class="panels-icon text-color-theme">
                                <img src="<?= Yii::$app->request->baseUrl; ?>/img/icons/Dashboard.png">
                            </div>
                            <div class="panels-text">
                                <h6>Fully Featured Dashboard</h6>
                                Dashboard of our app gives the information about the total number of products uploaded
                                on Newegg.com, number of live and archived products along with the number of orders
                                imported by the app and your shops lifetime sales.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center text-center">
                    <a id="get-start"
                       class="btn btn-primary button-inline btn btn-primary btn-xl page-scroll button-install page-scroll"
                       href="#home-page">Get Started!</a>
                </div>
            </div>
        </div>
    </section>

    <section id="services" class="ced-blue-bg1">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                    <h2 class="section-heading">At Your Service</h2>
                    <hr class="primary">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">

                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 text-center">
                    <div class="service-box">
                        <img src="<?= Yii::$app->request->baseUrl; ?>/images/services/jet.png">
                        <hr>
                        <h6>Connect with Newegg</h6>
                        <p class="text-muted">Get notified automatically when any order is placed on Newegg for your
                            products!</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 text-center">
                    <div class="service-box">
                        <img src="<?= Yii::$app->request->baseUrl; ?>/images/services/Regular-Earning.png">
                        <hr>
                        <h6>Regular Earning</h6>
                        <p class="text-muted">Earn regularly with your products sold on Newegg.com.</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 text-center">
                    <div class="service-box">
                        <img src="<?= Yii::$app->request->baseUrl; ?>/images/services/DATE.png">
                        <hr>
                        <h6>Up to Date</h6>
                        <p class="text-muted">Remain updated every time something new happens to your products on
                            Newegg.com.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 text-center">
                    <div class="service-box">
                        <img src="<?= Yii::$app->request->baseUrl; ?>/images/services/Love-It.png">
                        <hr>
                        <h6>Love It</h6>
                        <p class="text-muted">You will love it when you use it!</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="bg-primary" id="pricing">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                    <h2 class="section-heading">Pricing</h2>
                    <span>Reasonable prices to cater your needs within your budget</span>
                    <hr class="primary">
                </div>
            </div>
        </div>
        <div class="container">
            <!-- <div class="col-xs-12 col-sm-6 col-sm-offset-3">
        <div class="jet-plan-wrapper active">
            <h3 class="plan-heading">Monthly plan</h3>
            <div class="plan-wrapper">
            <span class="price"><strong>$30</strong> per month</span>
                  <h3><b>(FREE 30 Days)</b></h3>
            <div class="clear"></div>
            <a href="https://apps.shopify.com/jet-integration" class="btn btn-primary button-inline btn btn-primary btn-xl page-scroll button-install">Add to cart</a>
            <div class="what-can-do">
        <p class="plush-sign1">+</p>
          <ul>
            <li>Unlimited Product Import</li>
            <li>Unlimited Order Fulfillment</li>
            <li>Inventory Synchronization</li>
            <li>Order Management</li>
            <li>Return Management</li>
            <li>Settlement</li>
          </ul>
            </div>
          </div>
        </div>
      </div>   -->
            <div class="shopify-plan-wrapper pricing-tables">
                <!--    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 shopify-plan-inner-wrap"></div> -->
                <div class="row clearfix">
                    <div class="col-lg-offset-2 col-md-offset-2 col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <div class="jet-plan-wrapper yearly-plan">
                            <h3 class="plan-heading">Yearly Plan</h3>
                            <div class="plan-wrapper">
                                <span class="old-price"></span>
                                <span class="price"><strong>$25</strong><span class="month">/month </span><br> (USD billed annually)</span>
                                <h3 class="free"><span>FREE 7 Days</span></h3>
                                <!-- <a href="http://cedcommerce.com/shopify-extensions/jet-shopify-integration"><div class="addtocart">Add to cart</div></a> -->
                                <p class="push-sign">Save 17%</p>

                            </div>
                            <div class="what-can-do">

                                <ul>
                                    <li>Simple and Variants Product Management</li>
                                    <li>Mapping Newegg Category with Product Type</li>
                                    <li>Inventory Synchronization</li>
                                    <li>Order Management</li>
                                    <li>Return Management</li>
                                    <li>Settlement</li>
                                    <li>Flat 17% Saving</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <div class="jet-plan-wrapper active monthly plan">
                            <h3 class="plan-heading">Half Yearly plan</h3>
                            <div class="plan-wrapper">
                                <span style="padding: 0px;margin-top:3%;" class="price"><strong> $27</strong><span
                                        class="month">/month</span><br>(USD billed half-yearly)</span>
                                <h3 class="free"><span>FREE 7 Days</span></h3>
                                <div class="clear"></div>
                                <!-- <a href="http://cedcommerce.com/shopify-extensions/jet-shopify-integration"><div class="addtocart">Add to cart</div></a> -->

                            </div>
                            <div class="what-can-do">

                                <ul>
                                    <li>Simple and Variants Product Management</li>
                                    <li>Mapping Newegg Category with Product Type</li>
                                    <li>Inventory Synchronization</li>
                                    <li>Order Management</li>
                                    <li>Return Management</li>
                                    <li>Settlement</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="extra-plane">
                    <div class="col-xs-12 col-md-12 col-sm-12 col-xs-12">
                        <h2 class="section-heading">Additional Perks</h2>
                        <hr class="primary">
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="plans">
                            <img height="auto" width="100"
                                 src="<?= Yii::$app->request->baseUrl; ?>/images/free_installation1.png"
                                 class="sub-feature-images1">
                            <div class="extra-features-text">Free Installation</div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="plans">
                            <img height="auto" width="100"
                                 src="<?= Yii::$app->request->baseUrl; ?>/images/free_support1.png"
                                 class="sub-feature-images1">
                            <div class="extra-features-text">Free Support</div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="plans">
                            <img height="auto" width="100" src="<?= Yii::$app->request->baseUrl; ?>/images/document.png"
                                 class="sub-feature-images1">
                            <div class="extra-features-text">Documentation</div>
                        </div>
                    </div>
                    <div style="clear:both"></div>
                </div>

            </div>
    </section>

    <!--    <section id="reviews" class="review-section">
            <div class="customer container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                        <h2 class="section-heading">What our client say</h2>
                        <hr class="primary">
                    </div>
                </div>
                <div class="customer-review">
                    <div class="text-center-1">

                        <div class="owl-carousel owl-theme customer-review-inner">
                            <div class="item">
                                <div class="bk-item">
                                    <div class="row">
                                        <div class="col-lg-offset-2 col-md-offset-2 col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                            <div class="img-wrapper">
                                                <div class="img-customer">
                                                    <img class="lazy-loading" data-src="/integration/images/bariatric.png" src="/integration/images/bariatric.png">
                                                    <span class="quote"><i class="fa fa-quote-left" aria-hidden="true"></i>
    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                                            <div class="">
                                                <div class="infomation-shop">
                                                    <div class="name-shop">
                                                        <h3 class="review-heading">I am super impressed . . .</h3>
                                                    </div>
                                                    <div class="review">
                                          <span class="rateit">
                                               <i class="glyphicon glyphicon-star"></i>
                                               <i class="glyphicon glyphicon-star"></i>
                                               <i class="glyphicon glyphicon-star"></i>
                                               <i class="glyphicon glyphicon-star"></i>
                                               <i class="glyphicon glyphicon-star"></i>
                                          </span>
                                                    </div>

                                                    <div class="information">
                                                        I am super impressed with this app. Within 72 hours we had over 500 of our products listed on Walmart.com . There are some little bugs or issues but overall we are very satisfied. Their support is also pretty responsive and helpful, even if english is their second language.
                                                    </div>
                                                    <div class="name">
                                                        <a target="_blank" href="https://store.bariatricpal.com/">- Bariatricpal</a>
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

        </section>
    -->


    <aside class="ced-blue-bg">
        <div class="container text-center">
            <div class="call-to-action">
                <span>Install the app for Free on Your Shopify Shop from CedCommerce!</span>
                <a href="#page-top" style=" margin: 0 0 0 10px;" class="btn btn-default btn-xl wow tada"
                   onClick="$('html,body').animate({scrollTop:0},'slow');return false;">Install Now!</a>
            </div>
        </div>
    </aside>

    <section id="contact" class="bg-primary">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h2 class="section-heading">Let's Get In Touch!</h2>

                    <span>Ready to start your Shopify-Newegg Integration with us? That's great! Give us a call or send us an email and we will get back to you as soon as possible!</span>
                    <hr class="primary">
                </div>
                <div class="col-lg-4 col-lg-offset-2 text-center">
                    <i class="fa fa-ticket fa-3x wow bounceIn"></i>
                    <p><a href="http://support.cedcommerce.com" target="_blank">support.cedcommerce.com</a></p>
                </div>
                <div class="col-lg-4 text-center">
                    <i class="fa fa-envelope-o fa-3x wow bounceIn" data-wow-delay=".1s"></i>
                    <p><a href="mailto:shopify@cedcommerce.com">shopify@cedcommerce.com</a></p>
                </div>
            </div>
        </div>
    </section>


    <!-- jQuery -->
    <?php /* <script src="js/jquery.js"></script>*/ ?>

    <!-- Bootstrap Core JavaScript -->
    <?php /*<script src="js/bootstrap.min.js"></script> */ ?>

    <!-- Plugin JavaScript -->

    <?php $this->registerJsFile(Yii::$app->request->baseUrl . '/js/bootstrap.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>

    <?php $this->registerJsFile(Yii::$app->request->baseUrl . '/js/jquery.easing.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>
    <?php $this->registerJsFile(Yii::$app->request->baseUrl . '/js/jquery.fittext.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>
    <?php $this->registerJsFile(Yii::$app->request->baseUrl . '/js/wow.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>

    <?php $this->registerJsFile(Yii::$app->request->baseUrl . '/js/creative.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>

    <?php /*
    <script src="js/jquery.easing.min.js"></script>
    <script src="js/jquery.fittext.js"></script>
    <script src="js/wow.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/creative.js"></script> */ ?>

    <!-- Custom Fonts -->
    <link
        href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800'
        rel='stylesheet' type='text/css'>
    <link
        href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic'
        rel='stylesheet' type='text/css'>


    <script>

    </script>
    <style type="text/css">
        @media only screen and (min-width: 767px) {
            .navbar.navbar-default.navbar-fixed-top.affix-top, .navbar.navbar-default.navbar-fixed-top.affix {
                padding: 25px !important;
            }
        }

        .trial-nav-wrap .navbar-fixed-top {
            height: 75px;
            /*top: 0;*/
        }
        @media only screen and (min-width: 767px) {
            .sticky .navbar.navbar-default.navbar-fixed-top.affix-top, .sticky .navbar.navbar-default.navbar-fixed-top.affix {
                padding: 25px;
            }
        }

        .sticky .trial-nav-wrap .navbar-fixed-top {
            height: 75px;
            /*top: 0;*/
        }


        .sticky .navbar-default .navbar-nav > li > a {
            font-size: 14px;
            padding: 5px;
        }
        .sticky ul li:last-child .page-scroll {
            font-weight: bold !important;
        }
    </style>

