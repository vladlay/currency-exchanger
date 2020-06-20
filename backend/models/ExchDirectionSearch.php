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
            [['id'], 'integer'],
            [['from_currency', 'to_currency', 'status'], 'safe'],
            [
                [
                    'rate_from', 
                    'rate_to', 
                    'min_amount_from', 
                    'min_amount_to', 
                    'max_amount_from',
                    'max_amount_to'
                ], 
                'number'
            ],
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

        $query->andFilterWhere(['like', 'from_currency', $this->from_currency])
            ->andFilterWhere(['like', 'to_currency', $this->to_currency])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
