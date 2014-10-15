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
        $roomQuestions = $this->getRoomQuestions()->where(['status' => '1'])->all();
        $questions = [];
        foreach($roomQuestions as $roomquestion){
            array_push($questions,Question::findOne($roomquestion->question_id));
        }
        return $questions;
    }

    /**
     * create random 3 active questions
     */
    public function createQuestions(){
        $itemCount = Item::find()->count();
        $item = Item::find()->offset(rand(0,$itemCount-1))->one();
        $questions = $item->getQuestions()->select(['id'])->limit(3)->all();
        foreach($questions as $question){
            $roomQuestion = new RoomQuestion;
            $roomQuestion->room_id = $this->id; $roomQuestion->question_id = $question->id; $roomQuestion->status = 1;
            $roomQuestion->save();
        }
    }

    /**
     * remove question metadata with status = 1 from database
     */
    public function clearIdleQuestions(){
        $questions = $this->getRoomQuestions()->all();
        foreach($questions as $question){
            $question->delete();
        }
    }
}
