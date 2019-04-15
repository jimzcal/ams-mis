<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ImplementingAgency;

/**
 * ImplementingAgencySearch represents the model behind the search form of `backend\models\ImplementingAgency`.
 */
class ImplementingAgencySearch extends ImplementingAgency
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['national_agency', 'uacs', 'implementing_agency'], 'safe'],
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
        $query = ImplementingAgency::find();

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

        $query->andFilterWhere(['like', 'national_agency', $this->national_agency])
            ->andFilterWhere(['like', 'uacs', $this->uacs])
            ->andFilterWhere(['like', 'implementing_agency', $this->implementing_agency]);

        return $dataProvider;
    }
}
