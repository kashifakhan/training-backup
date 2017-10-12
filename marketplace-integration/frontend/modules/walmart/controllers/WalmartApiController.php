<?php
namespace frontend\modules\walmart\controllers;

use Yii;
use yii\web\Controller;
use frontend\modules\walmart\models\WalmartConfiguration;
use frontend\modules\walmart\components\Data;
use frontend\modules\walmart\components\Walmartappdetails;

class WalmartApiController extends Controller
{
    public function actionSave()
    {   
        $blockedMerchants = [];
        if ($postData = Yii::$app->request->post())
        {
            $merchant_id = Yii::$app->user->identity->id;
            $consumer_id = trim($postData['consumer_id']);
            $secret_key = trim($postData['secret_key']);
            //$consumer_channel_type_id = trim($_POST['consumer_channel_type_id']);
            $consumer_channel_type_id = '7b2c8dab-c79c-4cee-97fb-0ac399e17ade';
            $skype_id = trim($_POST['skype_id']);
            
            if(in_array($merchant_id, $blockedMerchants)) {
                return json_encode(['error'=>true, "message"=>"You are not authenticated. Please Contact us at shopify@cedcommerce.com for more detail."]);
            }
            
            if($consumer_id == "" || $secret_key == "" || $consumer_channel_type_id == "") {
                return json_encode(['error'=>true, "message"=>"Api credentials are invalid. Please enter valid api credentials"]);
            }
            
            if(!Walmartappdetails::validateApiCredentials($consumer_id, $secret_key, $consumer_channel_type_id)) {
                return json_encode(['error'=>true, "message"=>"Api credentials are invalid. Please enter valid api credentials"]);
            }

            //Check if Details are already used by some other merchant
            $data = Data::sqlRecords("SELECT `merchant_id` FROM `walmart_configuration` WHERE `consumer_id`='".$consumer_id."' AND `secret_key`='".$secret_key."'", 'one');
            if($data && isset($data['merchant_id']) && $data['merchant_id'] != $merchant_id) {
                return json_encode(['error'=>true, "message"=>"Api Credentials are already in use."]);
            }

            $result = WalmartConfiguration::find()->where(['merchant_id'=>$merchant_id])->one();
            if(is_null($result)) {
                $model = new WalmartConfiguration();
                $model->merchant_id = $merchant_id;
                $model->consumer_id = $consumer_id;
                $model->secret_key = $secret_key;
                $model->consumer_channel_type_id = $consumer_channel_type_id;
                $model->skype_id = $skype_id;
                $model->save(false);
            } else {
                $result->consumer_id = $consumer_id;
                $result->secret_key = $secret_key;
                $result->consumer_channel_type_id = $consumer_channel_type_id;
                $result->skype_id = $skype_id;
                $result->save(false);
            }

            return json_encode(['success'=>true, "message"=>"Walamrt Configurations has been Saved Successfully!"]);
        }
        return json_encode(['error'=>true, "message"=>"Api credentials are invalid. Please enter valid api credentials"]); 
    }
}