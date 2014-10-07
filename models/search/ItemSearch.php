<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\db\Item;

/**
 * ItemSearch represents the model behind the search form about `app\models\db\Item`.
 */
class ItemSearch extends Item
{
    public $keyword;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['keyword'], 'string'],
            //[['keyword'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Item::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'name', $this->keyword]);

        return $dataProvider;
    }
}
