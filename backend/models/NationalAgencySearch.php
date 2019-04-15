<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\NationalAgency;

/**
 * NationalAgencySearch represents the model behind the search form of `backend\models\NationalAgency`.
 */
class NationalAgencySearch extends NationalAgency
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['department', 'agency', 'operating_unit', 'organization_code'], 'safe'],
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
        $query = NationalAgency::find();

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

        $query->andFilterWhere(['like', 'department', $this->department])
            ->andFilterWhere(['like', 'agency', $this->agency])
            ->andFilterWhere(['like', 'operating_unit', $this->operating_unit])
            ->andFilterWhere(['like', 'organization_code', $this->organization_code]);

        return $dataProvider;
    }
}
