<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Far6Projects;

/**
 * Far6ProjectsSearch represents the model behind the search form of `backend\models\Far6Projects`.
 */
class Far6ProjectsSearch extends Far6Projects
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['date_entry', 'operating_unit', 'department', 'agency', 'operating_office', 'project_title', 'date_approved'], 'safe'],
            [['approved_budget'], 'number'],
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
        $query = Far6Projects::find();

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
            'date_approved' => $this->date_approved,
            'approved_budget' => $this->approved_budget,
        ]);

        $query->andFilterWhere(['like', 'operating_unit', $this->operating_unit])
            ->andFilterWhere(['like', 'department', $this->department])
            ->andFilterWhere(['like', 'agency', $this->agency])
            ->andFilterWhere(['like', 'operating_office', $this->operating_office])
            ->andFilterWhere(['like', 'project_title', $this->project_title]);

        return $dataProvider;
    }
}
