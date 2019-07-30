<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\FundRemittance;

/**
 * FundRemittanceSearch represents the model behind the search form of `backend\models\FundRemittance`.
 */
class FundRemittanceSearch extends FundRemittance
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'project_id'], 'integer'],
            [['date_entry', 'operating_unit', 'btr_date', 'ncarequest_date', 'nca_date', 'nca_reference'], 'safe'],
            [['btr_amount', 'ncarequest_amount', 'nca_amount'], 'number'],
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
        $query = FundRemittance::find();

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
            'date_entry' => $this->date_entry,
            'project_id' => $this->project_id,
            'btr_date' => $this->btr_date,
            'btr_amount' => $this->btr_amount,
            'ncarequest_date' => $this->ncarequest_date,
            'ncarequest_amount' => $this->ncarequest_amount,
            'nca_date' => $this->nca_date,
            'nca_amount' => $this->nca_amount,
        ]);

        $query->andFilterWhere(['like', 'operating_unit', $this->operating_unit])
            ->andFilterWhere(['like', 'nca_reference', $this->nca_reference]);

        return $dataProvider;
    }
}
