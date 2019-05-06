<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\RegistryBudgetutilization;

/**
 * RegistryBudgetutilizationSearch represents the model behind the search form of `backend\models\RegistryBudgetutilization`.
 */
class RegistryBudgetutilizationSearch extends RegistryBudgetutilization
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'project_id'], 'integer'],
            [['date_registry', 'burs_date', 'burs_no', 'burs_class', 'burs_year', 'burs_month', 'burs_serial', 'payee', 'operating_unit', 'fund_cluster', 'responsibility_center', 'particulars', 'mfo_pap', 'uacs', 'appropriation_type'], 'safe'],
            [['amount'], 'number'],
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
        $query = RegistryBudgetutilization::find();

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
            'date_registry' => $this->date_registry,
            'burs_date' => $this->burs_date,
            'amount' => $this->amount,
            'project_id' => $this->project_id,
        ]);

        $query->andFilterWhere(['like', 'burs_no', $this->burs_no])
            ->andFilterWhere(['like', 'burs_class', $this->burs_class])
            ->andFilterWhere(['like', 'burs_year', $this->burs_year])
            ->andFilterWhere(['like', 'burs_month', $this->burs_month])
            ->andFilterWhere(['like', 'burs_serial', $this->burs_serial])
            ->andFilterWhere(['like', 'appropriation_type', $this->appropriation_type])
            ->andFilterWhere(['like', 'payee', $this->payee])
            ->andFilterWhere(['like', 'operating_unit', $this->operating_unit])
            ->andFilterWhere(['like', 'fund_cluster', $this->fund_cluster])
            ->andFilterWhere(['like', 'responsibility_center', $this->responsibility_center])
            ->andFilterWhere(['like', 'particulars', $this->particulars])
            ->andFilterWhere(['like', 'mfo_pap', $this->mfo_pap])
            ->andFilterWhere(['like', 'uacs', $this->uacs]);

        $query->groupBy(['burs_no']);

        return $dataProvider;
    }
}
