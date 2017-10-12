<?php

namespace frontend\modules\pricefalls\assets;
/**
 * Created by PhpStorm.
 * User: cedcoss
 * Date: 11/10/17
 * Time: 1:01 PM
 */

use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'frontend/modules/pricefalls/assets/css/jquery.datetimepicker.css',
        'frontend/modules/pricefalls/assets/css/site.css',
        'frontend/modules/pricefalls/assets/css/font-awesome.min.css',
        'frontend/modules/pricefalls/assets/css/jQuery-plugin-progressbar.css',
        'frontend/modules/pricefalls/assets/css/bootstrap-material-design.css',
        //'frontend/modules/pricefalls/assets/css/bootstrap.css',
        'frontend/modules/pricefalls/assets/css/pie-chart.css',
        'frontend/modules/pricefalls/assets/css/owl.carousel.css',
        //'css/slick.css',
        //'css/slick-theme.css',
        'frontend/modules/pricefalls/assets/css/style.css',
        'frontend/modules/pricefalls/assets/css/introjs.css',
        'frontend/modules/pricefalls/assets/css/intro-themes/introjs-nazanin.css',
        'frontend/modules/pricefalls/assets/css/litebox.css',
        'frontend/modules/pricefalls/assets/css/jquery-ui.css',
        'frontend/modules/pricefalls/assets/css/jquery-ui-timepicker-addon.css'
    ];
    public $js = [
        //'js/jquery.touchSwipe.min.js',
        //'js/jquery-1.10.2.min.js',
        //['js/jquery.js', ['position'=>1]],
        'frontend/modules/pricefalls/assets/js/bootstrap.min.js',
        'frontend/modules/pricefalls/assets/js/owl.carousel.js',
        'frontend/modules/pricefalls/assets/js/owl.carousel.min.js',
        //'js/jQuery-plugin-progressbar.js',
        'frontend/modules/pricefalls/assets/js/custom.js',
        //'js/slick.js',
        'frontend/modules/pricefalls/assets/js/intro.js',
        'frontend/modules/pricefalls/assets/js/pie-chart.js',
        //'js/images-loaded.min.js',
        //'js/litebox.min.js',
        'frontend/modules/pricefalls/assets/js/jquery-ui.js',
        //'frontend/modules/pricefalls/assets/js/jquery-ui-timepicker-addon.js'

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

}