<?php

namespace app\modules\controllers;

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
        Yii::$app->response->type = 'json';
       	$user = User::find()->where(['id' => $id])->one();
       	return $user->asArray();
    }

    /**
     * set user information
     */
    public function actionSet()
    {
    	
    }

}
