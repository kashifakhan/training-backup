<?php
/**
 * Created by PhpStorm.
 * User: cedcoss
 * Date: 11/10/17
 * Time: 4:29 PM
 */

namespace common\models;


use yii\db\ActiveRecord;

class LatestUpdates extends ActiveRecord
{

    /**
     * @return string
     */
     public static function tableName()
     {
         return 'latest_updates';
     }


    /**
     * @return array
     */
     public function rules()
     {
         return
         [
           [['title','description'],'text'],
             [['marketplace'],'string'],
             [['created_at','updated_at'],'safe']
         ];
     }


    /**
     * @return array
     */
     public function attributeLabels()
     {
         return
         [
             'ID'=>'id',
             'Title'=>'title',
             'Description'=>'description',
             'Created At'=>'created_at',
             'Updated At'=>'updated_at'
         ];
     }
}