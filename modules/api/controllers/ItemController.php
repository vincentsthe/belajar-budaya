<?php

namespace app\modules\api\controllers;

use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\db\Item;

class ItemController extends Controller
{
	public function behaviors(){
		return [
			'verbs' => [
				'class' => VerbFilter::className(),
                	'actions' => [
                    	'delete' => ['post'],
                    	'create' => ['post'],
                    	'view' => ['get'],
                ],
            ],
		];
	}

	public function actionCreate(){
		$model = new Item;
		if ($model->load(Yii::$app->request->post()) && $model->save()){
			
		}
	}

}
