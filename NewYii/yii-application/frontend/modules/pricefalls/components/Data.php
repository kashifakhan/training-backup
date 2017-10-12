<?php

namespace frontend\modules\pricefalls\components;
use yii\base\Component;
use yii\helpers\Url;

/**
 * Created by PhpStorm.
 * User: cedcoss
 * Date: 10/10/17
 * Time: 1:18 PM
 */
class Data extends Component
{
  const UNDER_JET_REVIEW="Product Under Review";
  const NOT_UPLOADED="Not Uploaded";
  const UNAUTHORISED="UnAuthorised";
  const EXCLUDED="Excluded ";
  const ARCHIVED="Archived";
  const  PURCHASED="Purchased";
  const NOT_PURCHASE="Not Purchased";
  const LICENSE_EXPIRED="License Expired";
  const TRIAL_EXPIRED="Trial Expired";
  const MARKETPLACE="Market Place";
  const CALL_SCHEDULE_STATUS="pending";
  const NUMBER_OF_REQUEST=1;
  const PRICEFALLS_APP_NAME="pridefalls";


    /**
     * @param $query
     * @param null $type
     * @param null $queryType
     * @return array|false|int
     */
  public static function sqlRecord($query,$type=null,$queryType=null)
  {
      $connection=\Yii::$app->getDb();
//
      if($queryType=='update' || $queryType=='delete' || $queryType=='insert' || $queryType==null)
      {
         $response =$connection->createCommand($query)->execute();
      }
      elseif ($queryType=='column')
      {
          $response=$connection->createCommand($query)->queryColumn();
      }
      elseif($type=='one')
      {

          $response=$connection->createCommand($query)->queryOne();
      }
      else {
          $response=$connection->createCommand($query)->queryAll();
      }
      unset($connection);
      return $response;
  }

    /**
     * @param $data
     * @param null $precision
     * @return string
         */
      public static function custom_number_format($data,$precision=null)
      {
          if ($data < 1000) {
              // Anything less than a billion
              $n_format = number_format($data);
          }
          else if ($data < 1000000) {
              // Anything less than a million
              $n_format = number_format($data / 1000, $precision) . 'K';
          } else if ($data < 1000000000) {
              // Anything less than a billion
              $n_format = number_format($data / 1000000, $precision) . 'M';
          } else {
              // At least a billion
              $n_format = number_format($data / 1000000000, $precision) . 'B';
          }

          return $n_format;

      }


    /**
     * @param $path
     * @return string
     */
      public static function getUrl($path)
      {
          $url = Url::toRoute([$path]);
          return $url;
      }


    /**
     * @return bool
     */
      public static function getPricefallsScheduleMessage()
      {
        return true;
      }

//  public static function checkInstalledApp($merchant_id,$data)
//  {
//      $Install_info=$jetdata=[];
//      $
//  }


    /**
     * @param $sc
     * @return mixed
     */
    public static function getShopifyShopDetails($sc)
    {
        $response = $sc->call('GET','/admin/shop.json');
        return $response;
    }


}