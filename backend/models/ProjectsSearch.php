<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Projects;

/**
 * ProjectsSearch represents the model behind the search form of `backend\models\Projects`.
 */
class ProjectsSearch extends Projects
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['date', 'operating_unit', 'project_title', 'department', 'agency', 'focal_person', 'status'], 'safe'],
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
        $query = Projects::find();

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
        ]);

        $query->andFilterWhere(['like', 'operating_unit', $this->operating_unit])
            ->andFilterWhere(['like', 'project_title', $this->project_title])
            ->andFilterWhere(['like', 'department', $this->department])
            ->andFilterWhere(['like', 'agency', $this->agency])
            ->andFilterWhere(['like', 'focal_person', $this->focal_person])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
