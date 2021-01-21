<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Books;
use common\models\Authors;

/**
 * BooksSearch represents the model behind the search form of `common\models\Books`.
 */
class BooksSearch extends Books
{
    public $authorName;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_authors'], 'integer'],
            [['title', 'genre', 'authorName'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Books::find();
        $query->joinWith(['authors']);
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $dataProvider->sort->attributes['authorName'] = [
            'asc' => [Authors::tableName() . '.name' => SORT_ASC],
            'desc' => [Authors::tableName() . '.name' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'id_authors' => $this->id_authors,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'genre', $this->genre])
            ->andFilterWhere(['like', Authors::tableName() . '.name', $this->authorName]);

        return $dataProvider;
    }
}
