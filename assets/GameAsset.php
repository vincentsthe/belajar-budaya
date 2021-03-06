<?php

namespace app\assets;

use yii\web\AssetBundle;

class GameAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
        //'js/game/main.js',
        //'js/game/angular.min.js',
        //'js/game/angular-route.min.js',
        //'js/game/angular-animate.min.js',
       'js/game/main.js',
        'js/game/service/UrlFactory.js',
        'js/game/service/GameService.js',
        'js/game/controller/GameController.js',
        'js/game/service/FacebookService.js'
    ];
    public $depends = [
        //'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
        'app\assets\AngularAsset',
    ];
}
