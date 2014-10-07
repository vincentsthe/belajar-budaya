<?php

namespace app\assets;

use yii\web\AssetBundle;
//use Yii;

class CkeditorAsset extends AssetBundle
{

    public $sourcePath = '@vendor/ckeditor/ckeditor';
    public $css = [
    ];
    public $js = [
        "ckeditor.js",  
    ];
    public $depends = [
        //'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];
}
