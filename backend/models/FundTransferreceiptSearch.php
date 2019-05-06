<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\FundTransferreceipt;

/**
 * FundTransferreceiptSearch represents the model behind the search form of `backend\models\FundTransferreceipt`.
 */
class FundTransferreceiptSearch extends FundTransferreceipt
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'project_id'], 'integer'],
            [['date_entry', 'operating_unit', 'date_fundreceipt', 'reference', 'department', 'agency', 'operating_office', 'type'], 'safe'],
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
        $query = FundTransferreceipt::find();

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
            'date_fundreceipt' => $this->date_fundreceipt,
            'amount' => $this->amount,
        ]);

        $query->andFilterWhere(['like', 'operating_unit', $this->operating_unit])
            ->andFilterWhere(['like', 'reference', $this->reference])
            ->andFilterWhere(['like', 'department', $this->department])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'agency', $this->agency])
            ->andFilterWhere(['like', 'operating_office', $this->operating_office]);

        return $dataProvider;
    }
}
