<?php
Yii::setAlias('@common', dirname(__DIR__));
Yii::setAlias('@frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('@backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('@console', dirname(dirname(__DIR__)) . '/console');


Yii::setAlias('@hostname','https://apps.cedcommerce.com/');
Yii::setAlias('@webpricefallsurl','http://kashifa.com/NewYii/yii-application/pricefalls');
Yii::setAlias('@weburl','http://kashifa.com/NewYii/yii-application/pricefalls');
Yii::setAlias('@webtophatters','http://kashifa.com/NewYii/yii-application/tophatters');
Yii::setAlias('@webbaseurl','http://kashifa.com/NewYii/yii-application');
Yii::setAlias('@assetroot',__DIR__.'/../../frontend');

//sears app path
Yii::setAlias('@rootdir', dirname(dirname(__DIR__)));
Yii::setAlias('@pricefallsbasepath','http://kashifa.com/NewYii/yii-application/frontend/modules/pricefalls');



define("SCOPE","write_shipping,read_products,write_products,read_orders,write_orders,write_fulfillments,read_fulfillments,read_customers,write_customers");

define("API_HOST","https://merchant-api.jet.com/api");