<?php

namespace console\components;
/**
 * Created by PhpStorm.
 * User: cedcoss
 * Date: 9/10/17
 * Time: 1:05 PM
 */

use Yii;
use yii\base\Component;

class TableExists extends Component
{

    public static function tableExists($table)
    {
        //echo Yii::$app->db->schema->getRawTableName($table);die;
        return (Yii::$app->db->schema->getTableSchema($table) !== null);
    }

    /* public static function dropTableIfExists($table)
     {
         //echo $this->tableExists($table);die;
         if (self::tableExists($table))
         {
             echo " table $table exists, drop it";
             return ;
             //dropTable($table);
         }
     }*/
}

