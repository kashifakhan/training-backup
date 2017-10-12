<?php


namespace frontend;
use common\models\Merchant;
use common\models\MerchantDb;
use Yii;

/**
 * Created by PhpStorm.
 * User: cedcoss
 * Date: 6/10/17
 * Time: 12:34 PM
 */
class ApplicationPricefalls extends \yii\web\Application
{

    public $dbConnection = false;

    public function getDb($force=false) {
        if(!$this->dbConnection || $force)
        {

            if($id = $this->request->get('ext', false)){

                if($data = $this->getDbConnctionThroughId($id)){
                    $this->dbConnection = $this->get($data['db_name']);
                }

            }
            elseif($shopName = $this->request->get('shop', false)){
                if(($data = $this->getDbConnctionThroughShop($shopName)) && is_array($data) && isset($data['db_name']) && trim($data['db_name'])!=""){
                    $this->dbConnection = $this->get($data['db_name']);
                }
            }
            elseif(isset($_SERVER['HTTP_X_SHOPIFY_SHOP_DOMAIN'])){
                $shopName = $_SERVER['HTTP_X_SHOPIFY_SHOP_DOMAIN'];
                if($data = $this->getDbConnctionThroughShop($shopName)){
                    $this->dbConnection = $this->get($data['db_name']);
                }
            }
            elseif($shopName = $this->request->post('shopName', false)){
                if($data = $this->getDbConnctionThroughShop($shopName)){
                    $this->dbConnection = $this->get($data['db_name']);
                }
            }
            elseif($shopName = $this->request->post('myshopify_domain', false)){
                if($data = $this->getDbConnctionThroughShop($shopName)){
                    $this->dbConnection = $this->get($data['db_name']);
                }
            }
            elseif($id = $this->getSession()->get('__id')){
                if($data = $this->getDbConnctionThroughId($id)){
                   $this->dbConnection = $this->get($data['db_name']);
                }
            }

            if(!$this->dbConnection){

                //return current db name
                $dbName = $this->getCurrentDb();

                $this->dbConnection = $this->get($dbName);

            }
            var_dump($this->dbConnection);die;
        }
        return $this->dbConnection;
    }

    public function getDbConnctionThroughId($id){
        $id = $this->getMerchantId($id);
        $baseDb = $this->getBaseDb();
        $connection = $this->get($baseDb);
        return $connection->createCommand("SELECT db_name FROM merchant_db WHERE merchant_id='{$id}'")->queryOne();
    }

    public function getDbConnctionThroughShop($shop){
        $baseDb = $this->getBaseDb();
        $connection = $this->get($baseDb);
        return $connection->createCommand("SELECT db_name FROM merchant_db WHERE shop_name='{$shop}'")->queryOne();
    }

    /**
     * Name of databse in which new merchants will be stored.
     */
    public function getCurrentDb()
    {
        return 'db';
    }

    /**
     * Name of databse in which `merchant_db` table is created.
     */
    public function getBaseDb()
    {
        return 'db';
    }

    /**
     * get Merchant Id
     */

    public function  getMerchant()
    {

    }

    public function getMerchantId($id)
    {
        return $id;
    }

    public function getDbList()
    {
        $dbList = [];

        $webroot =  Yii::getAlias('@webroot');
        $filePath = $webroot.'/common/config/main-local.php';
        if (file_exists($filePath))
        {
            $config = require $filePath;
            $components = isset($config['components']) ? $config['components'] : [];
            foreach ($components as $compKey => $compData)
            {
                if(isset($compData['class']) && $compData['class']=='yii\db\Connection'){
                    $dbList[] = $compKey;
                }
            }
        }

        return $dbList;
    }
}