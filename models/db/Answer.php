<?php

namespace app\models\db;

use Yii;

/**
 * This is the model class for table "answer".
 *
 * @property integer $id
 * @property string $answer
 * @property integer $user_id
 * @property integer $question_id
 * @property integer $room_id
 * @property string $created_at
 * @property integer $result
 *
 * @property User $user
 * @property Room $room
 * @property Question $question
 */
class Answer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'answer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['answer', 'user_id', 'question_id', 'room_id', 'result'], 'required'],
            [['user_id', 'question_id', 'room_id', 'result'], 'integer'],
            [['created_at'], 'safe'],
            [['answer'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'answer' => 'Answer',
            'user_id' => 'User ID',
            'question_id' => 'Question ID',
            'room_id' => 'Room ID',
            'created_at' => 'Created At',
            'result' => 'Result',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoom()
    {
        return $this->hasOne(Room::className(), ['id' => 'room_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestion()
    {
        return $this->hasOne(Question::className(), ['id' => 'question_id']);
    }
}
