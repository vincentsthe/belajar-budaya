<?php

namespace app\models\db;

use Yii;

/**
 * This is the model class for table "room_question".
 *
 * @property integer $room_id
 * @property integer $question_id
 * @property string $created_at
 * @property integer $status
 *
 * @property Room $room
 * @property Question $question
 */
class RoomQuestion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'room_question';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['room_id', 'question_id'], 'required'],
            [['room_id', 'question_id', 'status'], 'integer'],
            [['created_at'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'room_id' => 'Room ID',
            'question_id' => 'Question ID',
            'created_at' => 'Created At',
            'status' => 'Status',
        ];
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
        return $this->hasOne(Question::className(), ['item_id' => 'question_id']);
    }
}
