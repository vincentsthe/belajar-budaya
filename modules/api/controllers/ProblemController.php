<?php

namespace app\modules\api\controllers;
use yii\filters\VerbFilter;
use app\models\db\User;
use app\models\db\Answer;
use app\models\db\Question;
use Yii;

class UserController extends \yii\web\Controller
{
	public function behaviors(){

	}
	
	/**
	 * get answer from a room
	 * @param int $room_id
	 */
    public function actionGetAnswer($room_id)
    {
        $lastId = Yii::$app->request->post('lastId');
       	$answer = Answer::find()
            ->andWhere(['room_id' => $room_id])
            ->andWhere(['>','id',$lastId])
            ->all();
        return $answer;
    }

    /**
     *
     */
    public function actionSendAnswer($room_id){
        $answer = new Answer;
        $room = Room::findOne($room_id)->one();
        $question = Question::findOne(Yii::$app->request->post('question_id')->one();

        $answer->user_id = Yii::$app->user->identity->id;
        $answer->answer = Yii::$app->request->post('answer');
        $answer->question_id = $room->active_item_id;
        $answer->room_id = $room_id;
        $answer->result = ($question->value == $answer->answer);
    }


    	
}
