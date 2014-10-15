<?php

namespace app\models\db;

use Yii;

/**
 * This is the model class for table "room_has_item".
 *
 * @property integer $room_id
 * @property integer $item_id
 * @property integer $question_number
 * @property integer $status
 *
 * @property Item $item
 * @property Room $room
 */
class RoomHasItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'room_has_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['room_id', 'item_id', 'question_number'], 'required'],
            [['room_id', 'item_id', 'question_number', 'status'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'room_id' => 'Room ID',
            'item_id' => 'Item ID',
            'question_number' => 'Question Number',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Item::className(), ['id' => 'item_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoom()
    {
        return $this->hasOne(Room::className(), ['id' => 'room_id']);
    }
}
