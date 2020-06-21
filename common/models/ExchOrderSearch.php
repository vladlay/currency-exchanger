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
            [['id', 'phone_number'], 'integer'],
            [['date', 'rate', 'from_currency', 'to_currency', 'from_amount', 'to_amount', 'from_account', 'to_account', 'person', 'email', 'status', 'update_date', 'ip_address'], 'safe'],
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
            // меняет порядок записей на обратный   
            'sort' => [
                'defaultOrder' => ['id' => SORT_DESC],
                'attributes' => [
                    'id',
                ],
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
                'id' => $this->id])
            ->andFilterWhere([
                'phone_number' => $this->phone_number,
        ]);

        $query->andFilterWhere(['like', 'date', $this->date])
            ->andFilterWhere(['like', 'rate', $this->rate])
            ->andFilterWhere(['like', 'from_currency', $this->from_currency])
            ->andFilterWhere(['like', 'to_currency', $this->to_currency])
            ->andFilterWhere(['like', 'from_amount', $this->from_amount])
            ->andFilterWhere(['like', 'to_amount', $this->to_amount])
            ->andFilterWhere(['like', 'from_account', $this->from_account])
            ->andFilterWhere(['like', 'to_account', $this->to_account])
            ->andFilterWhere(['like', 'person', $this->person])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'update_date', $this->update_date])
            ->andFilterWhere(['like', 'ip_address', $this->ip_address]);

        return $dataProvider;
    }
}
