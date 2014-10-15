<?php

namespace app\assets;

use yii\web\AssetBundle;

class HomeAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
        'js/game/controller/HomeController.js',
        'js/game/service/FBService.js',
        'js/game/service/UrlFactory.js',
        'js/game/service/ApiService.js'
    ];
    public $depends = [
        //'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
        'app\assets\AngularAsset',
    ];
}
