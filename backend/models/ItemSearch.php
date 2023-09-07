<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Item;

/**
 * ItemSearch represents the model behind the search form about `app\models\Item`.
 */
class ItemSearch extends Item
{
    /**
     * @inheritdoc
     */

    public $categoryTitle;
    public $statusTitle;



    public function rules()
    {
        return [
            [['id', 'price', 'category_id', 'status', 'in_stock', 'created_at', 'created_by'], 'integer'],
            [['title', 'details', 'tags','categoryTitle'], 'safe'],
                    [['categoryTitle','statusTitle'], 'string'],
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

     // Filter by status title
    if (!empty($this->status)) {
        if ($this->status === 'Active') {
            $query->andFilterWhere(['status' => 1]);
        } elseif ($this->status === 'Inactive') {
            $query->andFilterWhere(['status' => 0]);
        } elseif ($this->status === 'Unknown') {
            $query->andFilterWhere(['status' => 2]);
        } elseif ($this->status === 'Unspecified') {
            $query->andFilterWhere(['status' => 3]);
        }
    }

    if (!($this->load($params) && $this->validate())) {
        return $dataProvider;
    }

    $query->andFilterWhere([
        'id' => $this->id,
        'price' => $this->price,
        'status' => $this->status,
        'in_stock' => $this->in_stock,
        'created_at' => $this->created_at,
        'created_by' => $this->created_by,
    ]);

    $query->andFilterWhere(['like', 'title', $this->title])
        ->andFilterWhere(['like', 'details', $this->details])
        ->andFilterWhere(['like', 'tags', $this->tags]);

    // Filter by category title
    if (!empty($this->categoryTitle)) {
        $category = Category::findOne(['title' => $this->categoryTitle]);
        if ($category) {
            $query->andFilterWhere(['category_id' => $category->id]);
        } else {
            // If the category title doesn't exist, return an empty result
            $query->andWhere('1=0');
        }
    }

    return $dataProvider;
}

}
