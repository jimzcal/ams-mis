<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Disbursement;

/**
 * DisbursementSearch represents the model behind the search form of `frontend\models\Disbursement`.
 */
class DisbursementSearch extends Disbursement
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'transaction_id'], 'integer'],
            [['dv_no', 'date', 'payee', 'mode_of_payment', 'nca', 'fund_cluster', 'tin', 'attachments', 'cash_advance', 'remarks', 'status', 'obligated'], 'safe'],
            [['gross_amount', 'less_amount', 'net_amount'], 'number'],
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
        $query = Disbursement::find();

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
            'gross_amount' => $this->gross_amount,
            'less_amount' => $this->less_amount,
            'net_amount' => $this->net_amount,
            'transaction_id' => $this->transaction_id,
        ]);

        $query->andFilterWhere(['like', 'dv_no', $this->dv_no])
            ->andFilterWhere(['like', 'date', $this->date])
            ->andFilterWhere(['like', 'payee', $this->payee])
            ->andFilterWhere(['like', 'mode_of_payment', $this->mode_of_payment])
            ->andFilterWhere(['like', 'nca', $this->nca])
            ->andFilterWhere(['like', 'fund_cluster', $this->fund_cluster])
            ->andFilterWhere(['like', 'tin', $this->tin])
            ->andFilterWhere(['like', 'attachments', $this->attachments])
            ->andFilterWhere(['like', 'cash_advance', $this->cash_advance])
            ->andFilterWhere(['like', 'remarks', $this->remarks])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'obligated', $this->obligated]);

        return $dataProvider;
    }
}
