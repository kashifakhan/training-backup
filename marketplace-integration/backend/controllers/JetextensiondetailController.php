<?php
namespace backend\controllers;

use Yii;
use app\models\JetExtensionDetail;
use app\models\JetExtensionDetailSearch;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use backend\components\Sendmail;
use frontend\components\Data;
use common\models\JetProduct;
use common\components\Xmlapi;


/**
 * JetextensiondetailController implements the CRUD actions for JetExtensionDetail model.
 */
class JetextensiondetailController extends Controller
{
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

    /**
     * Lists all JetExtensionDetail models.
     * @return mixed
     */
    public function actionIndex()
    {
    	if (\Yii::$app->user->isGuest) {
    		return $this->goHome();
    	}
        $searchModel = new JetExtensionDetailSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
       
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
   
    /**
     * Displays a single JetExtensionDetail model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
    	if (\Yii::$app->user->isGuest) {
    		return $this->goHome();
    	}
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new JetExtensionDetail model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
    	if (\Yii::$app->user->isGuest) {
    		return $this->goHome();
    	}
        $model = new JetExtensionDetail();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing JetExtensionDetail model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
    	if (\Yii::$app->user->isGuest) {
    		return $this->goHome();
    	}
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing JetExtensionDetail model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
    	if (\Yii::$app->user->isGuest) {
    		return $this->goHome();
    	}
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    public function actionBulk()
    {
        $selection = Yii::$app->request->post('selection');
        $bulk_option = Yii::$app->request->post('bulk_name');
        return $this->redirect([$bulk_option,'selection'=>$selection]);
    }
    public function actionExport()
    {
    	if(isset($_GET['selection']))
        {
            $selection=(array)$_GET['selection'];

            $connection=Yii::$app->getDb();
            //$selection=(array)Yii::$app->request->post('selection');
            
            if (!file_exists(\Yii::getAlias('@webroot').'/var/email_csv-'.date('Y-m-d'))){
                mkdir(\Yii::getAlias('@webroot').'/var/email_csv-'.date('Y-m-d'),0775, true);
            }
            $base_path=\Yii::getAlias('@webroot').'/var/email_csv-'.date('Y-m-d').'/'.time().'.csv';
            $file = fopen($base_path,"a+");
            $headers = array('Merchant id','Shop Url','Email id','Purchase Status','Install Status','Expire Date');
            $row = array();
            $value=array();
            
            foreach($headers as $header) {
                $row[] = $header;
            }
            fputcsv($file,$row);

            $csvdata=array();
            $i=0;
            foreach ($selection as $val)
            {
                
                $client=$connection->createCommand("select `merchant_id` ,`email`,`shopurl`,`status`,`app_status`,`expire_date`   from  `jet_extension_detail` WHERE `merchant_id`='".$val."'  ")->queryAll();
                        
                foreach($client as $value)
                {
                    
 
                    $csvdata[$i]['Merchant id']=$value['merchant_id'];
                    $csvdata[$i]['Shop Url']=$value['shopurl'];
                    $csvdata[$i]['Email id']=$value['email'];
                    $csvdata[$i]['Purchase Status']=$value['status'];
                    $csvdata[$i]['Install Status']=$value['app_status'];
                    $csvdata[$i]['Expire Date']=$value['expire_date'];
                    $i++; 
                }
                
            }
            foreach($csvdata as $v)
            {
                
                $row = array();
                $row[] =$v['Merchant id'];
                $row[] =$v['Shop Url'];
                $row[] =$v['Email id'];
                $row[] =$v['Purchase Status'];
                $row[] =$v['Install Status'];
                $row[] =$v['Expire Date'];
            
                fputcsv($file,$row);
            }
            fclose($file);
            //$link=Yii::$app->request->baseUrl.'/var/product_csv-'.$merchant_id.'/products.csv';
            $encode = "\xEF\xBB\xBF"; // UTF-8 BOM
            $content = $encode . file_get_contents($base_path);
            return  Yii::$app->response->sendFile($base_path);
            //                  die;
        }
    	
    	
    }
    /**
     * create staff acount for new customer with cedcommerce email.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return JetExtensionDetail the loaded model
     * 
     */

    public function actionStaffAccount()
    {
        if(isset($_GET['selection']))
        {
            $selection=(array)$_GET['selection'];
            $count=0;
            $isAvailable=0;
            if(is_array($selection) && count($selection)>0)
            {
                foreach ($selection as $key => $value) 
                {
                    $ip = JetExtensionDetail::IP;           // should be server IP address or 127.0.0.1 if local server
                    $account = JetExtensionDetail::USER;        // cpanel user account name
                    $passwd =JetExtensionDetail::PASSWORD;        // cpanel user password
                    $port = JetExtensionDetail::PORT;                 // cpanel secure authentication port unsecure port# 2082
                    $email_domain = JetExtensionDetail::DOMAIN; // email domain (usually same as cPanel domain)
                    $email_quota = JetExtensionDetail::EMAIL_QUOTA; // default amount of space in megabytes  

                    // check if overrides passed
                    $email_user = "ced-merchant-".$value;
                    $email_pass = "cedcoss007";

                    //create user account
                    $xmlapi = new Xmlapi($ip);
                    $xmlapi->set_port($port);
                    $xmlapi->password_auth($account, $passwd);
                    $call = array('domain'=>$email_domain, 'email'=>$email_user, 'password'=>$email_pass, 'quota'=>$email_quota);
                    $xmlapi->set_debug(0);      //output to error file  set to 1 to see error_log.

                    $result = $xmlapi->api2_query($account, "Email", "addpop", $call); 
                    if(isset($result->data->result) && $result->data->result==1)
                    {
                        $email_id=$email_user.'@'.$email_domain;
                        $query="SELECT id FROM `staff_account_members` WHERE merchant_id=".$value." LIMIT 0,1";
                        $emailColl=Data::sqlRecords($query,'one','select');
                        if(!$emailColl){
                            //insert new staff account
                            $count++;
                            $query="INSERT INTO `staff_account_members`(`merchant_id`, `email`, `password`) VALUES ('".$value."','".$email_id."','".$email_pass."')";
                            Data::sqlRecords($query,null,'insert');
                        }else{
                            $isAvailable++;
                        }
                    }
                }
                if($count>0)
                {
                    Yii::$app->session->setFlash('success',$count. "staff account created successfully");
                    return $this->redirect(Yii::$app->getUrlManager()->getBaseUrl().'/staff-merchant/index');
                }elseif($isAvailable>0){
                    Yii::$app->session->setFlash('success',"staff account already available");
                    return $this->redirect(Yii::$app->getUrlManager()->getBaseUrl().'/staff-merchant/index');
                }
                return $this->redirect(['index']);
            }
        }
    }
    /**
     * Finds the JetExtensionDetail model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return JetExtensionDetail the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionMailstatus(){
            $email1="moattarraza@cedcoss.com";
             Sendmail:: configMail($email1);
                print_r("expression"); die('y');
        $model = JetExtensionDetail::find()->select('merchant_id,status,install_date,expire_date,email')->all();
        foreach($model as $value) {
            //$email = $value['email'];

            $email="moattarraza@cedcoss.com";
            $merchant_id = $value['merchant_id'];
            $status = $value['status'];
            $install_date = date("Y-m-d",strtotime($value['install_date']));
            $expire_date = date("Y-m-d",strtotime($value['expire_date']));
            $date=date('Y-m-d',strtotime('+5 days', strtotime(date('Y-m-d'))));
            $date2=date('Y-m-d',strtotime('+1 days', strtotime(date('Y-m-d'))));
            $date3=date('Y-m-d',strtotime('-1 days', strtotime(date('Y-m-d'))));
            $date4=date('Y-m-d',strtotime('-4 days', strtotime(date('Y-m-d'))));
               
            if ($expire_date == $date) {
                
                if ($status =="Not Purchase") {
                    $config = Yii::$app->getDb()->createCommand("SELECT `api_user` FROM  `jet_configuration` where `merchant_id`='".$merchant_id."'")->queryOne();
                    if ($config!="") {
                            $sql = 'SELECT status FROM jet_product where status="Available for Purchase" AND merchant_id='.$merchant_id;
                            $result = count(JetProduct::findBySql($sql)->all());
                            $sql1 = 'SELECT status FROM jet_product where status="Under Jet Review" AND merchant_id='.$merchant_id;
                            $result1 = count(JetProduct::findBySql($sql1)->all());
                            $content ='<table align="left" border="0" cellpadding="0" cellspacing="0" style="max-width:90%; min-width:90%;"  class="mcnTextContentContainer">
                                     <tbody><tr>                                         
                                        <td valign="top" class="mcnTextContent" style="padding-top:0; padding-right:18px; padding-bottom:9px; padding-left:36px;">
                                        
                                            <h1>Hello,</h1> <p>&nbsp;</p>

                                        <p>Thank you for choosing us to sell on Jet.com. We work relentlessly so that your experience gets better with each progressing day.</p> <p>&nbsp;</p>
                                        <p><strong>Your '.$result.' products are already live for sale and another '.$result1.' products are under review on Jet.com and also, we hope you upload more products on Jet.com.</strong></p>  <p>&nbsp;</p>
                                        <p>However, we are afraid to tell you that <strong>your FREE TRIAL period  will expire on'.$expire_date.'.</strong> So its a<strong> friendly reminder that you RENEW your monthly subscription.</strong></p> <p>&nbsp;</p>
                                        <p>Contact our support team over skype (Id:<strong> live:support_35785</strong>) to get the further details and offers as it would be your first payment.</p> <p>&nbsp;</p>

                                        <p><strong>We look forward to conducting future business with you.</strong></p> <p>&nbsp;</p>
                                        <p><strong>Kind regards</strong></p>
                                        <p><strong>Cedcommerce Team</strong></p>
                                        </td>
                                        </tr>
                                    </tbody>
                                </table>';

                        Sendmail::commonMail($email,$content);
                    }
                    else{
                       
                        Sendmail:: configMail($email);

                    }

                }
            }
            elseif($expire_date == $date2){
                     if ($status =="Not Purchase") {
                   $config = Yii::$app->getDb()->createCommand("SELECT `api_user` FROM  `jet_configuration` where `merchant_id`='".$merchant_id."'")->queryOne();
                    if ($config!="") {
                        $sql = 'SELECT status FROM jet_product where status="Available for Purchase" AND merchant_id='.$merchant_id;
                        $result = count(JetProduct::findBySql($sql)->all());
                        $sql1 = 'SELECT status FROM jet_product where status="Under Jet Review" AND merchant_id='.$merchant_id;
                        $result1 = count(JetProduct::findBySql($sql1)->all());
                        $content ='<table align="left" border="0" cellpadding="0" cellspacing="0" style="max-width:90%; min-width:90%;"  class="mcnTextContentContainer">
                                     <tbody><tr>                                         
                                        <td valign="top" class="mcnTextContent" style="padding-top:0; padding-right:18px; padding-bottom:9px; padding-left:36px;">
                                        
                                            <h1>Hello,</h1> <p>&nbsp;</p>

                                        <p>Thank you for choosing us to sell on Jet.com. We work relentlessly so that your experience gets better with each progressing day.</p> <p>&nbsp;</p>
                                        <p><strong>Your '.$result.' products are already live for sale and another '.$result1.' products are under review on Jet.com and also, we hope you upload more products on Jet.com.</strong></p>  <p>&nbsp;</p>
                                        <p>However, we are afraid to tell you that <strong>your FREE TRIAL period will expire on'.$expire_date.'.</strong> So its a<strong> friendly reminder that you RENEW your monthly subscription.</strong></p> <p>&nbsp;</p>
                                        <p>Contact our support team over skype (Id:<strong> live:support_35785</strong>) to get the further details and offers as it would be your first payment.</p> <p>&nbsp;</p>

                                        <p><strong>We look forward to conducting future business with you.</strong></p> <p>&nbsp;</p>
                                        <p><strong>Kind regards</strong></p>
                                        <p><strong>Cedcommerce Team</strong></p>
                                        </td>
                                        </tr>
                                    </tbody>
                                </table>';

                    Sendmail::commonmail($email,$content);
                        
                    }
                    else{

                     Sendmail:: configMail($email);

                    }
                }
            }
            elseif ($install_date == $date3) {
                $config = Yii::$app->getDb()->createCommand("SELECT `api_user` FROM  `jet_configuration` where `merchant_id`='".$merchant_id."'")->queryOne();
                if ($config=="") {
                        Sendmail:: configMail($email);
                }

            }
            elseif ($install_date == $date4) {
                $config = Yii::$app->getDb()->createCommand("SELECT `api_user` FROM  `jet_configuration` where `merchant_id`='".$merchant_id."'")->queryOne();
                if ($config=="") {
                    Sendmail:: configMail($email);
                }
            }            
        }
    }
    protected function findModel($id)
    {
        if (($model = JetExtensionDetail::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    public function actionProductvalidation()
    {
        $Res = $resArr = [];
        $Res = Data::sqlRecords("SHOW TABLES FROM cedcom5_sPy11F");
        $resArr[''] = "--Choose column--";
        foreach ($Res as $key => $value) 
        {            
           $resArr[$value['Tables_in_cedcom5_sPy11F']] = $value['Tables_in_cedcom5_sPy11F'];
        }
        return $this->render('validator', [
            'tablename' => $resArr,
        ]);
    }
    public function actionValidationresponse()
    {
        $columnData = $columnNames = [];
        $sql=trim(Yii::$app->request->post('sql'));
        $columnData = Data::sqlRecords($sql,'all','select');
        
        $ColumnNameDetails =  '<td id="column_details">
                <select id="column_name" name="column_name" class="form-control">';                    
                    foreach($columnData as $key => $val)
                    {
                        $ColumnNameDetails .= '<option value="'.$val["Field"].'">'.$val["Field"].'</option>'; 
                    }                    
                $ColumnNameDetails .='</select>                        
            </td><td><input type="text" name="search_name" id="search_name"></td>';     
        return $ColumnNameDetails;
    }
    public function actionValidationresult()
    {
        $merchant_id=trim(Yii::$app->request->post('merchant_id'));
        $table_name=trim(Yii::$app->request->post('table_name'));
        $column_name=trim(Yii::$app->request->post('column_name'));
        $search_field=trim(Yii::$app->request->post('search_field'));
        $query = "SELECT {$column_name} FROM {$table_name} WHERE `merchant_id`='{$merchant_id}' AND {$column_name}='{$search_field}' ";
        $ResultData = Data::sqlRecords($query,'all','select');
        echo "<pre>";
        print_r($ResultData);
        die("<hr>Details End");
    }
}