<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Disbursements;

/**
 * DisbursementsSearch represents the model behind the search form of `backend\models\Disbursements`.
 */
class DisbursementsSearch extends Disbursements
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'project_id', 'ors_year'], 'integer'],
            [['date_entry', 'ors_no', 'ors_date', 'ors_class', 'funding_source', 'ors_month', 'ors_serial', 'dv_no', 'dv_date'], 'safe'],
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
        $query = Disbursements::find();

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
            'ors_date' => $this->ors_date,
            'ors_year' => $this->ors_year,
            'dv_date' => $this->dv_date,
            'amount' => $this->amount,
        ]);

        $query->andFilterWhere(['like', 'ors_no', $this->ors_no])
            ->andFilterWhere(['like', 'ors_class', $this->ors_class])
            ->andFilterWhere(['like', 'funding_source', $this->funding_source])
            ->andFilterWhere(['like', 'ors_month', $this->ors_month])
            ->andFilterWhere(['like', 'ors_serial', $this->ors_serial])
            ->andFilterWhere(['like', 'dv_no', $this->dv_no]);

        return $dataProvider;
    }
}
