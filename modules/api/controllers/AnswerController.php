<?php

namespace app\modules\api\controllers;

use yii\web\Controller;
use yii\filters\VerbFilter;

class AnswerController extends Controller
{
	public function behaviors(){
		return [
			'verbs' => [
				'class' => VerbFilter::className(),
                	'actions' => [
                    	'get' => ['get'],
                    	'set' => ['post']
                ],
            ],
		];
	}

}
