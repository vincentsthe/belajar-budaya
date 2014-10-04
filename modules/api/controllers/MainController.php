<?php

namespace app\modules\controllers;
use app\models\db\User;
use app\models\db\UserScore;
use yii\web\Controller;

class DefaultController extends Controller
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

    public function actionRank()
    {
    	return User::find()->orderBy(['score' => SORT_ASC])->limit(10)->all();
    }
}
