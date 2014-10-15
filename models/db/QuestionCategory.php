<?php

namespace app\models\db;

use Yii;

/**
 * This is the model class for table "question_category".
 *
 * @property integer $id
 * @property string $name
 * @property string $image_url
 *
 * @property Question[] $questions
 */
class QuestionCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'question_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'image_url'], 'required'],
            [['name', 'image_url'], 'string', 'max' => 100]
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
            'image_url' => 'Image Url',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestions()
    {
        return $this->hasMany(Question::className(), ['question_category_id' => 'id']);
    }
}
