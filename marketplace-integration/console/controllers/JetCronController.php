<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;
use frontend\modules\jet\components\Data;
use frontend\modules\jet\components\Jetproductinfo;
use frontend\modules\jet\components\Jetapimerchant;
use frontend\modules\jet\controllers\JetcronController as Shopifyjet;
use frontend\modules\jet\controllers\JetinvsyncController;

/**
* Cron controller
*/
class JetCronController extends Controller 
{
  public function actionIndex() 
  {    
    // echo "cron service runnning";
    echo getcwd();     
  }
  public function actionRefundstatus()
  {
    $obj = new Shopifyjet(Yii::$app->controller->id,'');
    $obj->actionUpdaterefundstatus(true);
  }
  public function actionCreatereturn()
  {
    $obj = new Shopifyjet(Yii::$app->controller->id,'');
    $obj->actionCreatejetreturn(true);
  }

  public function getErrorArray($errorsArray,$array)
  {
    if(isset($errorsArray[$array['merchant_order_id']])){
      $array['reason'] = $errorsArray[$array['merchant_order_id']]['reason'].'<br>'.$array['reason'];
      $errorsArray[$array['merchant_order_id']] = $array;
    }
    else
    {
      $errorsArray[$array['merchant_order_id']] = $array;
    }
    return $errorsArray;
  }
  /*public function actionProductstatus()
  {
    $obj = new Shopifyjet(Yii::$app->controller->id,'');
    $obj->actionUpdatejetproductstatus(true);
  } 
  public function actionUpdateonjet()
  {
    $obj = new Shopifyjet(Yii::$app->controller->id,'');
    $obj->actionUpdateProductOnJet(true);
  }  
  */
  public function actionUpdatepaymentstatus()
  {
    $obj = new Shopifyjet(Yii::$app->controller->id,'');
    $obj->actionUpdaterecurringpaymentstatus(true);
  }// RecurringPaymentUpdate end
    
  public function actionInventoryUpdate()
  {
      try
      {
        $limit=700;
        $query="select id,total_count,last_offset from jet_product_cron_update where id=1 limit 0,1";
        $handle=Data::createFile('product/updateInventory/'.date('d-m-Y').'.log');
        $countIds=Data::sqlRecords($query,'one','select');
        if(is_array($countIds) && count($countIds)>0)
        {
            //fwrite($handle, PHP_EOL."Product inventory update-".date('d-m-Y H:i:s').PHP_EOL);
            $offset=$countIds['last_offset']*$limit;
            //echo $offset;
            Jetproductinfo::getProductInventory($offset,$limit,$handle);
            $newTotal=$countIds['total_count']-1;
            $last_offset=$countIds['last_offset']+1;
            if($newTotal>0)
            {
                Data::sqlRecords('update jet_product_cron_update set last_offset="'.$last_offset.'",total_count="'.$newTotal.'" where id=1',null,'update');
            }
            else
            {
                Data::sqlRecords('delete from jet_product_cron_update where id=1',null,'delete');
            }
        }
        else
        {
            fwrite($handle, PHP_EOL."Product inventory update-".date('d-m-Y H:i:s').PHP_EOL);
            $query="select count(*) id from `jet_product` jet LEFT JOIN `walmart_product` wal ON jet.id=wal.product_id where jet.status='Under Jet Review' or jet.status='Available for Purchase' or wal.status='PUBLISHED' order by jet.status='Available for Purchase' DESC";
            $TotalProduCount=Data::sqlRecords($query,'all','select');
            if(isset($TotalProduCount[0]['id']))
            {
               fwrite($handle, PHP_EOL."Total products-".$TotalProduCount[0]['id'].PHP_EOL);
               $totalProductMarched=$TotalProduCount[0]['id'];
               $offset_count=ceil($totalProductMarched/$limit); 
               Jetproductinfo::getProductInventory(0,$limit,$handle);
               $total_rem_offset=$offset_count-1;
               $query="select id,total_count,last_offset from jet_product_cron_update where id=1 limit 0,1";
               $countProductOffset=Data::sqlRecords($query,'one','select');
               if(!$countProductOffset)
                 Data::sqlRecords('INSERT INTO `jet_product_cron_update`(`id`,`total_count`, `last_offset`) VALUES (1,"'.$total_rem_offset.'",1)',null,'insert');
            }
        }
        fwrite($handle, PHP_EOL."Total products update end-".PHP_EOL);
        fclose($handle); 
      }
      catch(\yii\db\Exception $e)
      {
        fwrite($handle, PHP_EOL."dbException-".PHP_EOL.$e->getMessage());
        fclose($handle); 
        exit(0);
      }
      catch(Exception $e){
        fwrite($handle, PHP_EOL."phpException-".PHP_EOL.$e->getMessage());
        fclose($handle); 
        exit(0);
      }       
  }  
  /*public function actionCancelfailedorder(){
    $obj = new Shopifyjet(Yii::$app->controller->id,'');
    $obj->actionRemovefailedorders(true);
  }*/
  public function actionUpdatedynamicprice(){
    $obj = new Shopifyjet(Yii::$app->controller->id,'');
    $obj->actionDynamicprice(true);
  }  

  public function actionFetchjetorder()
  {
    $obj = new Shopifyjet(Yii::$app->controller->id,'');
    $obj->actionFetchorder(true);
  }

  public function actionSyncshopifyorder()
  {
    $obj = new Shopifyjet(Yii::$app->controller->id,'');
    $obj->actionSyncorder(true);
  }
  public function actionGetshipment(){
    $obj = new Shopifyjet(Yii::$app->controller->id,'');
    $obj->actionShiporder(true);
  }
  public function actionCheckApiStatus()
  {

    $jetApiScheduleData=Data::sqlRecords("SELECT `api_data`, `api_url`, `api_request_type`, `is_enabled`,`merchant_id` FROM `jet_api_schedule` WHERE `id`=1","one","select");

    if(isset($jetApiScheduleData['is_enabled']) && $jetApiScheduleData['is_enabled']==1)
    {
      $merchant_id=$jetApiScheduleData['merchant_id'];
      $jetConfiguration=Data::sqlRecords("SELECT `api_user`,`api_password` FROM `jet_configuration` WHERE merchant_id='".$merchant_id."' LIMIT 0,1","one","select");
      if(isset($jetConfiguration['api_user']))
      {
        $jetHelper = new Jetapimerchant(API_HOST,$jetConfiguration['api_user'],$jetConfiguration['api_password']);
        $status=false;
        if($jetApiScheduleData['api_request_type']=="GET")
        {

          $jetHelper->CGetRequest($jetApiScheduleData['api_request_type'],$merchant_id,$status);

        }
        elseif($jetApiScheduleData['api_request_type']=="POST")
        {
          
          $jetHelper->CPostRequest($jetApiScheduleData['api_request_type'],$jetApiScheduleData['api_data'], $merchant_id,$status);

        }
        else
        {

          $jetHelper->CPutRequest($jetApiScheduleData['api_request_type'],$jetApiScheduleData['api_data'], $merchant_id,$status);

        }
        if($status && $status!=503)
        {

          Data::sqlRecords("DELETE FROM `jet_api_schedule` WHERE id=1");
          
        }
      }
    }
  }

  /*  
   * Update all inventory on jet within 24 hours 
   * */
  public function actionInventoryupdatejson()
  {
  	//$startTime = microtime(true);
  	$obj = new JetinvsyncController(Yii::$app->controller->id,'');
  	$obj->actionUploadinventory(true);
  	/* $endTime = microtime(true);
  	echo $startTime.'-'.$endTime."=".($endTime-$startTime)/60;
  	die("<hr>");  */ 
  }
  /* 
   * Process uploaded inventory json file
   *  */
  public function actionProcessinvjson()
  {
  	//$startTime = microtime(true);
  	$obj = new JetinvsyncController(Yii::$app->controller->id,'');
  	$obj->actionProcessuploadedfiles(true);
  	//$endTime = microtime(true);
  	//echo $startTime.'-'.$endTime."=".($endTime-$startTime)/60;
  	//die("<hr>");
  }
}
