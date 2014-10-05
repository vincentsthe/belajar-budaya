<?php

namespace app\models\db;

use Yii;

/**
 * This is the model class for table "item_category".
 *
 * @property integer $id
 * @property integer $name
 *
 * @property Item[] $items
 */
class ItemCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'item_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'name'], 'required'],
            [['id', 'name'], 'integer']
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(Item::className(), ['item_category_id' => 'id']);
    }

    /**
     * This function return array of id=>categoryName
     * for dropdownlist purpose
     * 
     * @return \app\models\db\ItemCategory[]
     */
    public function getCategories() {
        $categories = ItemCategory::find()->all();

        $return = [];
        foreach($categories as $category) {
            $return[$category->id] = $category->name;
        }

        return $return;
    }
}
