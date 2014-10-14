<?php

namespace app\models\db;

use Yii;

/**
 * This is the model class for table "item".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $image_url
 * @property integer $item_category_id
 *
 * @property ItemCategory $itemCategory
 * @property Question[] $questions
 * @property Room[] $rooms
 * @property RoomHasItem[] $roomHasItems
 */
class Item extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description', 'image_url', 'item_category_id'], 'required'],
            [['description'], 'string'],
            [['item_category_id'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['image_url'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Deskripsi',
            'image_url' => 'Gambar',
            'item_category_id' => 'Category',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemCategory()
    {
        return $this->hasOne(ItemCategory::className(), ['id' => 'item_category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestions()
    {
        return $this->hasMany(Question::className(), ['item_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRooms()
    {
        return $this->hasMany(Room::className(), ['id' => 'room_id'])->viaTable('{room_has_item}', ['item_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoomHasItems()
    {
        return $this->hasMany(RoomHasItem::className(), ['item_id' => 'id']);
    }
}
