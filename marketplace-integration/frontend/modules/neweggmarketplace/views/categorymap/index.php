<?php
use yii\helpers\Html;

$this->title = 'Shopify-Newegg Category Mapping';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="category-map-index content-section">

    <!-- <div class="clear"></div>  -->
    <form id="category_map" class="form new-section" method="post"
          action="<?php echo \yii\helpers\Url::toRoute(['categorymap/save']) ?>">


        <div class="jet-pages-heading">
            <div class="title-need-help">
                <h3 class="Jet_Products_style"><?= Html::encode($this->title) ?></h3>
            </div>
            <div class="product-upload-menu">
                <button type="button" id="instant-help" class="btn btn-primary">Help</button>
                <!-- <a class="help_jet" href="<?php //echo Yii::$app->request->baseUrl?>/how-to-sell-on-jet-com#sec2" target="_blank" title="Need Help"></a> -->
                <input type="submit" value="Submit" class="btn btn-primary save-category-map" data-step='6'
                       data-intro="Save performed Changes." data-position='left'/>
            </div>
            <div class="clear"></div>
        </div>

        <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>"
               value="<?= Yii::$app->request->csrfToken; ?>"/>
        <div class="grid-view table-responsive">
            <table id="map_producttype" class="table table-striped table-bordered">
                <tr>
                    <th>Id</th>
                    <th data-step='1' data-intro="product type in shopify" data-position='top'>Product Type(shopify)
                    </th>
                    <th data-step='2' data-intro="Insert Manufacturer corresponding to Product Type.">Manufacturer
                        Name
                    </th>
                    <th data-step='3' data-intro="Select Root Category From DropDown corresponding to Product Type."
                        data-position='top' class="center" colspan="3"><label class="label-text-center">Newegg Category
                            Name</label></th>
                </tr>
                <?php
                $i = 0;
                foreach ($model as $value) {
                    $i++; ?>
                    <?php $is_selected = false; ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td id="intro_first_td_label"><?php echo $value->product_type; ?></td>
                        <td>
                            <input type="text" id="manufacturer_names"
                                   name="type[<?= trim($value->product_type) ?>][manufacturer]"
                                   value="<?= $value->manufacturer ?>"/>
                        </td>
                        <?php $category_path_str = $value->category_path; ?>
                        <td class="cat_root">
                            <select id="select_<?= $i ?>" name="type[<?= trim($value->product_type) ?>][]"
                                    style="width:auto" class="form-control root"
                                    onchange="selectChild(this,1,<?php echo "'" . trim($category_path_str) . "'"; ?>,<?php echo "'" . trim(addslashes($value->product_type)) . "'"; ?>)">
                                <option id='intro_first_td_root' value="">Please Select Category</option>
                                <?php
                                foreach ($data as $val) {
                                    if ($value->category_id == $val['IndustryCode']) {
                                        ?>
                                        <?php $is_selected = true; ?>
                                        <option value="<?= $val['IndustryCode']; ?>"
                                                selected="selected"><?= $val['IndustryName']; ?></option>
                                    <?php } else {
                                        ?>
                                        <option value="<?= $val['IndustryCode']; ?>"><?= $val['IndustryName']; ?></option>
                                    <?php }
                                }
                                ?>
                            </select>
                            <?php if ($is_selected) { ?>
                                <script type="text/javascript">
                                    j$(document).ready(function () {
                                        j$("#select_<?=$i?>").trigger('change');
                                    });
                                </script>
                            <?php } ?>
                        </td>
                        <td style="display:none;" class="cat_child"></td>
                        <td style="display:none;" class="cat_sub_child"></td>
                    </tr>
                    <?php
                }
                ?>
            </table>
        </div>


    </form>
</div>
<?php //$url= \yii\helpers\Url::toRoute(['categorymap/getcategory']);?>
<script>
    var category_tree =<?=json_encode($category_tree)?>;
    var category_detail =<?=json_encode($category_detail)?>;

    var csrfToken = $('meta[name="csrf-token"]').attr("content");

    function selectChild(node, level, path_str, type) {

        var global_level = "";
        var global_type = "";
        var global_path_str = "";
        var global_type_str = "";
        var select = "";
        var options = "";
        var path_arr = [];
        var node_val = j$(node).val();
        var option_name = "";
        if (level == 1) {

            if (node_val == "") {
                j$(node).parent('td').parent('tr').find('td.cat_child').css('display', 'none');
                j$(node).parent('td').parent('tr').find('td.cat_sub_child').css('display', 'none');
                j$(node).parent('td').parent('tr').find('td.cat_sub_child').html("");
                j$(node).parent('td').parent('tr').find('td.cat_child').html("");
                return true;
            }
            if (path_str != "") {
                path_arr = path_str.split(',');
            }
            global_level = level + 1;
            global_path_str = "'" + path_str + "'";
            global_type_str = "'" + type.replace(/'/g, "\\'") + "'";
            options = "";
            select = "";
            j$.each(category_tree, function (first_key, first_arr) {
                if (first_key == node_val && (j$.type(first_arr) === "object")) {
                    select = '<select name="type[' + type + '][]" class="form-control"  onchange="selectChild(this,' + global_level + ',' + global_path_str + ',' + global_type_str + ')">';
                    //select="<select name='type["+type+"][]' class='form-control'  onchange='selectChild(this,"+global_level+","+global_path_str+","+global_type_str+")'>";
                    j$.each(first_arr, function (sec_key, sec_arr) {
                        option_name = "";
                        j$.each(category_detail, function (cat_id, cat_name) {
                            if (cat_id == sec_key) {
                                option_name = cat_name;
                                return false;
                            }
                        });
                        if (option_name != "") {
                            if (j$.type(path_arr) === "array" && path_arr.length > level) {
                                if (sec_key == path_arr[level]) {
                                    options += "<option selected='selected' value='" + sec_key + "'>" + option_name + "</option>";
                                } else {
                                    options += "<option value='" + sec_key + "'>" + option_name + "</option>";
                                }
                            } else {
                                options += "<option value='" + sec_key + "'>" + option_name + "</option>";
                            }

                        }
                    });
                    if (options != "") {
                        select += options;
                        select += "</select>";
                    } else {
                        select = "";
                    }
                    return false;
                }
            });

            j$(node).parent('td').parent('tr').find('td.cat_child').html("");
            j$(node).parent('td').parent('tr').find('td.cat_sub_child').html("");
            j$(node).parent('td').parent('tr').find('td.cat_child').html(select);
//            alert(select);
            if (select == "") {
                j$(node).parent('td').parent('tr').find('td.cat_child').css('display', 'none');
            } else {
                j$(node).parent('td').parent('tr').find('td.cat_child').css('display', 'table-cell');
                if (j$(node).parent('td').parent('tr').find('td.cat_child').children('select').length) {
                    j$(node).parent('td').parent('tr').find('td.cat_child').children('select').trigger('change');
                }
            }
            //kshitij
            if (node_val != "" && j$(node).hasClass('select_error')) {
                j$(node).removeClass('select_error');
                j$(node).next('div').children('.error_category_map').css('display', 'none');
            }

        }

    }

    function checkBeforeSave() {
        var selector_arr = [];
        var rows_value_arr = [];
        var value_str = "";
        var first_select = "";
        var second_select = "";
        var third_select = "";
        var stop_form = false;
        <?php $i = 1;?>
        <?php foreach($model as $value){?>
        selector_arr.push("#select_<?=$i?>");
        <?php $i++;?>
        <?php }?>
        for (j = 0; j < selector_arr.length; j++) {
            first_select = "";
            second_select = "";
            third_select = "";
            first_select = j$(selector_arr[j]);
            value_str = first_select.val();
            second_select = j$(selector_arr[j]).parent().parent('tr').find('td.cat_child').children('select');
            third_select = j$(selector_arr[j]).parent().parent('tr').find('td.cat_sub_child').children('select');
            if (second_select.length) {
                value_str = value_str + "," + second_select.val();
            }
            if (third_select.length) {
                value_str = value_str + "," + third_select.val();
            }
            rows_value_arr.push(value_str);
        }
        for (j = 0; j < rows_value_arr.length; j++) {
            for (u = j + 1; u < rows_value_arr.length; u++) {
                if (rows_value_arr[j] == rows_value_arr[u] && rows_value_arr[u] != "") {
                    stop_form = true;
                    return false;
                }
            }
            if (stop_form) {
                return false;
            }
        }
        if (stop_form) {
            return false;
        }
        return true;
    }
    j$('#category_map').submit(function (event) {
        var flag = false;
        j$('.cat_root .root').each(function () {
            if (j$(this).val() == "") {
                flag = true;
                j$(this).addClass("select_error");
                //j$('.error_category_map').css('display','block');
            }
            else {
                flag = false;
                j$(this).removeClass("select_error");
                //j$('.error_category_map').css('display','none');
                return false;
            }
        });
        if (flag) {
            return false;
        }
    });

    var intro = "";
    $(function () {

        var intro = introJs().setOptions({
            showStepNumbers: false,
            exitOnOverlayClick: false,
        });
        $('#instant-help').click(function () {
            intro.start();
        });
    });

    <?php $get = Yii::$app->request->get();
    if(isset($get['tour'])) :
    ?>
    $(document).ready(function () {
        var categorymapQuicktour = introJs().setOptions({
            doneLabel: 'Next page',
            showStepNumbers: false,
            exitOnOverlayClick: false,
            steps: [
                {
                    element: '#intro_first_td_label',
                    intro: 'This is Shopify Product Type.',
                    position: 'bottom'
                },
                {
                    element: '#manufacturer_names',
                    intro: "Insert Manufacturer corresponding to Product Type.",
                    position: 'bottom'
                },
                {
                    element: '.cat_root',
                    intro: "Select Root Category From DropDown corresponding to Product Type.",
                    position: 'bottom'
                },
                /*{
                 element: '.cat_child',
                 intro: "Select Child Category From DropDown corresponding to Selected Root Category.",
                 position: 'bottom'
                 },*/
                /*{
                 element: '#intro_first_td_sub_sub',
                 intro: "Select Child Category From DropDown corresponding to Selected Jet Category.",
                 position: 'bottom'
                 },*/
                {
                    element: '.save-category-map',
                    intro: "Save performed Changes.",
                    position: 'left'
                }
            ]
        });
        setTimeout(function () {

            categorymapQuicktour.start().oncomplete(function () {
                window.location.href = '<?= \frontend\modules\neweggmarketplace\components\Data::getUrl("neweggproduct/index?tour") ?>';
            });
        }, 1000);
    });
    <?php endif; ?>
</script>
<style>
    .center, .cat_root {
        text-align: center;
    }

    .cat_root .form-control {
        display: inline-block;
    }

</style>