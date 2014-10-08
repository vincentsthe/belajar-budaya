<?php

namespace app\assets;

use yii\web\AssetBundle;

class AngularAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
        'js/game/main.js',
        'js/game/angular.min.js',
        'js/game/angular-route.min.js',
        'js/game/angular-animate.min.js',
        'js/game/app.js',
    ];
    public $depends = [
    ];
}
