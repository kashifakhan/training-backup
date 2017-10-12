<?php
namespace frontend\models;

use yii\base\Model;
use common\models\Product;


class AddProductsForm extends Model
{
    public $product_name;
    public $product_id;
    public $product_price;
    public $product_quantity;
    public $product_image;

    public function rules()
    {
        return [
            ['product_id', 'trim'],
            ['product_id', 'required'],
            ['product_id', 'unique', 'targetClass' => '\common\models\Product', 'message' => 'This product id  has already been taken.'],
            ['product_id', 'string', 'min' => 10, 'max' => 255],

            ['product_name', 'trim'],
            ['product_name', 'required'],
            ['product_name', 'string', 'min' => 2, 'max' => 255],



            ['product_price', 'trim'],
            ['product_price', 'required'],
            ['product_price', 'string', 'min' => 2, 'max' => 255],

            ['product_image', 'trim'],
            ['product_image', 'required'],
            ['product_image', 'string', 'min' => 2, 'max' => 255],

            ['product_quantity', 'trim'],
            ['product_quantity', 'required'],
            ['product_quantity', 'string', 'min' => 2, 'max' => 255]
        ];
    }

    public function addproduct()
    {
       // if (!$this->validate()) {
           // return null;
        //}

        $product = new Product();
       // print_r($product);die;
        $product->product_id = $this->product_id;
        $product->product_name = $this->product_name;
        $product->product_price = $this->product_price;
        $product->product_image = $this->product_image;
        $product->product_quantity= $this->product_quantity;

        return $product->save() ? $product : null;
    }

}