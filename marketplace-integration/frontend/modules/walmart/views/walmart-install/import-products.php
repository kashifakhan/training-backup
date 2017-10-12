<?php
use yii\helpers\Html;
use yii\widgets\Pjax;
use frontend\modules\walmart\models\WalmartProduct;
use frontend\modules\walmart\components\Data;
use frontend\modules\walmart\controllers\WalmartproductimportController;
use frontend\modules\walmart\components\PricingPlaninfo;


$this->title = 'Import Products';
$same_sku_array_count = 0;
$merchant_id = Yii::$app->user->identity->id;
$query = "SELECT `shop_url` from `walmart_shop_details` where `merchant_id`=" . $merchant_id;
$shopUrl = Data::sqlRecords($query, 'one');
$shop_url = is_array($shopUrl) && isset($shopUrl['shop_url']) ? trim($shopUrl['shop_url']) : "";
$urlTotal = Data::getUrl('walmartproductimport/gettotaldetails');
$varUrl = yii::$app->request->baseUrl . '/var/importproduct/' . $merchant_id . '/';
$url = Data::getUrl('walmartproductimport/batchimport');
$viewUrl = Data::getUrl('walmartproductimport/viewerroredproduct');
$file_exist = Data::getUrl('walmartproductimport/fileexist');
//$iframe_view = Data::getUrl('walmartproductimport/iframeview');
$file_content = Data::getUrl('walmartproductimport/getfilecontent');
$succes_img = yii::$app->request->baseUrl . '/frontend/images/batchupload/fam_bullet_success.gif';
$error_img = yii::$app->request->baseUrl . '/frontend/images/batchupload/error_msg_icon.gif';
$loader_img = yii::$app->request->baseUrl . '/frontend/images/batchupload/rule-ajax-loader.gif';

//$product_limit_count = PricingPlaninfo::getProductlimit($merchant_id);

?>
<style type="text/css">
    .shopify-api ul {
        list-style-type: none;
        padding: 0;
        margin: 0;
    }

    .shopify-api ul li {
        margin-left: 0;
        border: 1px solid #ccc;
        margin: 2px;
        padding: 2px 2px 2px 2px;
        font: normal 12px sans-serif;
    }

    .shopify-api img {
        margin-right: 5px;
    }

    li span ul li {
        border: 0px !important;
        margin-left: 18px !important;
    }

    #radio_span input {
        opacity: 10 !important;
    }

    .radio span, label.radio-inline .radio-span {
        position: static;
        height: auto !important;
    }

    label.checkbox-label {
        display: inline-block;
        font-size: 13px;
        padding-left: 0;
    }
</style>
<div class="import-products-step content-section">
    <div class="clearfix">
        <div id="import-error" class="help-block help-block-error top_error alert-danger"
             style="display: none;border-radius: 4px;margin-bottom: 10px;padding: 10px;"></div>
        <div class="import-content-wrapper">
            <div class="import-dropdown required">
                <span class="value_label">Import Product Options</span>
                <select class="import-select form-control" name="import-select" id="import-select"
                        onchange="getTotalDetails(this,0);">
                    <option value="">Select Option to import...</option>
                    <option value="any">All Products</option>
                    <option value="published">Published Products</option>
                    <option value="custom">Select Products to import</option>
                </select>
            </div>

            <table class="table table-striped table-bordered" id="total-display" cellspacing="0" style="display:none;">
                <tbody>
                <tr class="total-product-variant-tr">
                    <td class="value_label total_variant">
                        <span>Total Product(s) Including Variants</span>
                    </td>
                    <td class="value">
                        <span id="total-product-variant"></span>
                    </td>
                </tr>
                <tr class="total-products-tr">
                    <td class="value_label total_value">
                        <span>Total Main Product(s) Available</span>
                    </td>
                    <td class="value">
                        <span id="total-products-available"></span>
                    </td>
                </tr>

                <tr class="not-sku-tr">
                    <td class="value_label not_ksu">
                        <span>Product(s) not having "Sku"</span>
                    </td>
                    <td class="value">
                        <span id="non-sku-products"></span>
                    </td>
                    <td class="view">
                        <span id="non-sku-products-view"></span>
                    </td>
                </tr>

                <tr class="not-sku-tr">
                    <td class="value_label not_ksu">
                        <span>Product(s) having Duplicate "Sku"</span>
                    </td>
                    <td class="value">
                        <span id="same-sku-products"></span>
                    </td>
                    <td class="view">
                        <span id="same-sku-products-view"></span>
                    </td>
                </tr>
                <tr class="not-sku-tr">
                    <td class="value_label not_ksu">
                        <span>Product(s) not having "Product Type"</span>
                    </td>
                    <td class="value">
                        <span id="non-type-products"></span>
                    </td>
                    <td class="view">
                        <span id="non-type-products-view"></span>
                    </td>
                </tr>
                <tr class="ready-products-tr">
                    <td class="value_label rem_value">
                        <span>Product(s) Ready To Import</span>
                    </td>
                    <td class="value">
                        <span id="ready-products"></span>
                    </td>
                </tr>
                <tr class="radio">
                    <td class="value">
                        <span id="radio_span" class="radio-span"></span>
                    </td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="2">
                        <button class="btn btn-primary" id="start-import-button">Start Import</button>
                    </td>
                </tr>
                </tfoot>
            </table>

            <!-- Import Selected Products -->
            <div class="" id="custom-product-import" style="display: none;">
                <table class="table table-striped table-bordered" cellspacing="0">
                    <tbody>
                    <tr class="total-product-variant-tr">
                        <td class="value_label total_variant">
                            <span>Total Product(s) Including Variants</span>
                        </td>
                        <td class="value">
                            <span id="total-variant-product"></span>
                        </td>
                    </tr>
                    <tr class="total-products-tr">
                        <td class="value_label total_value">
                            <span>Total Main Product(s) Available</span>
                        </td>
                        <td class="value">
                            <span id="total-available-products"></span>
                        </td>
                    </tr>
                    <tr class="not-sku-tr">
                        <td class="value_label not_ksu">
                            <span>Product(s) not having "Sku"</span>
                        </td>
                        <td class="value">
                            <span id="not-sku-products"></span>
                        </td>
                        <td class="view">
                            <span id="select_non-sku-products-view"></span>
                        </td>
                    </tr>
                    <tr class="not-sku-tr">
                        <td class="value_label same_ksu">
                            <span>Product(s) having Duplicate "Sku"</span>
                        </td>
                        <td class="value">
                            <span id="sames-sku-products"></span>
                        </td>
                        <td class="view">
                            <span id="select_same-sku-products-view"></span>
                        </td>
                    </tr>
                    <tr class="not-sku-tr">
                        <td class="value_label not_ksu">
                            <span>Product(s) not having "Product Type"</span>
                        </td>
                        <td class="value">
                            <span id="not-type-products"></span>
                        </td>
                        <td class="view">
                            <span id="select_non-type-products-view"></span>
                        </td>

                    </tr>
                    <tr class="ready-products-tr">
                        <td class="value_label rem_value">
                            <span>Product(s) Ready To Import</span>
                        </td>
                        <td class="value">
                            <span id="ready-to-import-products"></span>
                        </td>
                    </tr>
                    <tr class="radio">
                        <td class="value">
                            <span id="select_radio_span"></span>
                        </td>
                    </tr>
                    </tbody>
                </table>


                <div class="product-table-wrapper">


                    <div class="filter_products">
                        <div class="pro_selected"><span id="selected_count">0</span> Products Selected.
                        </div>
                        <div class="filterContainer">
                            <button class="search_product">filter products <i class="fa fa-filter"
                                                                              aria-hidden="true"></i>
                                <i class="fa fa-angle-down down-arrow" aria-hidden="true"></i>
                            </button>

                            <fieldset class="filter-fieldset" style="display: none;">
                                <div class="filters">
                                    <label for="sku-filter">
                                        <span>Sku</span>
                                    </label>
                                    <div>
                                        <input type="text" class="form-control filter" name="sku" id="sku-filter">
                                    </div>
                                </div>
                                <div class="filters">
                                    <label for="title-filter">
                                        <span>Title</span>
                                    </label>
                                    <div>
                                        <input type="text" class="form-control filter" name="title" id="title-filter">
                                    </div>
                                </div>
                                <div class="filters-footer">
                                    <div class="filter-actions">
                                        <button type="button" class="action" onclick="resetFilter()">
                                            <span>Reset</span>
                                        </button>
                                        <button type="button" class="action" onclick="applyFilter()">
                                            <span>Apply</span>
                                        </button>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    <table class="table table-striped table-bordered product-table" cellspacing="0">
                        <thead>
                        <tr>
                            <th><input type="checkbox" id="select_all" class="check_box" value="1"
                                       onclick="selectAll(this)"/></th>
                            <th>SKU</th>
                            <th>TITLE</th>
                            <th>PRICE</th>
                            <th>QTY</th>
                        </tr>
                        </thead>

                        <tbody id="custom-product-rows">
                        </tbody>
                    </table>
                </div>
                <div>
                    <input type="hidden" id="selectedids" name="selectedIds" value=""/>
                    <input type="hidden" id="filterapplied" value="0"/>
                    <button class="btn btn-primary" onclick="startCustomProductImport(this)">Start Import</button>
                </div>
            </div>
            <!-- Import Selected Products End -->
        </div>

        <!-- *******************************************AJAX IMPORT****************************************** -->
        <div class="row ajax-import-wrapper" id="ajax-import-wrapper" style="display:none;">
            <div class="col-md-12" style="margin-top: 10px;">
                <div class="panel panel-default">
                    <div class="jet-pages-heading">
                        <h2 class="Jet_Products_style">Product Import Status</h2>
                        <!--<a href="<?php //echo $ipmort_url;?>">
								<button class="btn btn-primary uptransform" type="button" title="Back"><span>Back</span></button>
							</a>-->
                        <div class="clear"></div>
                    </div>
                    <div style="display:none;" id="success-import-msg"
                         class="alert alert-success fade in alert-dismissable" style="margin-top:18px;">
                        <strong class="succes-msg">Successfully Imported!</strong> Now click on <strong
                                class="next-proto">Next</strong> button to proceed.
                    </div>
                    <div class="block-content panel-body shopify-api ">
                        <ul class="warning-div" style="margin-top: 18px">
                            <li style="background-color:#Fff;">
                                <img src="<?php echo yii::$app->request->baseUrl . '/frontend/images/batchupload/note_msg_icon.gif'; ?>"
                                     class="v-middle" style="margin-right:5px"/>
                                Starting Product Import execution, please wait...
                            </li>
                            <li style="background-color:#FFD;">
                                <img src="<?php echo yii::$app->request->baseUrl . '/frontend/images/batchupload/fam_bullet_error.gif'; ?>"
                                     class="v-middle" style="margin-right:5px"/>
                                Warning: Please do not close the window during import data
                            </li>
                        </ul>

                        <ul id="profileRows">
                            <li style="background-color:#DDF; ">
                                <img class="v-middle" src="<?php echo $succes_img ?>">
                                Total <span id="total_show"></span> Product(s) Found.
                            </li>
                            <li style="background-color:#DDF;" id="update_row">
                                <img class="v-middle" id="status_image" src="<?php echo $loader_img ?>">
                                <span id="update_status" class="text">Updating...</span>
                            </li>
                            <li id="liFinished" style="display:none;background-color:#Fff;">
                                <img src="<?php echo yii::$app->request->baseUrl . '/frontend/images/batchupload/note_msg_icon.gif'; ?>"
                                     class="v-middle" style="margin-right:5px"/>
                                Finished product import execution.
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <button class="next btn btn-primary pull-right" id="import-next">Next</button>
    </div>
</div>

<script>
    $('#start-import-button').attr('disabled', true);
    $('#radio_span').on('change', 'input[name=sku]', function () {
        var val = $('input[name=sku]:checked', '#radio_span').val();
        if (val == 'custom_sku') {
            $('#custom_permission').html('<input value="yes" type="checkbox" id="update-on-shopify" /><!--<label for="update-on-shopify" class="checkbox-label">--> <b>Update New Sku on Shopify Store</b> (New Sku will be updated on shopify for those Products which are having Missing Sku Or Duplicate Sku)<!--</label>-->');
            $('#start-import-button').attr('disabled', false);
        }
        else {
            $('#custom_permission').html('');
            $('#start-import-button').attr('disabled', false);
        }
    });

    var customProductListData = '';
    var selectedProductIds = [];

    var csrfToken = $('meta[name=csrf-token]').attr("content");
    var totalRecords = 0;
    var pages = 0;
    var countOfSuccess = 0;
    var notSku = 0;
    var sameskucount = 0;
    var notType = 0;
    var id = 0;
    var my_id = document.getElementById('liFinished');
    var update_status = document.getElementById('update_status');
    var update_row = document.getElementById('update_row');
    var status_image = document.getElementById('status_image');
    var merchant_id = '<?= $merchant_id ?: 0;?>';
    var limit = 250;
    var total_variants_product = 0;

    UnbindNextClick();

    $('.next').on('click', function () {
        if (countOfSuccess > 0) {
            nextStep();
        } else {
            $('#import-error').html("Can't proceed to Next Step. Please Import Product(s), then click <strong>Next</strong> button.");
        }
    });

    $('.next').attr('disabled', true);

    function loopTotalDetails(flag, url, page, selectVal, non_sku_total=0, non_type_total=0, total_variants_prod=0) {
        var response = null;

        $.ajax({
            method: "post",
            url: url,
            async: false,
            dataType: 'json',
            data: {
                select: selectVal,
                limit: limit,
                page: page,
                non_sku_total: non_sku_total,
                total_variants_prod: total_variants_prod,
                non_type_total: non_type_total,
                merchant_id: merchant_id,
                _csrf: csrfToken
            }
        })
            .done(function (msg) {
                //console.log(msg);
                if ($.isEmptyObject(msg) || (!$.isEmptyObject(msg) && msg.hasOwnProperty('err'))) {
                    var error = (!$.isEmptyObject(msg) && msg.hasOwnProperty('err')) ? msg.err : "Error - No product(s) found.";
                    //$('#import-error').html(error);
                    //$('#import-error').show();
                    response = error;
                } else {
                    response = msg;
                }
                //console.log(response);
                //$('#LoadingMSG').hide();
            });
        return response;
    }

    function getTotalDetails(ele, flag) {
        $('#import-error').hide();
        $('#custom-product-import').hide();
        $('#total-display').hide();
        var selectVal = $(ele).val();
        if (selectVal != "") {
            var existurl = '<?= $file_exist; ?>';
            $.ajax({
                url: existurl,
                success: function (data) {
                },
                error: function (data) {
                },
            })
        }
        var asyn = false;
        var page = 1;
        var total_ready_prod = 0;
        var total_prod = 0;
        var total_non_sku_prod = 0;
        var total_non_type_prod = 0;
        var total_variants_prod = 0;
        var response = null;
        var products;
        if (selectVal != "") {
            var url = '<?= $urlTotal ?: ""; ?>';
            $('#LoadingImg').show();
            $('#LoadingImg .loadingimg-outer').show();
            $('#LoadingImg #loading-msg').show();
            if (!flag) {
                asyn = true;
            }
            /*---------added starts -----------------*/

            response = loopTotalDetails(false, url, page, selectVal, total_non_sku_prod, total_non_type_prod, total_variants_prod);

            var totalDetailPercent = Math.ceil(((page) / Math.ceil(total_prod / limit)) * 1000) / 10;
            $('#LoadingImg #loading-text').html(totalDetailPercent + '%');
            $('#LoadingImg #loading-text').show();

            page++;
            if (response !== null && typeof response === 'object') {
                total_ready_prod = response.ready;
                total_non_sku_prod = response.non_sku;
                total_non_type_prod = response.non_type;
                total_prod = response.total;
                total_variants_prod = response.total_variants_prod;
                products = response.products;
            } else {
                $('#import-error').html(response);
                $('#import-error').show();

                $('#LoadingImg').hide();
                $('#LoadingImg .loadingimg-outer').hide();
                $('#LoadingImg #loading-text').html('');
                $('#LoadingImg #loading-text').hide();
                $('#LoadingImg #loading-msg').hide();
                return;
            }
            var fg = true;

            while (page <= Math.ceil(total_prod / limit)) {

                var totalDetailPercent = Math.ceil(((page) / Math.ceil(total_prod / limit)) * 1000) / 10;
                $('#LoadingImg #loading-text').html(totalDetailPercent + '%');
                $('#LoadingImg #loading-text').show();

                response = loopTotalDetails(false, url, page, selectVal, total_non_sku_prod, total_non_type_prod, total_variants_prod);
//						console.log(total_variants_prod);
//						console.log(response);
                if (response !== null && typeof response === 'object') {
                    total_ready_prod += response.ready;
                    total_non_sku_prod += response.non_sku;
                    total_non_type_prod += response.non_type;
                    total_variants_prod += response.total_variants_prod;
                    total_prod = response.total;
                    products = Object.assign({}, products, response.products);
                } else {
                    $('#import-error').html(response);
                    $('#import-error').show();

                    $('#LoadingImg').hide();
                    $('#LoadingImg .loadingimg-outer').hide();
                    $('#LoadingImg #loading-text').html('');
                    $('#LoadingImg #loading-text').hide();
                    $('#LoadingImg #loading-msg').hide();
                    fg = false;
                    return;
                }
                page++;
            }
            if (!fg) {
                return;
            }
//            console.log(total_variants_prod);
            //console.log(products);
//                    alert(selectVal);
            if (selectVal == 'custom') {
                customProductListData = {
                    total: total_prod,
                    products: products,
                    ready: total_ready_prod,
                    non_sku: total_non_sku_prod,
                    non_type: total_non_type_prod,
                    total_variant : total_variants_prod
                };
                customProductList(customProductListData);
            } else
                {
                var same_sku_array = new Array();
                var varurl = '<?= $varUrl; ?>';
                var viewUrl = '<?= $viewUrl;?>';
                var file_content = '<?= $file_content; ?>';
                //var same_sku_array = new Array();
                $.ajax({
                    url: file_content,
                    success: function (data) {
                        if (data) {
                            var same_sku = $.trim(data, ',');
                            same_sku = same_sku.replace(',', '');
                            same_sku_array = same_sku.split(',');
                            sameskucount = same_sku_array.length;
                        }
                        $('#non-sku-products').html(total_non_sku_prod);
                        /*if(total_non_sku_prod>0){
                         $('#non-sku-products-view').html('<a target ="_blank" href="'+viewUrl+'?file=notsku">view</a>');
                         }
                         if(same_sku_array.length>0){
                         $('#same-sku-products-view').html('<a target ="_blank" href="'+viewUrl+'?file=samesku">view</a>');
                         }
                         if(total_non_type_prod>0){
                         $('#non-type-products-view').html('<a target ="_blank" href="'+viewUrl+'?file=notProductType">view</a>');
                         }*/
                        if (total_non_sku_prod > 0) {
                            $('#non-sku-products-view').html('<a class="yourlink" data-index="notsku">view</a>');
                        }
                        if (sameskucount > 0) {
                            $('#same-sku-products-view').html('<a class="yourlink" data-index="samesku">view</a>');
                        }
                        if (total_non_type_prod > 0) {
                            $('#non-type-products-view').html('<a class="yourlink" data-index="notProductType">view</a>');
                        }
                        $('#same-sku-products').html(sameskucount);
                        if (sameskucount > 0 || total_non_sku_prod > 0) {
                            $('#radio_span').html('<ul><li><input type="radio" name="sku" class="sku_radio" value="custom_sku"> <b>Import All products </b> (Excluding the missing Product Type ones. New Sku will be assigned to those products having Missing Or Duplicate Sku in our app.)<ul><li id="custom_permission"></li></ul></li><li><input type="radio" class="sku_radio" name="sku" value="nochange"><b>Import Only ready To import</b></li></ul>');
                        }
                        else {
                            $("#start-import-button").attr('disabled', false);
                        }
                        if (total_ready_prod > same_sku_array.length) {
                            $('#ready-products').html(total_ready_prod - sameskucount);
                        } else {
                            $('#ready-products').html(sameskucount - total_ready_prod);
                        }
                        $('#total-products-available').html(total_prod);
                        $('#total-product-variant').html(total_variants_prod);
                        $('#non-type-products').html(total_non_type_prod);
                        $('#total-display').css("display", "block");
                    },
                    error: function (data) {
                    },
                })
                /*	$.get(varurl+'samesku.txt')
                 .done(function(data) {
                 var same_sku = $.trim(data,',');
                 same_sku = same_sku.replace(',','');
                 same_sku_array = same_sku.split(',');
                 $('#non-sku-products').html(total_non_sku_prod);
                 if(total_non_sku_prod>0){
                 $('#non-sku-products-view').html('<a target ="_blank" href="'+viewUrl+'?file=notsku">view</a>');
                 }
                 if(total_non_sku_prod>0){
                 $('#same-sku-products-view').html('<a target ="_blank" href="'+viewUrl+'?file=samesku">view</a>');
                 }
                 if(total_non_sku_prod>0){
                 $('#non-type-products-view').html('<a target ="_blank" href="'+viewUrl+'?file=notProductType">view</a>');
                 }
                 $('#same-sku-products').html(same_sku_array.length);
                 if(same_sku_array.length>0 || total_non_type_prod>0){
                 $('#radio_span').html('<ul><li><input type="radio" name="sku" class="sku_radio" value="custom_sku"> Import All products (Excluding the missing Product Type ones. New Sku will be assigned to those products having Missing Or Duplicate Sku.)<ul><li id="custom_permission"></li></ul></li><li><input type="radio" class="sku_radio" name="sku" value="nochange">Import Only ready To import</li></ul>');
                 }
                 $('#ready-products').html(total_ready_prod-same_sku_array.length);
                 $('#total-products-available').html(total_prod);
                 $('#non-type-products').html(total_non_type_prod);
                 $('#total-display').css("display","block");
                 }).fail(function() {
                 });*/
            }
            $('#LoadingImg').hide();
            $('#LoadingImg .loadingimg-outer').hide();
            $('#LoadingImg #loading-text').html('');
            $('#LoadingImg #loading-text').hide();
            $('#LoadingImg #loading-msg').hide();
            /*---------added ends -----------------*/
            /*$.ajax({
             method: "post",
             url: url,
             async: asyn,
             dataType: 'json',
             data: {select:selectVal,merchant_id : merchant_id,_csrf : csrfToken}
             })
             .done(function(msg){
             //console.log(msg);
             if($.isEmptyObject(msg) || (!$.isEmptyObject(msg) && msg.hasOwnProperty('err'))) {
             var error = (!$.isEmptyObject(msg) && msg.hasOwnProperty('err')) ? msg.err : "Error - No product(s) found.";
             $('#import-error').html(error);
             $('#import-error').show();
             }else{
             if(selectVal == 'custom') {
             customProductList(msg);
             } else {
             $('#total-products-available').html(msg.total);
             $('#non-sku-products').html(msg.non_sku);
             $('#non-type-products').html(msg.non_type);
             $('#ready-products').html(msg.ready);
             $('#total-display').css("display","block");
             }
             }
             $('#LoadingMSG').hide();
             });*/
        } else {

            $('#total-products-available').html('');
            $('#non-sku-products').html('');
            $('#ready-products').html('');
            $('#total-display').css("display", "none");
        }
    }

    $("#start-import-button").click(function () {
        //console.log(parseInt($('#ready-products').html()));
        //getTotalDetails("#import-select",1);
//        var product_limit_count = '<?//= $product_limit_count; ?>//';
        var total_import = $('#total-products-available').html();

        /*if (total_import < product_limit_count) {
            alert("Your " + product_limit_count + " Products can Import Now");
            total_import = product_limit_count;
        }
        if (product_limit_count < limit) {
            limit = product_limit_count;
        }*/
        if (parseInt($('#ready-products').html()) > 0) {
            $('#import-content-wrapper').fadeTo("fast", 0.1);
            $("#start-import-button").attr('disabled', true);
            $("#import-select").attr('disabled', true);
            $("input[type=radio]").attr('disabled', true);
            $('#ajax-import-wrapper').css('display', 'block');
            totalRecords = parseInt(total_import);
            $('#total_show').html(totalRecords);
            pages = Math.ceil(parseInt(total_import) / limit);
            uploaddata();
        }
    });

    function uploaddata() {
        var custom_sku = false;
        var create_custom = false;
        percent = getPercent();
        update_status.innerHTML = percent + '% Page ' + (id + 1) + ' Of total product pages ' + pages + ' Processing';
        var select = $('#import-select').val();
        if ($('.sku_radio').is(':checked')) {
            var val = $('.sku_radio:checked').val();
            if (val == 'custom_sku') {
                var create_custom = true;
            }
        }

        if ($('#custom_permission input').prop("checked") == true) {
            custom_sku = true;
        }
        else if ($('#custom_permission input').prop("checked") == false) {
            custom_sku = false;
        }

        $.ajax({
            url: "<?= $url?>",
            method: "post",
            dataType: 'json',
            data: {
                index: id + 1,
                _csrf: csrfToken,
                select: select,
                merchant_id: merchant_id,
                pages: pages,
                limit: limit,
                customsku: custom_sku,
                create_custom: create_custom
            },
            success: function (json) {//transport
                //var json = transport.responseText.evalJSON();
                id++;
                if (json.hasOwnProperty('success') && json.success) {
//                    console.log(json.success);
                    countOfSuccess += json.success.count;
                    notSku += json.success.not_sku;
                    notType += json.success.not_type;
                    sameskucount += json.success.sameskucount;
                    var span = document.createElement('li');
                    span.innerHTML = '<img class="v-middle" src="<?php echo $succes_img ?>"><span class="text">' + json.success.count + ' products imported of page ' + id + '...</span>';
                    span.id = 'id-' + id;
                    span.style = 'background-color:#DDF';
                    update_row.parentNode.insertBefore(span, update_row);
                }
                if (json.hasOwnProperty('error') && json.error) {
                    var span = document.createElement('li');
                    span.innerHTML = '<img class="v-middle" src="<?php echo $error_img ?>"><span class="text">' + json.error + '</span>';
                    span.id = 'id-' + id;
                    span.style = 'background-color:#FDD';
                    update_row.parentNode.insertBefore(span, update_row);
                }
                if (id + 1 <= pages) {
                    uploaddata();
                } else {
                    status_image.src = '<?php echo $succes_img ?>';
                    var span = document.createElement('li');
                    var textMsg = '';
                    var fst = ' and ';
                    if (notSku && notSku > 0) {
                        textMsg = notSku + " product(s) unable to import due to missing product sku(s)";
                    }
                    if (notType && notType > 0) {
                        if (textMsg != "") {
                            fst = ', ';
                            textMsg += " and " + notType + " product(s) unable to import due to missing product type";
                        } else {
                            textMsg = notType + " product(s) unable to import due to missing product type";
                        }
                    }
                    if (sameskucount && sameskucount > 0) {
                        if (textMsg != "") {
                            fst = ', ';
                            textMsg += " and " + sameskucount + " product(s) unable to import due to duplicate sku";
                        } else {
                            textMsg = sameskucount + " product(s) unable to import due to duplicate sku";
                        }
                    }
                    if (textMsg != "") {
                        textMsg = fst + textMsg;
                    }
                    span.innerHTML = '<img class="v-middle" src="<?php echo $succes_img ?>"><span id="update_status" class="text">' + countOfSuccess + ' Product(s) Successfully Imported' + textMsg + '.' + '</span>';

                    span.style = 'background-color:#DDF';
                    my_id.parentNode.insertBefore(span, my_id);
                    //$('liFinished').show();
                    document.getElementById("liFinished").style.display = "block";
                    $(".warning-div").hide();
                    $("#profileRows").css({'margin-top': '10px'});
                    update_status.innerHTML = percent + '% ' + (id) + ' Of ' + pages + ' Processed.';

                    if (countOfSuccess > 0) {
                        $('.next').attr('disabled', false);
                        $("#success-import-msg").css('display', 'block');
                    } else {
                        $('#import-error').html("Can't proceed to Next Step. Please update Shopify Product(s) details on your Store and then Continue with <strong>Step " + CURRENT_STEP_ID + ": Import Products</strong> Step by <strong>reloading</strong> the page.");
                    }

                }
            },
            error: function () {
                id++;
                var span = document.createElement('li');
                span.innerHTML = '<img class="v-middle" src="<?php echo $error_img ?>"><span class="text">Something Went Wrong </span>';
                span.id = 'id-' + id;
                span.style = 'background-color:#FDD';
                update_row.parentNode.insertBefore(span, update_row);
                if (id + 1 <= pages) {
                    uploaddata();
                } else {
                    status_image.src = '<?php echo $succes_img ?>';
                    var span = document.createElement('li');
                    span.innerHTML = '<img class="v-middle" src="<?php echo $succes_img ?>"><span id="update_status" class="text">' + countOfSuccess + ' Product(s) Successfully Uploaded.' + '</span>';
                    span.style = 'background-color:#DDF';
                    my_id.parentNode.insertBefore(span, my_id);
                    //$('liFinished').show();
                    $(".warning-div").hide();
                    $("#profileRows").css({'margin-top': '10px'});
                    document.getElementById("liFinished").style.display = "block";
                }
            }
        });
    }

    function getPercent() {
        return Math.ceil(((id + 1) / pages) * 1000) / 10;
    }

    /* Import Selected Products */
    Array.prototype.remove = function () {
        var what, a = arguments, L = a.length, ax;
        while (L && this.length) {
            what = a[--L];
            while ((ax = this.indexOf(what)) !== -1) {
                this.splice(ax, 1);
            }
        }
        return this;
    };

    var products;

    //customProductList(msg, {sku:"AKT", title:"3M"}, ['361133717','361133725','361133745']);
    function customProductList(object, filters=null, checked=null) {
        $('#custom-product-rows').html('');
        if (object.hasOwnProperty('products')) {
            products = object.products;
//            console.log(Object.keys(products).length);
            if (Object.keys(products).length) {
                $.each(products, function (index, product) {
                    var productId = product.id;
                    var title = product.title;

                    var variant = product.variants[0];

                    var sku = variant.sku;
                    var price = variant.price;
                    var qty = variant.inventory_quantity;

                    var checkedStr = '';
                    if (checked == 'all') {
                        checkedStr = 'checked="checked"';
                    }
                    else if (checked != null && Array.isArray(checked)) {
                        if ($.inArray(productId.toString(), checked) != -1) {
                            checkedStr = 'checked="checked"';
                        }
                    }

                    var flag = false;
                    if (filters != null && (typeof filters === "object")) {
                        $.each(filters, function (key, value) {
                            value = value.trim();
                            if (key == "sku" && value != '' && sku.indexOf(value) == -1) {
                                flag = true;
                                return false;//break
                            }

                            if (key == "title" && value != '' && title.indexOf(value) == -1) {
                                flag = true;
                                return false;//break
                            }
                        });
                    }

                    if (flag) {
                        return true;//continue
                    }

                    var html = '<tr>';
                    html += '<td><input type="checkbox"' + checkedStr + ' name="productId[]" value="' + productId + '" class="product_check check_box" onclick="selectOne(this)" /></td>';
                    html += '<td>' + sku + '</td>';
                    html += '<td>' + title + '</td>';
                    html += '<td>' + price + '</td>';
                    html += '<td>' + qty + '</td>';
                    html += '</tr>';
                    $('#custom-product-rows').append(html);
                });
            }
            else {
                var html = '<tr><td colspan="5">No products found for import.</td></tr>';
                $('#custom-product-rows').append(html);
            }
        }
        var file_content = '<?= $file_content; ?>';
        var same_sku_array = new Array();
        console.log(object);
        $.ajax({
            url: file_content,
            success: function (data) {
                if (data) {
                    var same_sku = $.trim(data, ',');
                    same_sku = same_sku.replace(',', '');
                    same_sku_array = same_sku.split(',');
                    sameskucount = same_sku_array.length;
                }
                var viewUrl = '<?= $viewUrl;?>';
                if (object.non_sku > 0) {
                    $('#select_non-sku-products-view').html('<a class="yourlink" data-index="notsku">view</a>');
                }
                if (sameskucount > 0) {

                    $('#select_same-sku-products-view').html('<a class="yourlink" data-index="samesku">view</a>');
                }
                if (object.non_type > 0) {
                    $('#select_non-type-products-view').html('<a class="yourlink" data-index="notProductType">view</a>');
                }
                if (same_sku_array.length > 0 || object.non_sku > 0) {
                }
                $('#not-sku-products').html(object.non_sku);
                $('#sames-sku-products').html(sameskucount);
                if (object.ready > sameskucount) {
                    $('#ready-to-import-products').html(object.ready - sameskucount);
                } else {
                    $('#ready-to-import-products').html(sameskucount - object.ready);
                }
                $('#total-available-products').html(object.total);
                $('#total-variant-product').html(object.total_variant);

                $('#not-type-products').html(object.non_type);
                $("#custom-product-import").show();
            },
            error: function (data) {
            },
        })
    }

    function applyFilter() {
        $('#LoadingMSG').show();

        $('#filterapplied').val('1');

        var filters = {sku: "", title: ""};

        var checked = selectedProductIds;

        $.each($(".filter"), function () {

            var name = $(this).attr('name');
            var value = $(this).val();

            if (filters.hasOwnProperty(name)) {
                filters[name] = value;
            }
        });

        if (selectedProductIds == 'all' || (Array.isArray(selectedProductIds) && Object.keys(customProductListData.products).length == selectedProductIds.length)) {
            $("#select_all").prop("checked", true);
        } else {
            $("#select_all").prop("checked", false);
        }

        //console.log(filters);
        //console.log(customProductListData);
        //console.log(checked);
        customProductList(customProductListData, filters, checked);

        $('#LoadingMSG').hide();
    }

    function resetFilter() {
        $('#LoadingMSG').show();

        $('#filterapplied').val('0');

        $.each($(".filter"), function () {

            var value = $(this).val('');

        });

        if (selectedProductIds == 'all' || (Array.isArray(selectedProductIds) && Object.keys(customProductListData.products).length == selectedProductIds.length)) {
            $("#select_all").prop("checked", true);
        } else {
            $("#select_all").prop("checked", false);
        }

        customProductList(customProductListData, null, selectedProductIds);

        $('#LoadingMSG').hide();
    }

    function selectAll(element) {
        if (selectedProductIds == 'all') {
            selectedProductIds = [];
        }

        if ($(element).is(':checked')) {
            $('.product_check').prop('checked', true);
            /*raza
             var product_limit_count = ' $product_limit_count; ';
             var productIds = [];
             $.each($("input[name='productId[]']:checked"), function(){
             productIds.push($(this). val());
             });
             if (product_limit_count < productIds.length) {
             alert("You can import only "+product_limit_count+" Products");
             if($(element).is(':checked')) {
             $('.product_check').prop('checked', false);
             $("#select_all").prop("checked", false);
             $('#selectedids').val('');
             }
             return false;
             }
             end*/
            if ($('#filterapplied').val() == '0') {
                selectedProductIds = 'all';
            }
            else {
                var Checked = [];
                $.each($("input[name='productId[]']:checked"), function () {
                    var val = $(this).val();
                    Checked.push(val);
                });

                Checked.forEach(function (checkedVal) {
                    if (selectedProductIds.indexOf(checkedVal) === -1) {
                        selectedProductIds.push(checkedVal);
                    }
                });
            }

        }
        else {
            $('.product_check').prop('checked', false);

            if ($('#filterapplied').val() == '0') {
                selectedProductIds = [];
            }
            else {
                var unChecked = [];
                $.each($("input[name='productId[]']:not(:checked)"), function () {
                    var val = $(this).val();
                    unChecked.push(val);
                });

                if (selectedProductIds.length == 0) {
                    if (customProductListData.hasOwnProperty('products')) {
                        products = customProductListData.products;
                        if (Object.keys(products).length) {
                            $.each(products, function (index, product) {
                                var productId = product.id.toString();
                                if (unChecked.indexOf(productId) == -1) {
                                    selectedProductIds.push(productId);
                                }
                            });
                        }
                    }
                }
                else {
                    unChecked.forEach(function (uncheckedVal) {
                        var index = selectedProductIds.indexOf(uncheckedVal);
                        if (index > -1) {
                            selectedProductIds.splice(index, 1);
                        }
                    });
                }
            }
        }

        changeCount(element);
    }

    function selectOne(element) {
        var value = $(element).val();

        if (selectedProductIds == 'all') {
            selectedProductIds = [];
        }


        if ($("#select_all").is(':checked')) {
            $("#select_all").prop("checked", false);

            if ($('#filterapplied').val() == '0') {
                $.each($("input[name='productId[]']:checked"), function () {
                    var val = $(this).val();
                    if (selectedProductIds.indexOf(val) === -1) {
                        selectedProductIds.push(val);
                    }
                });
            }
            else {
                if (selectedProductIds.length == 0) {
                    if (customProductListData.hasOwnProperty('products')) {
                        products = customProductListData.products;
                        if (Object.keys(products).length) {
                            $.each(products, function (index, product) {
                                var productId = product.id.toString();
                                if (productId != value) {
                                    selectedProductIds.push(productId);
                                }
                            });
                        }
                    }
                }
                else {
                    var index = selectedProductIds.indexOf(value);
                    if (index > -1) {
                        selectedProductIds.splice(index, 1);
                    }
                }
            }
        }
        else {
            var allCheckflag = true;
            $.each($(".product_check"), function () {
                if ($(this).is(':checked') === false) {
                    allCheckflag = false;
                    return false;
                }
            });

            if (allCheckflag) {
                $("#select_all").prop("checked", true);

                if ($('#filterapplied').val() == '0') {
                    selectedProductIds = 'all';
                }
                else {
                    $.each($("input[name='productId[]']:checked"), function () {
                        var val = $(this).val();
                        if (selectedProductIds.indexOf(val) === -1) {
                            selectedProductIds.push(val);
                        }
                    });
                }
            }
            else {
                if ($(element).is(':checked')) {
                    if (selectedProductIds.indexOf(value) === -1) {
                        selectedProductIds.push(value);
                    }
                }
                else {
                    if (selectedProductIds.length == 0) {
                        if (customProductListData.hasOwnProperty('products')) {
                            products = customProductListData.products;
                            if (Object.keys(products).length) {
                                $.each(products, function (index, product) {
                                    var productId = product.id.toString();
                                    if (productId != value) {
                                        selectedProductIds.push(productId);
                                    }
                                });
                            }
                        }
                    }
                    else {
                        var index = selectedProductIds.indexOf(value);
                        if (index > -1) {
                            selectedProductIds.splice(index, 1);
                        }
                    }
                }
            }
        }

        changeCount(element);
    }

    function changeCount(element) {
        var count = 0;
        if (selectedProductIds == 'all') {
            count = Object.keys(customProductListData.products).length
        } else {
            count = selectedProductIds.length;
        }

        $('#selected_count').html(count);
        /*raza*/
//        var product_limit_count = '<?//= $product_limit_count; ?>//';
        var productIds = [];
        $.each($("input[name='productId[]']:checked"), function () {
            productIds.push($(this).val());
        });
        /*if (product_limit_count < productIds.length) {
            alert("You can import " + product_limit_count + " Products");
            if (selectedProductIds == 'all') {
                $('.product_check').prop('checked', false);
                $("#select_all").prop("checked", false);
                $('#selectedids').val('');
            } else {
                $(element).prop('checked', false);
            }
            return false;
        }*/
        /*end*/
    }

    function startCustomProductImport(element, page=0) {
        var productIds = [];
        $.each($("input[name='productId[]']:checked"), function () {
            productIds.push($(this).val());
        });
        var selectCount = productIds.length;
        if (selectCount) {
            $('#import-content-wrapper').fadeTo("fast", 0.1);
            $(element).attr('disabled', true);
            $("#import-select").attr('disabled', true);
            $('#ajax-import-wrapper').show();
            $('#total_show').html(selectCount);

            var max = <?= WalmartproductimportController::MAX_CUSTOM_PRODUCT_IMPORT_PER_REQUEST ?>;
            var totalPages = Math.ceil(selectCount / max);
            while (page < totalPages) {
                id = page;
                pages = totalPages;


                sendCustomImportAjax(productIds, page);
                page++;
            }

            status_image.src = '<?php echo $succes_img ?>';
            var span = document.createElement('li');
            var textMsg = '';
            var fst = ' and ';
            if (notSku && notSku > 0) {
                textMsg = notSku + " product(s) unable to import due to missing product sku(s)";
            }
            if (notType && notType > 0) {
                if (textMsg != "") {
                    fst = ', ';
                    textMsg += " and " + notType + " product(s) unable to import due to missing product type";
                } else {
                    textMsg = notType + " product(s) unable to import due to missing product type";
                }
            }

            if (textMsg != "") {
                textMsg = fst + textMsg;
            }
            span.innerHTML = '<img class="v-middle" src="<?php echo $succes_img ?>"><span id="update_status" class="text">' + countOfSuccess + ' Product(s) Successfully Imported' + textMsg + '.' + '</span>';

            span.style = 'background-color:#DDF';
            my_id.parentNode.insertBefore(span, my_id);
            //$('liFinished').show();
            document.getElementById("liFinished").style.display = "block";
            $(".warning-div").hide();
            $("#profileRows").css({'margin-top': '10px'});
            update_status.innerHTML = percent + '% ' + (id + 1) + ' Of ' + pages + ' Processed.';

            if (countOfSuccess > 0) {
                $('.next').attr('disabled', false);
                $("#success-import-msg").css('display', 'block');
            } else {
                $('#import-error').html("Can't proceed to Next Step. Please update Shopify Product(s) details on your Store and then Continue with <strong>Step " + CURRENT_STEP_ID + ": Import Products</strong> Step by <strong>reloading</strong> the page.");
            }
        }
        else {
            alert('Please select products before clicking on "Start Import"');
        }
    }

    function sendCustomImportAjax(productIds, page) {
        percent = getPercent();
        update_status.innerHTML = percent + '% Page ' + (id + 1) + ' Of total product pages ' + pages + ' Processing';

        var url = "<?= Data::getUrl('walmartproductimport/custom-import') ?>";
        $.ajax({
            method: "post",
            url: url,
            dataType: 'json',
            async: false,
            data: {product_ids: productIds, merchant_id: merchant_id, _csrf: csrfToken, page: page, limit: limit}
        })
            .done(function (json) {
//                console.log(json);
                if (json.hasOwnProperty('success') && json.success) {
//                    console.log(json.success);
                    countOfSuccess += json.success.count;
                    notSku += json.success.not_sku;
                    notType += json.success.not_type;
                    var span = document.createElement('li');
                    span.innerHTML = '<img class="v-middle" src="<?php echo $succes_img ?>"><span class="text">' + json.success.count + ' products imported of page ' + (id + 1) + '...</span>';
                    span.id = 'id-' + (id + 1);
                    span.style = 'background-color:#DDF';
                    update_row.parentNode.insertBefore(span, update_row);
                }
                if (json.hasOwnProperty('error') && json.error) {
                    var span = document.createElement('li');
                    span.innerHTML = '<img class="v-middle" src="<?php echo $error_img ?>"><span class="text">' + json.error + '</span>';
                    span.id = 'id-' + (id + 1);
                    span.style = 'background-color:#FDD';
                    update_row.parentNode.insertBefore(span, update_row);
                }
            });
    }

    $('.not-sku-tr').on('click', 'a.yourlink', function (e) {
        e.preventDefault();
        var viewUrl = '<?= $viewUrl;?>';
        var shop_url = '<?= $shop_url;?>'
        var inputvalue = $(this).data('index');
        var inputurl = viewUrl + '?file=' + inputvalue;
        $.ajax({
            url: inputurl,
            success: function (data) {
                var obj = JSON.parse(data);

                /*var iframeview = +'?data'+data;
                 $.ajax({
                 url: iframeview,
                 success: function(data){
                 var obj = JSON.parse(data);*/
                $.each(obj, function (key, value) {
                    window.open('https://' + shop_url + '/admin/bulk?resource_name=Product&edit=variants.sku,variants.price,product_type,variants.inventory_quantity_adjustment&show=&return_to=/admin/products&metafield_titles=&metafield_options=&ids=' + value + '');
                });
                /*	  },
                 error: function(data){
                 },
                 })*/
                /*	$.each(obj, function(key,value) {
                 window.open('http://google.com');
                 });*/
            },
            error: function (data) {
            },
        })
    });
</script>
<script>
    $(document).ready(function () {
        $(".search_product").click(function () {
            $(".filter-fieldset").slideToggle("slow");
        });
    });

</script>
<script>
    $(document).ready(function () {
        $(function () {
            $('.filterContainer').on('click', function () {
                if ($(this).attr('class') == 'filterContainer active') {
                    $(this).removeClass("active");
                } else {
                    $(this).addClass("active");
                }
            });
        });
    });
</script>