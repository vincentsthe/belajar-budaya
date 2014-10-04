<?php

namespace app\modules\api;
use Yii;

class ApiModule extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\api\controllers';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }

    public function beforeAction($action){
    	if (parent::beforeAction($action)){
    		Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    		return true;
    	} else {
    		return false;
    	}
    }
}
