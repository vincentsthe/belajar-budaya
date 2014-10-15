<?php

namespace app\models\db;

use Yii;

/**
 * This is the model class for table "question".
 *
 * @property integer $item_id
 * @property integer $question_category_id
 * @property string $value
 * @property integer $id
 *
 * @property Item $item
 * @property QuestionCategory $questionCategory
 * @property RoomQuestion[] $roomQuestions
 * @property Room[] $rooms
 */
class Question extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'question';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_id', 'question_category_id', 'value'], 'required'],
            [['item_id', 'question_category_id'], 'integer'],
            [['value'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'item_id' => 'Item ID',
            'question_category_id' => 'Question Category ID',
            'value' => 'Value',
            'id' => 'ID',
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
    public function getQuestionCategory()
    {
        return $this->hasOne(QuestionCategory::className(), ['id' => 'question_category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoomQuestions()
    {
        return $this->hasMany(RoomQuestion::className(), ['question_id' => 'item_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRooms()
    {
        return $this->hasMany(Room::className(), ['id' => 'room_id'])->viaTable('{room_question}', ['question_id' => 'item_id']);
    }
}
