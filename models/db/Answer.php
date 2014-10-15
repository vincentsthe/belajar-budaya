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
    const VALUE_IF_CORRECT = +5;
    const VALUE_IF_CORRECT_BUT_ANSWERED = 0;
    const VALUE_IF_WRONG = -2;
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
            [['answer', 'user_id', 'room_id', 'result'], 'required'],
            [['user_id', 'room_id', 'result'], 'integer'],
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
     * match the answer and the question answer. update answered status in database
     * @param array $questions question object
     * @param int $room_id
     */
    public function match($questions,$room_id){
        $this->result = self::VALUE_IF_WRONG;
        foreach($questions as $question){
            if (strtolower($question->value) == strtolower($this->answer)){
                $roomQuestion = $question->getRoomQuestions()->where(['room_id' => $room_id])->one();
                $answered = $roomQuestion->answered;
                if (!$answered){
                    $this->result = max($this->result,self::VALUE_IF_CORRECT);
                    $roomQuestion->answered = 1; $roomQuestion->save();
                } else {
                    $this->result = max($this->result,self::VALUE_IF_CORRECT_BUT_ANSWERED);
                }
                
            }
        }
    }

}
