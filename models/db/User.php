<?php

namespace app\models\db;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $fb_access_token
 * @property string $email
 *
 * @property Answer[] $answers
 * @property RoomHasUser[] $roomHasUsers
 * @property Room[] $rooms
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fb_access_token', 'email'], 'required'],
            [['fb_access_token'], 'string', 'max' => 200],
            [['email'], 'string', 'max' => 100],
            [['email'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fb_access_token' => 'Fb Access Token',
            'email' => 'Email',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnswers()
    {
        return $this->hasMany(Answer::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoomHasUsers()
    {
        return $this->hasMany(RoomHasUser::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRooms()
    {
        return $this->hasMany(Room::className(), ['id' => 'room_id'])->viaTable('{room_has_user}', ['user_id' => 'id']);
    }
}
