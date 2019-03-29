<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Ors;

/**
 * OrsSearch represents the model behind the search form of `backend\models\Ors`.
 */
class OrsSearch extends Ors
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['date', 'region', 'sub_office', 'appropriation_class', 'ors_no', 'particulars', 'ors_class', 'funding_source', 'ors_year', 'ors_month', 'ors_serial', 'mfo_pap', 'rc', 'object_code', 'date_obligated', 'dv_date', 'dv_no', 'fund_cluster', 'liquidation_date', 'liquidation_status'], 'safe'],
            [['obligation', 'obligated_amount', 'dv_amount', 'liquidation_amount'], 'number'],
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
        $query = Ors::find();

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
            'date' => $this->date,
            'obligation' => $this->obligation,
            'date_obligated' => $this->date_obligated,
            'obligated_amount' => $this->obligated_amount,
            'dv_date' => $this->dv_date,
            'dv_amount' => $this->dv_amount,
            'liquidation_date' => $this->liquidation_date,
            'liquidation_amount' => $this->liquidation_amount,
        ]);

        $query->andFilterWhere(['like', 'region', $this->region])
            ->andFilterWhere(['like', 'sub_office', $this->sub_office])
            ->andFilterWhere(['like', 'appropriation_class', $this->appropriation_class])
            ->andFilterWhere(['like', 'ors_no', $this->ors_no])
            ->andFilterWhere(['like', 'particulars', $this->particulars])
            ->andFilterWhere(['like', 'ors_class', $this->ors_class])
            ->andFilterWhere(['like', 'funding_source', $this->funding_source])
            ->andFilterWhere(['like', 'ors_year', $this->ors_year])
            ->andFilterWhere(['like', 'ors_month', $this->ors_month])
            ->andFilterWhere(['like', 'ors_serial', $this->ors_serial])
            ->andFilterWhere(['like', 'mfo_pap', $this->mfo_pap])
            ->andFilterWhere(['like', 'rc', $this->rc])
            ->andFilterWhere(['like', 'object_code', $this->object_code])
            ->andFilterWhere(['like', 'dv_no', $this->dv_no])
            ->andFilterWhere(['like', 'fund_cluster', $this->fund_cluster])
            ->andFilterWhere(['like', 'liquidation_status', $this->liquidation_status]);

        $query->groupBy(['ors_no']);

        return $dataProvider;
    }
}
