<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ExchDirection;

/**
 * ExchDirectionSearch represents the model behind the search form of `backend\models\ExchDirection`.
 */
class ExchDirectionSearch extends ExchDirection
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'rate_to'], 'integer'],
            [['give_currency', 'receive_currency', 'status'], 'safe'],
            [['rate_from'], 'number'],
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
        $query = ExchDirection::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'rate_from' => $this->rate_from,
            'rate_to' => $this->rate_to,
        ]);

        $query->andFilterWhere(['like', 'give_currency', $this->give_currency])
            ->andFilterWhere(['like', 'receive_currency', $this->receive_currency])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
