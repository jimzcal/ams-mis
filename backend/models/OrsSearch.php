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
            [['date', 'region', 'sub_office', 'general_appropriation', 'ors_no', 'particulars', 'ors_class', 'funding_source', 'ors_year', 'ors_month', 'ors_serial', 'mfo_pap', 'rc', 'object_code'], 'safe'],
            [['obligation'], 'number'],
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
        ]);

        $query->andFilterWhere(['like', 'region', $this->region])
            ->andFilterWhere(['like', 'sub_office', $this->sub_office])
            ->andFilterWhere(['like', 'general_appropriation', $this->general_appropriation])
            ->andFilterWhere(['like', 'ors_no', $this->ors_no])
            ->andFilterWhere(['like', 'particulars', $this->particulars])
            ->andFilterWhere(['like', 'ors_class', $this->ors_class])
            ->andFilterWhere(['like', 'funding_source', $this->funding_source])
            ->andFilterWhere(['like', 'ors_year', $this->ors_year])
            ->andFilterWhere(['like', 'ors_month', $this->ors_month])
            ->andFilterWhere(['like', 'ors_serial', $this->ors_serial])
            ->andFilterWhere(['like', 'mfo_pap', $this->mfo_pap])
            ->andFilterWhere(['like', 'rc', $this->rc])
            ->andFilterWhere(['like', 'object_code', $this->object_code]);

        $query->groupBy(['ors_no']);

        return $dataProvider;
    }
}