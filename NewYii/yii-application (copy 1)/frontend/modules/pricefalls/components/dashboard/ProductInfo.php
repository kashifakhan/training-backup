<?php

namespace frontend\modules\pricefalls\components\dashboard;


use yii\base\Component;
use frontend\modules\pricefalls\components\Data;

/**
 * Created by PhpStorm.
 * User: cedcoss
 * Date: 10/10/17
 * Time: 11:48 AM
 */
class ProductInfo extends Component
{
    const PRICEFALLS_LIVE_PRODUCT_STATUS="Available for Purchase";
    const PRICEFALLS_UNDER_REVIEW_PRODUCT_STATUS="Under Pricefalls Review";
    const PRICEFALLS_ARCHIVED_PRODUCT_STATUS="Archived";
    const PRICEFALLS_EXCLUDED_PRODUCT_STATUS="Excluded";
    const PRICEFALLS_NOT_UPLOADED_PRODUCT_STATUS="Not Uploaded";
    const PRICEFALLS_MISSING_DATA_PRODUCT_STATUS="Missing Data Product";
    const PRICEFALLS_UNAUTHORISED_PRODUCT_STATUS="UnAuthorised";
    public static $_categoryNotMappedCount = 0;


    /*
* All products will be counted here
* parameter is only merchant_id
* parameter type is string
* return is the number of products count
* return type is integer
*/
         public function getAllProduct($merchant_id,&$type=null)
        {
            $totalProducts=0;
            $variants=Data::sqlRecord("SELECT count(*) as var_count FROM `merchant_db` WHERE merchant_id='".$merchant_id."'","one","select");
            if($variants['var_count'] && $variants>0)
            {
                $type="variants";
            }
            if(is_numeric($merchant_id))
            {
               $query="SELECT COUNT(*) as count FROM (SELECT `variant_id` as opt_id FROM `pricefalls_product_variants` WHERE merchant_id='".$merchant_id."' ) as `main` LIMIT 0,1";
               $result=Data::sqlRecord($query,'one','select');
                if(isset($result['count']) && $result) {

                    $totalProducts = $result['count'];
                }

            }

            return $totalProducts;
        }
    /*
   * products having status Live or Published will be counted here
   * parameter is only merchant_id
   * parameter type is string
   * return is the number of products count
   * return type is integer
   */
        public static function getLiveProduct($merchant_id)
        {
            $totalLiveProducts=0;
            if(is_numeric($merchant_id))
            {
                $query="SELECT COUNT(*) as count FROM (SELECT `variant_id` FROM `pricefalls_product_variants` WHERE merchant_id='".$merchant_id."' AND `status`='".self::PRICEFALLS_LIVE_PRODUCT_STATUS."') as `main` LIMIT 0,1";
                $result=Data::sqlRecord($query,'one','select');
                if(isset($result['count']) && $result['count'])
                {
                    $totalLiveProducts=$result['count'];
                }
            }
            return $totalLiveProducts;
        }

    /*
* products having status Uneder Pricefalls Review will be counted here
* parameter is only merchant_id
* parameter type is string
* return is the number of products count
* return type is integer
*/
        public static function getPricefallsUnderReviewProduct($merchant_id)
        {
            $underreviewproducts=0;
            $query="SELECT COUNT(*) as count FROM(SELECT `variant_id` FROM `pricefalls_product_variants` WHERE merchant_id='".$merchant_id."'AND `status`='" .self::PRICEFALLS_UNDER_REVIEW_PRODUCT_STATUS."') as `main` LIMIT 0,1";
            $result=Data::sqlRecord($query,'one','select');
             if(isset($result['count']) && $result)
             {
                 $underreviewproducts=$result['count'];
             }

             return $underreviewproducts;
        }

    /*
 * products having status Archived will be counted here
 * parameter is only merchant_id
 * parameter type is string
 * return is the number of products count
 * return type is integer
 */
        public static function getArchivedProduct($merchant_id)
        {
            $archivedproducts=0;
            $query="SELECT COUNT(*) as count FROM(SELECT `variant_id` FROM `pricefalls_product_variants` WHERE `merchant_id`='".$merchant_id."' AND `status`='".self::PRICEFALLS_ARCHIVED_PRODUCT_STATUS."') as `main` LIMIT 0,1";
             $result=Data::sqlRecord($query,'one','select');
            if(isset($result['count']) && $result)
            {
                $archivedproducts=$result['count'];
            }

            return $archivedproducts;

        }

    	/**
		 * products having status Excluded Product will be counted here
		 * @param is only merchant_id
		 * @param type is string
		 * return is the number of products count
		 * @return type is integre
		 */
        public static function getExcludedProduct($merchant_id)
        {
            $excludedproducts=0;
            $query="SELECT COUNT(*) as count FROM(SELECT `variant_id` FROM `pricefalls_product_variants` WHERE `merchant_id`='".$merchant_id."' AND `status`='".self::PRICEFALLS_EXCLUDED_PRODUCT_STATUS."') as `main` LIMIT 0,1";
            $result=Data::sqlRecord($query,'one','select');
            if(isset($result['count']) && $result)
            {
                $excludedproducts=$result['count'];
            }

            return $excludedproducts;
        }

    /*
 * products having status UnAuthorised will be counted here
 * parameter is only merchant_id
 * parameter type is string
 * return is the number of products count
 * return type is integer
 */
    public static function getUnAuthorisedProduct($merchant_id)
    {
        $unAuthorisedProducts=0;
        $query="SELECT COUNT(*) as count FROM(SELECT `variant_id` FROM `pricefalls_product_variants` WHERE `merchant_id`='".$merchant_id."' AND `status`='".self::PRICEFALLS_UNAUTHORISED_PRODUCT_STATUS."') as `main` LIMIT 0,1";
        $result=Data::sqlRecord($query,'one','select');
        if(isset($result['count']) && $result)
        {
            $unAuthorisedProducts=$result['count'];
        }

        return $unAuthorisedProducts;
    }

    /*
     * products having status not uploaded will be counted here
     * parameter is only merchant_id
     * parameter type is string
     * return is the number of products count
     * return type is integer
     */

    public static function getNotUploadedProduct($merchant_id)
    {
        $notUploadedProducts=0;
        $query="SELECT COUNT(*) as count FROM(SELECT `variant_id` FROM `pricefalls_product_variants` WHERE `merchant_id`='".$merchant_id."' AND `status`='".self::PRICEFALLS_NOT_UPLOADED_PRODUCT_STATUS."') as `main` LIMIT 0,1";
        $result=Data::sqlRecord($query,'one','select');
        if(isset($result['count']) && $result)
        {
            $notUploadedProducts=$result['count'];
        }

        return $notUploadedProducts;
    }


    /**
     * @param $merchant_id
     * @return int
     */
    public static function getMissingDataProduct($merchant_id)
    {
        $missingdataProducts=0;
        $query="SELECT COUNT(*) as count FROM(SELECT `variant_id` FROM `pricefalls_product_variants` WHERE `merchant_id`='".$merchant_id."' AND `status`='".self::PRICEFALLS_MISSING_DATA_PRODUCT_STATUS."') as `main` LIMIT 0,1";
        $result=Data::sqlRecord($query,'one','select');
        if(isset($result['count']) && $result)
        {
            $missingdataProducts=$result['count'];
        }

        return $missingdataProducts;
    }

    /*
  * product from shopify shop stored in product temp
  *  parameter is only merchant_id
  * parameter type is string
  * return is the number of products count
  * return type is integer
  */

//    public static function getProductTempCount($merchant_id)
//    {
//        $missingdataProducts=0;
//        $query="SELECT COUNT(*) as count FROM(SELECT `variant_id` FROM `pricefalls_product_variants` WHERE `merchant_id`='".$merchant_id."' AND `status`='".self::PRICEFALLS_MISSING_DATA_PRODUCT_STATUS."') as `main` LIMIT 0,1";
//        $result=Data::sqlRecord($query,'one','select');
//        if(isset($result['count']) && $result)
//        {
//            $missingdataProducts=$result['count'];
//        }
//
//        return $missingdataProducts;
//    }

}
