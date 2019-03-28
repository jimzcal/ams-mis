<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\TransactionStatus;

/**
 * TransactionStatusSearch represents the model behind the search form of `backend\models\TransactionStatus`.
 */
class TransactionStatusSearch extends TransactionStatus
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['dv_no', 'receiving', 'processing', 'nca_control', 'verification', 'lddap_ada', 'releasing'], 'safe'],
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
        $query = TransactionStatus::find();

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
        ]);

        $query->andFilterWhere(['like', 'dv_no', $this->dv_no])
            ->andFilterWhere(['like', 'receiving', $this->receiving])
            ->andFilterWhere(['like', 'processing', $this->processing])
            ->andFilterWhere(['like', 'nca_control', $this->nca_control])
            ->andFilterWhere(['like', 'verification', $this->verification])
            ->andFilterWhere(['like', 'lddap_ada', $this->lddap_ada])
            ->andFilterWhere(['like', 'releasing', $this->releasing]);

        return $dataProvider;
    }
}
