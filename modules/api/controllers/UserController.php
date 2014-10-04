<?php

namespace app\modules\api\controllers;
use yii\filters\VerbFilter;
use app\models\db\User;
use Yii;

class UserController extends \yii\web\Controller
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
	
	/**
	 * get user information
	 * @var int $id id of user
	 */
    public function actionGet($id)
    {
       	$user = User::find()->where(['id' => $id])->one();
       	return $user->getAttributes();
    }

}
