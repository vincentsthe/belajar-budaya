<?php

namespace app\models\db;

use Yii;

/**
 * This is the model class for table "room".
 *
 * @property integer $id
 * @property string $created_at
 * @property integer $active
 * @property integer $active_item_id
 * @property string $last_item_updated_at
 *
 * @property Answer[] $answers
 * @property Item $activeItem
 * @property RoomHasItem[] $roomHasItems
 * @property Item[] $items
 * @property RoomHasUser[] $roomHasUsers
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
            [['id', 'active', 'active_item_id'], 'required'],
            [['id', 'active', 'active_item_id'], 'integer'],
            [['created_at', 'last_item_updated_at'], 'safe']
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
            'active_item_id' => 'Active Item ID',
            'last_item_updated_at' => 'Last Item Updated At',
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
    public function getActiveItem()
    {
        return $this->hasOne(Item::className(), ['id' => 'active_item_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoomHasItems()
    {
        return $this->hasMany(RoomHasItem::className(), ['room_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(Item::className(), ['id' => 'item_id'])->viaTable('{room_has_item}', ['room_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoomHasUsers()
    {
        return $this->hasMany(RoomHasUser::className(), ['room_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['id' => 'user_id'])->viaTable('{room_has_user}', ['room_id' => 'id']);
    }
}
