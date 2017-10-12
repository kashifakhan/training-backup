<?php 
namespace frontend\modules\walmart\components\Dashboard;

use Yii;
use yii\base\Component;
use frontend\modules\walmart\components\Data;
use frontend\modules\walmart\models\WalmartProduct;

class Productinfo extends Component
{
    public static $_totalProducts = null;
    public static $_publishedProducts = null;
    public static $_unpublishedProducts = null;
    public static $_stageProducts = null;
    public static $_notUploadedProducts = null;
    public static $_processingProducts = null;

    /**
     * get Total Products Count
     * @param string $merchant_id
     * @return int
     */
    public static function getTotalProducts($merchant_id)
    {
        if(is_null(self::$_totalProducts))
        {
            self::$_totalProducts = 0;

            if(is_numeric($merchant_id)) {
                $query = "SELECT COUNT(*) as `count` FROM `walmart_product` LEFT JOIN `walmart_product_variants` ON `walmart_product`.`product_id`=`walmart_product_variants`.`product_id` WHERE `walmart_product`.`merchant_id`=".$merchant_id." LIMIT 0,1";
                $result = Data::sqlRecords($query, 'one');
                if(isset($result['count']) && $result['count']) {
                    self::$_totalProducts = $result['count'];
                }
            }
        }
        return self::$_totalProducts;
    }

    /**
     * get Published Products Count
     * @param string $merchant_id
     * @return int
     */
    public static function getPublishedProducts($merchant_id)
    {
        if(is_null(self::$_publishedProducts))
        {
            self::$_publishedProducts = 0;

            if(is_numeric($merchant_id)) {
                $query = "SELECT COUNT(*) as `count` FROM `walmart_product` LEFT JOIN `walmart_product_variants` ON `walmart_product`.`product_id`=`walmart_product_variants`.`product_id` WHERE `walmart_product`.`merchant_id`=".$merchant_id." AND `walmart_product`.`status`='".WalmartProduct::PRODUCT_STATUS_UPLOADED."' AND `walmart_product_variants`.`status`='".WalmartProduct::PRODUCT_STATUS_UPLOADED."'"." LIMIT 0,1";
                $result = Data::sqlRecords($query, 'one');
                if(isset($result['count']) && $result['count']) {
                    self::$_publishedProducts = $result['count'];
                }
            }
        }
        return self::$_publishedProducts;
    }

    /**
     * get Unpublished Products Count
     * @param string $merchant_id
     * @return int
     */
    public static function getUnpublishedProducts($merchant_id)
    {
        if(is_null(self::$_unpublishedProducts))
        {
            self::$_unpublishedProducts = 0;

            if(is_numeric($merchant_id)) {
                $query = "SELECT COUNT(*) as `count` FROM `walmart_product` LEFT JOIN `walmart_product_variants` ON `walmart_product`.`product_id`=`walmart_product_variants`.`product_id` WHERE `walmart_product`.`merchant_id`=".$merchant_id." AND `walmart_product`.`status`='".WalmartProduct::PRODUCT_STATUS_UNPUBLISHED."' AND `walmart_product_variants`.`status`='".WalmartProduct::PRODUCT_STATUS_UNPUBLISHED."'"." LIMIT 0,1";
                $result = Data::sqlRecords($query, 'one');
                if(isset($result['count']) && $result['count']) {
                    self::$_unpublishedProducts = $result['count'];
                }
            }
        }
        return self::$_unpublishedProducts;
    }

    /**
     * get Staged Products Count
     * @param string $merchant_id
     * @return int
     */
    public static function getStagedProducts($merchant_id)
    {
        if(is_null(self::$_stageProducts))
        {
            self::$_stageProducts = 0;

            if(is_numeric($merchant_id)) {
                $query = "SELECT COUNT(*) as `count` FROM `walmart_product` LEFT JOIN `walmart_product_variants` ON `walmart_product`.`product_id`=`walmart_product_variants`.`product_id` WHERE `walmart_product`.`merchant_id`=".$merchant_id." AND `walmart_product`.`status`='".WalmartProduct::PRODUCT_STATUS_STAGE."' AND `walmart_product_variants`.`status`='".WalmartProduct::PRODUCT_STATUS_STAGE."'"." LIMIT 0,1";
                $result = Data::sqlRecords($query, 'one');
                if(isset($result['count']) && $result['count']) {
                    self::$_stageProducts = $result['count'];
                }
            }
        }
        return self::$_stageProducts;
    }

    /**
     * get Not Uploaded Products Count
     * @param string $merchant_id
     * @return int
     */
    public static function getNotUploadedProducts($merchant_id)
    {
        if(is_null(self::$_notUploadedProducts))
        {
            self::$_notUploadedProducts = 0;

            if(is_numeric($merchant_id)) {
                $query = "SELECT COUNT(*) as `count` FROM `walmart_product` LEFT JOIN `walmart_product_variants` ON `walmart_product`.`product_id`=`walmart_product_variants`.`product_id` WHERE `walmart_product`.`merchant_id`=".$merchant_id." AND `walmart_product`.`status`='".WalmartProduct::PRODUCT_STATUS_NOT_UPLOADED."' AND (`walmart_product_variants`.`status`='".WalmartProduct::PRODUCT_STATUS_NOT_UPLOADED."' OR `walmart_product_variants`.`status` IS NULL) LIMIT 0,1";

                $result = Data::sqlRecords($query, 'one');
                if(isset($result['count']) && $result['count']) {
                    self::$_notUploadedProducts = $result['count'];
                }
            }
        }
        return self::$_notUploadedProducts;
    }

    /**
     * get Processing Products Count
     * @param string $merchant_id
     * @return int
     */
    public static function getProcessingProducts($merchant_id)
    {
        if(is_null(self::$_processingProducts))
        {
            self::$_processingProducts = 0;

            if(is_numeric($merchant_id)) {
                $query = "SELECT COUNT(*) as `count` FROM `walmart_product` LEFT JOIN `walmart_product_variants` ON `walmart_product`.`product_id`=`walmart_product_variants`.`product_id` WHERE `walmart_product`.`merchant_id`=".$merchant_id." AND `walmart_product`.`status`='".WalmartProduct::PRODUCT_STATUS_PROCESSING."' AND `walmart_product_variants`.`status`='".WalmartProduct::PRODUCT_STATUS_PROCESSING."'"." LIMIT 0,1";
                $result = Data::sqlRecords($query, 'one');
                if(isset($result['count']) && $result['count']) {
                    self::$_processingProducts = $result['count'];
                }
            }
        }
        return self::$_processingProducts;
    }

    public function getProductsCountUpdatedToday($merchantId){
        if(is_numeric($merchantId)) {
                $result = [];
                $dateTimeFrom = date('Y-m-d 00:00:00');
                $dateTimeTo = date('Y-m-d 23:59:59');
                $query = "SELECT COUNT(*) as `count` FROM `jet_product` WHERE `merchant_id`=".$merchantId." AND `updated_at` between '".$dateTimeFrom."' AND '".$dateTimeTo."'";
                $result = Data::sqlRecords($query, 'one');
                return isset($result['count'])?$result['count']:0; 
        }

    }

    public function getTempProductsCount($merchantId, $detail = false){
        if(is_numeric($merchantId) && !$detail) {
                $result = [];
                $query = "SELECT COUNT(*) as `count` FROM `jet_product_tmp` WHERE `merchant_id`=".$merchantId;
                $result = Data::sqlRecords($query, 'one');
                return isset($result['count'])?$result['count']:0; 
        }elseif(is_numeric($merchantId)){
                $result = [];
                $tmpProductIds = [];
                $query = "SELECT  `product_id` FROM `jet_product_tmp` WHERE `merchant_id`=".$merchantId;
                $result = Data::sqlRecords($query, 'all');
                if(is_array($result) && count($result)>0){
                    $tmpProductIds = array_column($result, 'product_id');
                }
                return is_array($tmpProductIds)?$tmpProductIds:[];
        }

    }

    
}
?>
