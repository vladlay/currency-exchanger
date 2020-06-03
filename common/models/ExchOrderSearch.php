<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ExchOrder;

/**
 * ExchOrderSearch represents the model behind the search form of `common\models\ExchOrder`.
 */
class ExchOrderSearch extends ExchOrder
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['date', 'description', 'from_account', 'to_account', 'person', 'status'], 'safe'],
            [['rate'], 'number'],
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
        $query = ExchOrder::find();

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
            'rate' => $this->rate,
        ]);

        $query->andFilterWhere(['like', 'date', $this->date])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'from_account', $this->from_account])
            ->andFilterWhere(['like', 'to_account', $this->to_account])
            ->andFilterWhere(['like', 'person', $this->person])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
