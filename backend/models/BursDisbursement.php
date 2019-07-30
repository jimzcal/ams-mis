<?php

namespace backend\models;

use Yii;
use backend\models\Far6Projects;

/**
 * This is the model class for table "burs_disbursement".
 *
 * @property int $id
 * @property string $date_entry
 * @property string $burs_date
 * @property string $burs_no
 * @property string $dv_no
 * @property string $dv_date
 * @property int $project_id
 * @property string $amount
 */
class BursDisbursement extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'burs_disbursement';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date_entry', 'burs_date', 'dv_date'], 'safe'],
            [['burs_date', 'burs_no', 'dv_no', 'dv_date', 'project_id', 'amount'], 'required'],
            [['project_id'], 'integer'],
            [['amount'], 'number'],
            [['burs_no', 'dv_no', 'burs_class', 'burs_year', 'burs_month', 'burs_series'], 'string', 'max' => 100],
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
            'burs_date' => 'BURS Date',
            'burs_no' => 'BURS No.',
            'dv_no' => 'DV No.',
            'dv_date' => 'DV Date',
            'project_id' => 'Project',
            'amount' => 'Amount',
        ];
    }
}
