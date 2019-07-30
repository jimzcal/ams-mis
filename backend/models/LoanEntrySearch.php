<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\LoanEntry;

/**
 * LoanEntrySearch represents the model behind the search form of `backend\models\LoanEntry`.
 */
class LoanEntrySearch extends LoanEntry
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'loan_period'], 'integer'],
            [['date_entry', 'date_loan', 'loan_account_code', 'full_name', 'status', 'loan_type'], 'safe'],
            [['principal_amount', 'monthly_interest'], 'number'],
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
        $query = LoanEntry::find();

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
            'date_loan' => $this->date_loan,
            'principal_amount' => $this->principal_amount,
            'monthly_interest' => $this->monthly_interest,
            'loan_period' => $this->loan_period,
        ]);

        $query->andFilterWhere(['like', 'loan_account_code', $this->loan_account_code])
            ->andFilterWhere(['like', 'full_name', $this->full_name])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'loan_type', $this->loan_type]);

        $query->orderBy(['full_name' => SORT_ASC]);

        return $dataProvider;
    }
}
