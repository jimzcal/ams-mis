<?php

namespace backend\models;

use Yii;
use backend\models\Far6Projects;
/**
 * This is the model class for table "due_demandables".
 *
 * @property int $id
 * @property string $date_entry
 * @property int $project_id
 * @property string $operating_unit
 * @property string $burs_no
 * @property string $burs_date
 * @property string $reference
 * @property string $reference_date
 * @property string $amount
 */
class DueDemandables extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'due_demandables';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date_entry', 'burs_date', 'reference_date'], 'safe'],
            [['project_id', 'operating_unit', 'burs_no', 'burs_date', 'reference', 'reference_date', 'amount'], 'required'],
            [['project_id'], 'integer'],
            [['amount'], 'number'],
            [['operating_unit', 'burs_no', 'reference'], 'string', 'max' => 100],
        ];
    }

    public function getProjecttitle($project_id)
    {
        $data = Far6Projects::find()->where(['id' => $project_id])->one();

        return $data->project_title;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date_entry' => 'Date Entry',
            'project_id' => 'Project Title',
            'operating_unit' => 'Operating Unit',
            'burs_no' => 'BURS No',
            'burs_date' => 'BURS Date',
            'reference' => 'Reference',
            'reference_date' => 'Reference Date',
            'amount' => 'Amount',
        ];
    }
}
