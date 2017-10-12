<style>
    /* #attribute_map{
         width: 100% !important;
     }
     .attrmap-inner-table-inner-td{
         width: 15px !important;
     }
     .table-bordered td {
         padding: 10px 6px 19px !important;
     }*/
    .attrmap-inner-table tr td:first-child {
        width: 153px !important;
    }
    .grid-view th {
        white-space: normal !important;
    }
    .table-bordered th {
        padding: 10px 5px !important;
    }

</style>
<?php
use yii\helpers\Html;
use frontend\modules\neweggcanada\components\Data;
use frontend\modules\neweggcanada\models\WalmartAttributeMap;
use frontend\modules\neweggcanada\components\AttributeMap;
use frontend\modules\neweggcanada\components\categories\Categoryhelper;


$attributes = [];
$categoryName = '';
//getting sub category attribte
$shopify_product_types = AttributeMap::getShopifyProductTypes();

foreach ($shopify_product_types as $type_arr) {
    $data = "";
    $product_type = $type_arr['product_type'];

    $neweggcanadategory = explode(",", $type_arr['category_path']);

    if (isset($session['main_category'])) {

        foreach ($session['main_category'] as $item) {
            if ($item['IndustryCode'] == $neweggcanadategory[0]) {
                $categoryName = $item['IndustryName'];
                $categoryId = $item['IndustryCode'];
            }
        }

    }
    else{
        $categories = Categoryhelper::mainCategory();
        foreach ($categories as $item) {
            if ($item['IndustryCode'] == $neweggcanadategory[0]) {
                $categoryName = $item['IndustryName'];
                $categoryId = $item['IndustryCode'];
            }
        }
    }

    if (is_array($neweggcanadategory) && !empty($neweggcanadategory[1])) {
        $categoryId = $neweggcanadategory[0];
        $subcategoryId = $neweggcanadategory[1];

        $model = Categoryhelper::subcategoryAttribute($categoryId, $subcategoryId);

        if (!empty($model)) {
            $attributesValue = "";
            foreach ($model as $key => $value) {
                if ($value['IsRequired'] == 1 || $value['IsGroupBy'] == 1) {
                    $data[] = $value;
                    $propertyName = $value['PropertyName'];

                    // getting sub category attribute value

                    $attributesValue[$propertyName][] = Categoryhelper::subcategoryAttributeValue($categoryId, $subcategoryId, $propertyName);
                }
            }

        }

    }

    $shopifyAttributes = AttributeMap::getShopifyProductAttributes($product_type);

    $mapped_values = AttributeMap::getAttributeMapValues($product_type);
    $mapped_Datas = AttributeMap::getAttributeMapData($product_type);

    if (!empty($data)) {
        $attributes[$product_type] = [
            'product_type' => $product_type,
            'neweggcanadategory' => $categoryName,
            'neweggattribute' => $data,
            'shopify_attribute' => $shopifyAttributes,
            'neweggattributevalue' => $attributesValue,
            'neweggcanadategoryId' => $categoryId,
            'mapped_values' => $mapped_values,
            'mapped_Datas'=>$mapped_Datas
        ];
    }
}

?>
<div class="attribute-map-index content-section">
    <div class="">
         <p style = "background: #f6f6f6 none repeat scroll 0 0;color: #885f74;font-size: 12px;padding: 12px;">
         <b class="note-text">Note:</b> If you got variations for your products, map newegg attributes with your product variant options, or Click <b>Next</b>
        </p>
         <p style = "background: #f6f6f6 none repeat scroll 0 0; color: #885f74; font-size: 12px;padding: 12px;">
            <b style="border: 1px solid #EFC959; color: #EFC959;">Variant:</b>Attribute Can be Used for Creating Variants on Newegg.
        </p>
        <p style = "background: #f6f6f6 none repeat scroll 0 0;color: #885f74;font-size: 12px;padding: 12px;">
            <b style="border: 1px solid #EFC959; color: red;">Required:</b>Attribute is Required on Newegg.
        </p>
    </div>
    <form id="attribute_map" class="form new-section" method="post"
          action="<?= Data::getUrl('newegg-attributemap/save') ?>" >
       <!--  <div class="jet-pages-heading">
            <h3 class="Jet_Products_style"><?= Html::encode($this->title) ?></h3>
            <div class="clear"></div>
        </div> -->
        <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>"
               value="<?= Yii::$app->request->csrfToken; ?>"/>
        <div class="grid-view table-responsive">
             <table class="table table-striped table-bordered ced-walmart-custome-tbl">
                <thead>
                <tr>
                    <th>Product Type(shopify)</th>
                    <th>Newegg Category</th>
                    <th>
                        <div style="float:left; width: 80px; margin-left:5% ; margin-right: 5%">Newegg Attributes</div>
                        <div style="float: left; width: 100px;  text-align: center">Shopify Attribute</div>
                        <div style="float:right; width: 20px; margin-right:12%">Newegg Attribute Value</div>
                    </th>
                </tr>
                </thead>
                <tbody>

                <?php
                $count =0;
                foreach ($attributes as $key => $attribute) {

                    $shopifyoptions = [];
                    if (isset($attribute['shopify_attribute']) && count($attribute['shopify_attribute'])) {
                        foreach ($attribute['shopify_attribute'] as $shopify_attr) {
                            $shopifyoptions[] = $shopify_attr;

                        }

                    }


                    ?>
                    <tr>
                        <?php $name = $attribute['product_type']; ?>
                        
                        <td><?= $attribute['product_type'] ?></td>
                        <td><?= $attribute['neweggcanadategory'] ?></td>
                        <td colspan="1">

                            <table class="attrmap-inner-table">
                                <?php
                                foreach ($attribute['neweggattribute'] as $value) {
                                    $propertyname = [];
                                    ?>
                                    <tr>
                                        <td><?= $value['PropertyName'] ?>
                                        <!-- Here specify attribute property start -->
                                        <?php
                                        if($value['IsGroupBy']==1){
                                            $var = "var"?>
                                        <p>
                                            <span style="border: 1px solid #EFC959; padding: 0 5px; margin-right: 10px; color: #EFC959" class="">Variant</span>
                                        <?php }
                                        else{?>
                                        </p>
                                        </p>
                                        <span style="border: 1px solid red; padding: 0 5px; margin-right: 10px; color: red" class="">Required</span>

                                            <?php }

                                        ?>
                                        <!-- End Code -->
                                        </p></td>
                                        <td class="attrmap-inner-table-inner-td1">
                                            <?php foreach ($attribute['neweggattributevalue'] as $key => $item1) {
                                            if ($key == $value['PropertyName']) {
                                            foreach ($item1 as $items) {
                                            $mapped_value = '';
                                            if (isset($attribute['mapped_values'][$value['PropertyName']])) {
                                                foreach ($attribute['mapped_values'] as $key => $values) {
                                                    $propertyname[] = $key;
                                                }
                                                $valueType = $attribute['mapped_values'][$value['PropertyName']]['type'];

                                                $mapped_value = $attribute['mapped_values'][$value['PropertyName']]['value'];
                                            }

                                            if (!empty($items['PropertyValueList'])) {


                                            ?>

                                            <?php
                                            if (isset($attribute['shopify_attribute']) && $attribute['shopify_attribute']) {
                                                ?>
                                                <?php
                                                foreach ($attribute['shopify_attribute'] as $k => $v) {

                                                    ?>
                                                    <!-- <option
                                                                        value='<?= $v ?>'<?php if (in_array($shopifyoptions, explode(',', $mapped_value))) {

                                                        echo 'selected="selected"';
                                                    } ?>><?= $v ?></option> -->
                                                    <?php $class_name = str_replace(' ','',$name);
                                                    $class_name = str_replace("'","",$class_name);
                                                    $class_name = preg_replace("([~!@#$%^&*()_+=`{}\[\]\|\\:;'<>,.\/? ])", "", $class_name);?>
                                                    <input type="checkbox" value="<?= $v ?>"
                                                           class = "<?= $class_name ?><?php if(isset($var) && !empty($var)){  echo $var;
                                                            }?>" name="newegg[<?= $name ?>][<?= $attribute['neweggcanadategoryId'] ?>][<?= $value['PropertyName'] ?>][map][]" <?php if (isset($attribute['mapped_Datas'][$value['PropertyName']])
                                                        && !empty($attribute['mapped_Datas'][$value['PropertyName']])
                                                    ) {
                                                        if (in_array($v, explode(',', $attribute['mapped_Datas'][$value['PropertyName']]))) {
                                                            echo 'checked="checked"';
                                                        }
                                                    }
                                                    ?> >
                                       

                                                    <label><?= $v ?></label>


                                                <?php }
                                                $var = '';
                                            }

                                            ?>


                                            <!--                                                            <select name="attribute_value">-->
                                            <!--                                                            ][-->
                                            <? //= $attribute['neweggcanadategoryId']?><!--]-->

                                        <td class="attrmap-inner-table-inner-td2">
                                            <select class="form-control root"
                                                name="newegg[<?= trim($attribute['product_type'], ' ') ?>][<?= $attribute['neweggcanadategoryId'] ?>][<?= $value['PropertyName'] ?>][<?= AttributeMap::VALUE_TYPE_NEWEGG ?>]">
                                                <?php foreach ($items['PropertyValueList'] as $options) {


                                                    ?>

                                                    <option
                                                        value='<?= $options; ?>' <?php

                                                    if ($mapped_value == $options) {
                                                        echo 'selected="selected"';
                                                    } ?> ><?= $options ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>

                                        <?php

                                        } else {

                                            if (isset($shopifyoptions) && count($shopifyoptions)) {
                                                ?>
                                                <?php
                                                foreach ($shopifyoptions as $option) {
                                                    ?>
                                                    <input type="checkbox" value="<?= $option ?>"
                                                           name="newegg[<?= $attribute['product_type'] ?>][<?= $attribute['neweggcanadategoryId'] ?>][<?= $value['PropertyName'] ?>][map][]"<?php if (isset($attribute['mapped_Datas'][$value['PropertyName']])
                                                        && !empty($attribute['mapped_Datas'][$value['PropertyName']])
                                                    ) {
                                                        if (in_array($option, explode(',', $attribute['mapped_Datas'][$value['PropertyName']]))) {
                                                            echo 'checked="checked"';
                                                        }
                                                    }
                                                    ?> >
                                                    <label><?= $option ?></label>

                                                    <?php

                                                }
                                                ?>
                                                <?php
                                                if (isset($attribute['shopify_attribute']) && $attribute['shopify_attribute']) {
                                                    ?>
                                                    <?php
                                                    foreach ($attribute['shopify_attribute'] as $k => $v) {
                                                        ?>
                                                        <!--               <label><?= $v ?></label>
                                                                <input type="checkbox" value="<?= $v ?>" name="newegg[<?= $name ?>][<?= $attribute['neweggcanadategoryId'] ?>][<?= $value['PropertyName'] ?>][map][]"<?php if (isset($attribute['mapped_Datas'][$value['PropertyName']])
                                                            && !empty($attribute['mapped_Datas'][$value['PropertyName']])
                                                        ) {
                                                            if (in_array($v, explode(',', $attribute['mapped_Datas'][$value['PropertyName']]))) {
                                                                echo 'checked="checked"';
                                                            }
                                                        }
                                                        ?> > -->

                                                    <?php }
                                                } ?>

                                                <?php
                                            }
                                            ?>
                                            <td>
                                                <input type="text"
                                                       name="newegg[<?= trim($attribute['product_type'], ' ') ?>][<?= $attribute['neweggcanadategoryId'] ?>][<?= $value['PropertyName'] ?>][<?= AttributeMap::VALUE_TYPE_TEXT ?>]"
                                                       placeholder="enter data"
                                                       value="<?php if ($valueType == AttributeMap::VALUE_TYPE_TEXT && in_array($value['PropertyName'], $propertyname)) {
                                                           echo $mapped_value;
                                                       } ?>"/>
                                            </td>

                                            <?php
                                            /*die;*/
                                        }
                                        }

                                        }

                                        } ?>
                                        </td>
                                    </tr>

                                    <?php
                                }
                                ?>
                            </table>
                        </td>
                    </tr>
                            <script type="text/javascript">
                               var array<?= $count ?> = [];
                               var str<?= $count ?> = "<?= $name ?>"; 
                               var name<?= $count ?> = str<?= $count ?>.replace(/\s+/g,''); 
                               var name<?= $count ?> = name<?= $count ?>.replace(/\'+/g,'');
                               var name<?= $count ?> = name<?= $count ?>.replace(/([~!@#$%^&*()_+=`{}\[\]\|\\:;'<>,.\/? ])+/g,''); 
                                    $('.'+name<?= $count ?>+'var:checkbox:checked').each(function () {
                                        var sThisVal = (this.checked ? $(this).val() : "");
                                        array<?= $count ?>.push(sThisVal);
                                    });
                                    $('.'+name<?= $count ?>+'var').on('change',function(){
                                   var dropdown_value = $(this).val();
                                   if(this.checked){
                                        if($.inArray(dropdown_value, array<?= $count ?>) > -1) {
                                        var errorMsg = "Same value not mapped";
                                        //j$('.v_error_msg').html(errorMsg);
                                        alert(errorMsg);
                                       //j$('.v_error_msg').show();
                                        $(this).prop('checked', false);
                                        return false;
                                        }
                                        else{
                                           array<?= $count ?>.push(dropdown_value); 
                                        }
                                   }
                                   else{
                                    array<?= $count ?> = jQuery.grep(array<?= $count ?>, function(value) {
                                          return value != dropdown_value;
                                        });
                                    
                                   }
                             
                                   
                                });
                            </script>

                <?php $count++;} ?>

                </tbody>
            </table>
            <input type="button" class="btn btn-primary next" value="Next">
        </div>
    </form>
</div>
<style>
    <style>
    .center,.cat_root{
        text-align: center;
    }
    .cat_root .form-control{
        display: inline-block;
    }

    .attrmap-inner-table .checkbox_options {
        float: left;
        margin-right: 8px;
        min-width: 30%;
    }
    .attrmap-inner-table tr td {
        width: auto;
    }
    .attrmap-inner-table tr td:first-child {
        width: auto;
    }
    .signle-line-1 {
        border-bottom: 1px solid #d4d4d4;
        margin-bottom: 25px;
        text-align: center;
    }
    .signle-line-1 span {
        background: #fff none repeat scroll 0 0;
        display: inline-block;
        position: relative;
        top: 8px;
        width: 32px;
        font-weight: bold;
    }
</style>

<script type="text/javascript">
    $(document).ready(function(){
        var url = '<?= Data::getUrl("newegg-install/save-attribute-map"); ?>';
        UnbindNextClick();
        $('.next').on('click', function(event){
            $('#LoadingMSG').show();
            $.ajax({
                method: "POST",
                url: url,
                data: $("form").serialize(),
                dataType : "json"
            })
                .done(function(response)
                {
                    $('#LoadingMSG').hide();
                    if(response.success) {
                        nextStep();
                    } else {
                        $('.top_error').html(response.message);
                        $('.top_error').show();
                    }
                });
        });
    });
</script>