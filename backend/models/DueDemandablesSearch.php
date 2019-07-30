<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\DueDemandables;

/**
 * DueDemandablesSearch represents the model behind the search form of `backend\models\DueDemandables`.
 */
class DueDemandablesSearch extends DueDemandables
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'project_id'], 'integer'],
            [['date_entry', 'operating_unit', 'burs_no', 'burs_date', 'reference', 'reference_date'], 'safe'],
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
        $query = DueDemandables::find();

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
            'burs_date' => $this->burs_date,
            'reference_date' => $this->reference_date,
            'amount' => $this->amount,
        ]);

        $query->andFilterWhere(['like', 'operating_unit', $this->operating_unit])
            ->andFilterWhere(['like', 'burs_no', $this->burs_no])
            ->andFilterWhere(['like', 'reference', $this->reference]);

        return $dataProvider;
    }
}
