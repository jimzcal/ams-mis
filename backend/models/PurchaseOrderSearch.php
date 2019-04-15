<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\PurchaseOrder;

/**
 * PurchaseOrderSearch represents the model behind the search form of `backend\models\PurchaseOrder`.
 */
class PurchaseOrderSearch extends PurchaseOrder
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'payment_term'], 'integer'],
            [['date', 'po_no', 'supplier', 'tin', 'mode_procurement', 'description', 'date_recived', 'fund_cluster', 'status', 'attachments'], 'safe'],
            [['total_amount'], 'number'],
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
        $query = PurchaseOrder::find();

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
            'payment_term' => $this->payment_term,
            'total_amount' => $this->total_amount,
            'date_recived' => $this->date_recived,
        ]);

        $query->andFilterWhere(['like', 'po_no', $this->po_no])
            ->andFilterWhere(['like', 'supplier', $this->supplier])
            ->andFilterWhere(['like', 'tin', $this->tin])
            ->andFilterWhere(['like', 'attachments', $this->attachments])
            ->andFilterWhere(['like', 'mode_procurement', $this->mode_procurement])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'fund_cluster', $this->fund_cluster])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
