<?php
namespace frontend\modules\walmart\controllers;

use Yii;
use yii\helpers\Html;
use yii\filters\VerbFilter;
use yii\data\ArrayDataProvider;
use frontend\modules\walmart\components\Data;
use frontend\modules\walmart\components\Walmartapi;
use frontend\modules\walmart\components\WalmartReport;
use frontend\modules\walmart\components\WalmartProduct as WalmartProductComponent;
use frontend\modules\walmart\components\WalmartRepricing;
use frontend\modules\walmart\models\WalmartProduct;

/**
 * ProductstatusController
 */
class ProductstatusController extends WalmartmainController
{
    /**
     * Number of products to be synced in a request
    */
    public static $_size_of_request = 500;

    public $_notOnAppFilePath = '/var/report/{merchant_id}/errored_products/not_on_app.csv';

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actionUpdateproductstatus()
    {
        $merchant_id = Yii::$app->user->identity->id;

        $walmartReport = new WalmartReport(API_USER, API_PASSWORD);
        $csvFilePath = $walmartReport->downloadItemReport($merchant_id);
        if($csvFilePath)
        {
            if(file_exists($csvFilePath)) {
                $itemCount = WalmartReport::getRowsInCsv($csvFilePath);
                if ($itemCount) {
                    $size_of_request = self::$_size_of_request;;

                    $pages = (int)(ceil($itemCount / $size_of_request));

                    return $this->render('sync_status', [
                        'total_products' => $itemCount,
                        'pages' => $pages,
                        'csvFilePath' => $csvFilePath
                    ]);
                } else {
                    Yii::$app->session->setFlash('error', 'No data found in item report.');
                }
            }
        }
        else
        {
            Yii::$app->session->setFlash('error','Item report not found.');
        }

        if(Yii::$app->request->referrer) {
            return $this->redirect(Yii::$app->request->referrer);
        } else {
            return $this->redirect(Data::getUrl('walmartproduct/index'));
        }
    }

    /*public function actionStartstatusupdate()
    {
        $session = Yii::$app->session;

        $index = Yii::$app->request->post('index',false);
        if($index !== false)
        {
            $isLastPage = Yii::$app->request->post('isLast');

            $merchant_id = Yii::$app->user->identity->id;
            $csvFilePath = Yii::$app->request->post('csvFilePath',false);

            if($csvFilePath)
            {
                $size_of_request = self::$_size_of_request;

                $errorSku = [];
                $successSku = [];
                $uptodateSku = [];
                $uptodateCount = 0;

                $notOnApp = [];

                $sessionKey = 'all_product_sku_'.$merchant_id;

                if(!isset($session[$sessionKey])) {
                    $allProductSku = WalmartProductComponent::getAllProductSku($merchant_id);
                    $session->set($sessionKey, $allProductSku);
                }
                else {
                    $allProductSku = $session[$sessionKey];
                }
                $csvData = WalmartReport::readItemCsv($csvFilePath,$size_of_request,$index);
                foreach ($csvData as $data) 
                {
                    $sku = addslashes(trim($data['sku']));
                    if(in_array($sku, $allProductSku))
                    {
                        $query = "SELECT `jp`.`sku`,`jp`.`id`,`jp`.`type`,`wp`.`status` FROM `walmart_product` `wp` INNER JOIN (SELECT * FROM `jet_product` WHERE `merchant_id` = '{$merchant_id}') as `jp` ON `wp`.`product_id`=`jp`.`id` WHERE `wp`.`merchant_id`='{$merchant_id}' AND `jp`.`sku`='{$sku}' LIMIT 0,1";
                        $productData = Data::sqlRecords($query, 'one', 'select');

                        if($productData) {
                            if($data['publish_status'] != $productData['status']) {
                                $query = "UPDATE  `walmart_product` SET `status` = '{$data['publish_status']}' WHERE `product_id` = '{$productData['id']}'";
                                Data::sqlRecords($query, null, 'update');

                                $successSku[$sku] = 'Status Updated.';
                            } else {
                                if(!isset($uptodateSku[$sku])) {
                                    $uptodateSku[$sku] = 'Status up-to-date.';
                                    $uptodateCount++;
                                }
                            }
                        }


                        $query = "SELECT `jpv`.`option_id`, `jpv`.`option_sku`, `wpv`.`status` FROM `walmart_product_variants` `wpv` INNER JOIN (SELECT * FROM `jet_product_variants` WHERE `merchant_id` = '{$merchant_id}') as `jpv` ON `wpv`.`option_id`=`jpv`.`option_id` WHERE `jpv`.`merchant_id`='{$merchant_id}' AND `jpv`.`option_sku`='{$sku}' LIMIT 0,1";
                        $variantData = Data::sqlRecords($query, 'one', 'select');

                        if ($variantData) {
                            if($data['publish_status'] != $variantData['status']) {
                                $query = "UPDATE  `walmart_product_variants` SET `status` = '{$data['publish_status']}' WHERE `option_id` = '{$variantData['option_id']}'";
                                Data::sqlRecords($query, null, 'update');

                                if(!isset($successSku[$sku])) {
                                    $successSku[$sku] = 'Status Updated.';
                                }
                            } else {
                                if(!isset($uptodateSku[$sku])) {
                                    $uptodateSku[$sku] = 'Status up-to-date.';
                                    $uptodateCount++;
                                }
                            }
                        }


                        if(!isset($successSku[$sku]) && !isset($uptodateSku[$sku]) && !isset($errorSku[$sku])) {
                            $errorSku[$sku] = "This Sku doesn't exist in our app.";
                            $notOnApp[$sku] = $data;
                        }
                    }
                    else
                    {
                        if(!isset($errorSku[$sku])) {
                            $errorSku[$sku] = "This Sku doesn't exist in our app (walmart itemid : '".$data['item_id']."').";
                            $notOnApp[$sku] = $data;
                        }
                    }
                }

                $file_path = Yii::getAlias('@webroot') . '/var/report/' . $merchant_id . '/errored_products/not_on_app.csv';
                if($index == '0' && file_exists($file_path)) {
                    unlink($file_path);
                }

                $noaCount = count($notOnApp);
                if($noaCount) {
                    self::prepareErrorCsv($notOnApp, $merchant_id, $file_path);
                }

                if($isLastPage)
                {
                    unset($session[$sessionKey]);

                    $query1 = "UPDATE `walmart_product` SET `status`='" . WalmartProduct::PRODUCT_STATUS_NOT_UPLOADED . "' WHERE `status`='" . WalmartProduct::PRODUCT_STATUS_PROCESSING . "' AND `merchant_id`='" . $merchant_id . "'";
                    Data::sqlRecords($query1, null, 'update');

                    $query = "UPDATE `walmart_product_variants` SET `status`='" . WalmartProduct::PRODUCT_STATUS_NOT_UPLOADED . "' WHERE `status`='" . WalmartProduct::PRODUCT_STATUS_PROCESSING . "' AND `merchant_id`='" . $merchant_id . "'";
                    Data::sqlRecords($query, null, 'update');
                }

                $return = [];
                if($sucCount=count($successSku))
                {
                    $return['success'] = true;
                    $return['success_count'] = $sucCount;
                }

                if($errCount=count($errorSku))
                {
                    $return['error'] = true;//implode(', ',array_keys($errorSku));
                    $return['error_object'] = $errorSku;
                    $return['error_count'] = $errCount;
                }

                if($uptodateCount)
                {
                    $return['uptodate_count'] = $uptodateCount;
                }
                return json_encode($return);
            }
            else
            {
                return json_encode(['error'=>'Buybox Report Not found.']);
            }
        }
        else
        {
            return json_encode(['error'=>'Undefined Index']);
        }
    }*/

    public function actionStartstatusupdate()
    {
        $session = Yii::$app->session;

        $index = Yii::$app->request->post('index',false);
        if($index !== false)
        {
            $isLastPage = Yii::$app->request->post('isLast');

            $merchant_id = Yii::$app->user->identity->id;
            $csvFilePath = Yii::$app->request->post('csvFilePath',false);

            if($csvFilePath)
            {
                $size_of_request = self::$_size_of_request;

                $errorSku = [];

                $successSku = [];
                $successCount = 0;

                $uptodateSku = [];
                $uptodateCount = 0;

                /**
                 * Delete Csv file of 'Not on app' products
                 */
                $file_path = strtr($this->_notOnAppFilePath, ['{merchant_id}'=>$merchant_id]);
                $file_path = Yii::getAlias('@webroot') . $file_path;
                if($index == '0' && file_exists($file_path)) {
                    unlink($file_path);
                }

                $csvData = WalmartReport::readItemCsv($csvFilePath, $size_of_request, $index);
                $skuList = array_keys($csvData);
                $skus = "'".implode("','", $skuList)."'";

                $query = "SELECT `jp`.`sku`,`jp`.`id`,`wp`.`status` FROM `walmart_product` `wp` INNER JOIN (SELECT * FROM `jet_product` WHERE `merchant_id` = '{$merchant_id}') as `jp` ON `wp`.`product_id`=`jp`.`id` WHERE `wp`.`merchant_id`='{$merchant_id}' AND `jp`.`sku` IN ({$skus})";
                $productData = Data::sqlRecords($query, 'all', 'select');
                $productDataSku = [];
                if($productData !== false) {
                    $productDataSku = array_column($productData, 'sku');
                }

                $query = "SELECT `jpv`.`option_id`, `jpv`.`option_sku`, `wpv`.`status` FROM `walmart_product_variants` `wpv` INNER JOIN (SELECT * FROM `jet_product_variants` WHERE `merchant_id` = '{$merchant_id}') as `jpv` ON `wpv`.`option_id`=`jpv`.`option_id` WHERE `jpv`.`merchant_id`='{$merchant_id}' AND `jpv`.`option_sku`IN ({$skus})";
                $variantData = Data::sqlRecords($query, 'all', 'select');
                $variantDataSku = [];
                if($variantData !== false) {
                    $variantDataSku = array_column($variantData, 'option_sku');
                }

                foreach ($csvData as $sku => $data) 
                {
                    if(($pindex=array_search($sku, $productDataSku)) !== false)
                    {
                        if($data['publish_status'] != $productData[$pindex]['status']) {
                            $query = "UPDATE  `walmart_product` SET `status` = '{$data['publish_status']}' WHERE `product_id` = '{$productData[$pindex]['id']}'";
                            Data::sqlRecords($query, null, 'update');

                            if(!isset($successSku[$sku]) && !isset($uptodateSku[$sku])) {
                                $successSku[$sku] = 'Status Updated.';
                                $successCount++;
                            }
                        } else {
                            if(!isset($successSku[$sku]) && !isset($uptodateSku[$sku])) {
                                $uptodateSku[$sku] = 'Status up-to-date.';
                                $uptodateCount++;
                            }
                        }
                    }


                    if(($vindex=array_search($sku, $variantDataSku)) !== false)
                    {   
                        if($data['publish_status'] != $variantData[$vindex]['status']) {
                            $query = "UPDATE  `walmart_product_variants` SET `status` = '{$data['publish_status']}' WHERE `option_id` = '{$variantData[$vindex]['option_id']}'";
                            Data::sqlRecords($query, null, 'update');

                            if(!isset($successSku[$sku]) && !isset($uptodateSku[$sku])) {
                                $successSku[$sku] = 'Status Updated.';
                                $successCount++;
                            }
                        } else {
                            if(!isset($successSku[$sku]) && !isset($uptodateSku[$sku])) {
                                $uptodateSku[$sku] = 'Status up-to-date.';
                                $uptodateCount++;
                            }
                        }
                    }


                    if(!isset($successSku[$sku]) && !isset($uptodateSku[$sku]) && !isset($errorSku[$sku])) {
                        $errorSku[$sku] = "This Sku doesn't exist in our app.";

                        /**
                         * Save not on app products in csv
                         */
                        self::prepareErrorCsv($data, $merchant_id, $file_path);
                    }
                }

                if($isLastPage)
                {
                    $query1 = "UPDATE `walmart_product` SET `status`='" . WalmartProduct::PRODUCT_STATUS_NOT_UPLOADED . "' WHERE `status`='" . WalmartProduct::PRODUCT_STATUS_PROCESSING . "' AND `merchant_id`='" . $merchant_id . "'";
                    Data::sqlRecords($query1, null, 'update');

                    $query = "UPDATE `walmart_product_variants` SET `status`='" . WalmartProduct::PRODUCT_STATUS_NOT_UPLOADED . "' WHERE `status`='" . WalmartProduct::PRODUCT_STATUS_PROCESSING . "' AND `merchant_id`='" . $merchant_id . "'";
                    Data::sqlRecords($query, null, 'update');
                }

                $return = [];
                if($successCount)
                {
                    $return['success'] = true;
                    $return['success_count'] = $successCount;
                }

                if($errCount=count($errorSku))
                {
                    $return['error'] = true;//implode(', ',array_keys($errorSku));
                    $return['error_object'] = $errorSku;
                    $return['error_count'] = $errCount;
                }

                if($uptodateCount)
                {
                    $return['uptodate_count'] = $uptodateCount;
                }
                return json_encode($return);
            }
            else
            {
                return json_encode(['error'=>'Buybox Report Not found.']);
            }
        }
        else
        {
            return json_encode(['error'=>'Undefined Index']);
        }
    }

    public function prepareErrorCsv($data, $merchant_id, $default_file_path=null, $records='one')
    {
        if(count($data))
        {
            if(is_null($default_file_path)) {
                $file_path = strtr($this->_notOnAppFilePath, ['{merchant_id}'=>$merchant_id]);
                $default_file_path = Yii::getAlias('@webroot') . $file_path;
            }

            $dirName = dirname($default_file_path);

            if (!file_exists($dirName)) {
                mkdir($dirName, 0775, true);
            }

            if($records == 'one')
            {
                if(!file_exists($default_file_path)) {
                    $file = fopen($default_file_path, "a");
                    
                    $headers = array_keys($data);
                    fputcsv($file, $headers);
                }
                else {
                    $file = fopen($default_file_path, "a");
                }

                fputcsv($file, $data);
                fclose($file);
            }
            else
            {
                if(!file_exists($default_file_path)) {
                    $file = fopen($default_file_path, "a");
                    
                    $headers = current($data);
                    $headers = array_keys($headers);
                    fputcsv($file, $headers);
                }
                else {
                    $file = fopen($default_file_path, "a");
                }

                foreach ($data as $row) {
                    fputcsv($file, $row);
                }
                fclose($file);
            }
        }
    }

    public function actionNotInApp()
    {
        $merchant_id = Yii::$app->user->identity->id;

        $file_path = strtr($this->_notOnAppFilePath, ['{merchant_id}'=>$merchant_id]);
        $file_path = Yii::getAlias('@webroot') . $file_path;

        if(file_exists($file_path)) 
        {
            $gridData = WalmartReport::readItemCsv($file_path);

            $filterTypes = ['sku'=>'pattern', 'product_name'=>'pattern', 'product_category'=>'pattern', 'price'=>'equal', 'publish_status'=>'equal', 'inventory_count'=>'equal', 'upc'=>'equal'];

            $filterModel = new \frontend\modules\walmart\models\ArrayGridSearch();
            $queryParams = Yii::$app->request->queryParams;
            if(isset($queryParams['ArrayGridSearch']))
            {
                $filters = $queryParams['ArrayGridSearch'];
                foreach ($filters as $filterKey => $filterValue) {
                    $filterModel->$filterKey = $filterValue;

                    $filterValue = trim($filterValue);
                    $gridData = array_filter($gridData, function ($item) use (&$filterValue, &$filterKey, &$filterTypes) {
                        if($filterTypes[$filterKey] == 'pattern') {
                            return strlen($filterValue) > 0 ? stripos('/^' . strtolower($item[$filterKey]) . '/', strtolower($filterValue)) : true;
                        }
                        elseif($filterTypes[$filterKey] == 'equal') {
                            return strlen($filterValue) > 0 ? $item[$filterKey]==$filterValue : true;
                        }
                        else {
                            return strlen($filterValue) > 0 ? $item[$filterKey]==$filterValue : true;
                        }
                    });
                }
            }

            $data_provider = new ArrayDataProvider([
                            'allModels' => $gridData,
                            'sort' => [
                                'attributes' => array_keys($filterTypes),
                            ],
                            'pagination' => [
                                'pageSize' => 25
                            ]
                        ]);

            $gridColumns = [
                            [
                                'class' => 'yii\grid\CheckboxColumn',
                                'checkboxOptions' => function ($data) {
                                    return ['value' => $data['sku'], 'class' => 'bulk_checkbox'];
                                },
                                'headerOptions' => ['id' => 'checkbox_header']
                            ],
                            'sku',
                            [
                                'attribute' => 'primary_image_url',
                                'label' => 'IMAGE',
                                'format' => 'html',
                                'value' => function ($data) {

                                    $html = '';
                                    if ($data['primary_image_url']) {
                                        $html .= Html::img($data['primary_image_url'], ['height'=>80, 'width'=>80]);
                                    }
                                    return $html.'<a target="_blank" href="'.$data['item_page_url'].'">View on site&nbsp;<i class="fa fa-share-square-o" aria-hidden="true"></i></a>';
                                },
                            ],
                            'product_name', 
                            'product_category', 
                            'price', 
                            [
                                'attribute' => 'publish_status', 
                                'format' => 'html',
                                'value' => function ($data) {
                                    return '<span class="'.$data['publish_status'].'">'.$data['publish_status'].'</span>';
                                }
                            ],
                            'inventory_count',
                            'upc',
                        ];

            return $this->render('not_in_app', [
                        'data_provider' => $data_provider,
                        'gridColumns' => $gridColumns,
                        'filterModel' => $filterModel
                    ]);
        }
        else {
            Yii::$app->session->setFlash('error','No Items Found.');
            return $this->redirect(Yii::$app->request->referrer);
        }
    }

    public function actionRetire()
    {
        $session = Yii::$app->session;

        $merchant_id = Yii::$app->user->identity->id;
        
        $selected = [];

        $action = Yii::$app->request->post('action');
        if($action == 'selected') {
            $selected = Yii::$app->request->post('selection');
        } 
        else 
        {
            $file_path = strtr($this->_notOnAppFilePath, ['{merchant_id}'=>$merchant_id]);
            $file_path = Yii::getAlias('@webroot') . $file_path;

            if(file_exists($file_path)) {
                $gridData = WalmartReport::readItemCsv($file_path);
                $selected = array_column($gridData, 'sku');
            }
        }
        
        $productCount = count($selected);
        
        if($productCount)
        {
            $size_of_request = 10; //Number of products to be retired
            $pages = (int)(ceil($productCount / $size_of_request));

            $selected = array_chunk($selected, $size_of_request);
            
            $session->set('retire_not_in_app_product', $selected);

            return $this->render('retire_notinapp_product', [
                'total_products' => $productCount,
                'pages' => $pages
            ]);
        }
        else
        {
            Yii::$app->session->setFlash('error','No Items Found.');
            return $this->redirect(Yii::$app->request->referrer);
        }
    }

    public function actionRetirepost()
    {
        $session = Yii::$app->session;

        $returnArr = [];

        $index = Yii::$app->request->post('index', false);

        if($index === false) {
            return json_encode(['error' => 1, 'error_msg' => 'No Products to Retire']);
        }

        $selectedProducts = isset($session['retire_not_in_app_product'][$index]) ? $session['retire_not_in_app_product'][$index] : [];
        $count = count($selectedProducts);

        if (!$count) {
            $returnArr = ['error' => 1, 'error_msg' => 'No Products to Retire'];
        } else {
            $merchant_id = Yii::$app->user->identity->id;

            try {
                $success = [];
                $errors = [];
                foreach ($selectedProducts as $sku) 
                {
                    $retireProduct = new Walmartapi(API_USER, API_PASSWORD);
                    $feed_data = $retireProduct->retireProduct($sku);

                    if (isset($feed_data['ItemRetireResponse'])) 
                    {
                        $success[] = '<b>' . $feed_data['ItemRetireResponse']['sku'] . ' : </b>' . $feed_data['ItemRetireResponse']['message'];
                    } 
                    elseif (isset($feed_data['errors']['error'])) 
                    {
                        if (isset($feed_data['errors']['error']['code']) && $feed_data['errors']['error']['code'] == "CONTENT_NOT_FOUND.GMP_ITEM_INGESTOR_API" && $feed_data['errors']['error']['field'] == "sku") {
                            $errors[] = $sku . ' : Product not Found on Walmart.';
                        } else {
                            $errors[] = $sku . ' : ' . $feed_data['errors']['error']['description'];
                        }
                    } 
                    else 
                    {
                        $errors[] = $sku . ' : Sku not retired.';
                    }
                }

                if ($ecount=count($errors)) {
                    $returnArr['error'] = 1;
                    $returnArr['errored_sku'] = $errors;
                    $returnArr['error_count'] = $ecount;
                }

                if ($scount=count($success)) {
                    $returnArr['success'] = 1;
                    $returnArr['success_count'] = $scount;
                }
            } catch (Exception $e) {
                $returnArr = ['error' => 1, 'error_msg' => $e->getMessage()];
            }
        }
        return json_encode($returnArr);
    }
}