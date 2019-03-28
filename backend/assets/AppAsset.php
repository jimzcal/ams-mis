<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
       // 'css/sidebar.css',
        //'stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css',
        //'css/my-navbar-top.css',
        //'css/chosen.min.css',
    ];
    public $js = [
        //'https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js',
        //'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js',
        // 'js/modal.js',
        'js/capture.js',
        // "https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js",
        //'js/chosen.jquery.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'rmrevin\yii\fontawesome\AssetBundle',
    ];
}
?>
