<?php

namespace app\models\db;

use Yii;

/**
 * This is the model class for table "room".
 *
 * @property integer $id
 * @property string $created_at
 * @property integer $active
 *
 * @property Answer[] $answers
 * @property RoomQuestion[] $roomQuestions
 * @property Question[] $questions
 * @property RoomUser[] $roomUsers
 * @property User[] $users
 */
class Room extends \yii\db\ActiveRecord
{

    const MAX_ANSWER_PER_ROOM = 30;
    const QUESTION_PER_ROOM = 3;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'room';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'active'], 'required'],
            [['id', 'active'], 'integer'],
            [['created_at'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => 'Created At',
            'active' => 'Active',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnswers()
    {
        return $this->hasMany(Answer::className(), ['room_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoomQuestions()
    {
        return $this->hasMany(RoomQuestion::className(), ['room_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestions()
    {
        return $this->hasMany(Question::className(), ['id' => 'question_id'])->viaTable('room_question', ['room_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoomUsers()
    {
        return $this->hasMany(RoomUser::className(), ['room_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['id' => 'user_id'])->viaTable('room_user', ['room_id' => 'id']);
    }

    /**
     * get current active questions
     */
    public function getActiveQuestions(){
        $roomQuestions = $this->getRoomQuestions()->all();
        $questions = [];
        foreach($roomQuestions as $roomquestion){
            array_push($questions,Question::find()
                ->with(['roomQuestions' => function($query){
                    $query->andWhere(['room_id' => $this->id])->limit(1);
                }])
                ->where(['id' => $roomquestion->question_id])->one());
        }
        return $questions;
    }

    /**
     * create random 3 active questions
     * @param int $item_id last item questioned
     */
    public function createQuestions($item_id = null){
        //select item with questions > 3
        $itemQuery = Item::find();
        if ($item_id !== null){
            $itemQuery->andWhere(['not', ['id' => $item_id]]);
        }
        $itemCount = $itemQuery->count();
        $item = $itemQuery->offset(rand(0,$itemCount-1))->one();
        $questions = $item->getQuestions()->select(['id'])->limit(3)->all();
        foreach($questions as $question){
            $roomQuestion = new RoomQuestion;
            $roomQuestion->room_id = $this->id; $roomQuestion->question_id = $question->id; $roomQuestion->answered = 0;
            $roomQuestion->save();
        }
    }


    /**
     * delete old questions and create new question if last timestamp > 10 minutes
     */
    public function deleteOldQuestions(){
        $roomQuestions = RoomQuestion::find()
            ->andWhere(['room_id'=>$this->id])
            ->andWhere("NOW() >  DATE_ADD(`created_at`,INTERVAL 10 SECOND)")
            ->all();
        foreach($roomQuestions as $question){
            $question->delete();
        }
    }

    /**
     * remove old answer
     */
    public function deleteOldAnswers(){
        $answers = $this->getAnswers()->orderBy(['id'=>SORT_DESC])->offset(20)->all();
        foreach($answers as $answer)
            $answer->delete();
    }

    public function refreshQuestions(){
        $question = $this->getQuestions()->one();
        if ($question == null){
            $this->createQuestions(null);
        } else {
            $this->deleteOldQuestions();
            //if outdated
            if ($this->getRoomQuestions()->one() == null){
                $this->createQuestions($question->item_id);
            }
        }
        
    }

}
