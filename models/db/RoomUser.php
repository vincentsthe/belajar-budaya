<?php

namespace app\models\db;

use Yii;

/**
 * This is the model class for table "room_user".
 *
 * @property integer $room_id
 * @property integer $user_id
 * @property integer $online
 * @property string $last_updated_answer_at
 *
 * @property Room $room
 * @property User $user
 */
class RoomUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'room_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['room_id', 'user_id', 'online'], 'required'],
            [['room_id', 'user_id', 'online'], 'integer'],
            [['last_updated_answer_at'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'room_id' => 'Room ID',
            'user_id' => 'User ID',
            'online' => 'Online',
            'last_updated_answer_at' => 'Last Updated Answer At',
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
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
