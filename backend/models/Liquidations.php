<?php

namespace backend\models;

use Yii;
use backend\models\Projects;

/**
 * This is the model class for table "liquidations".
 *
 * @property int $id
 * @property string $date_entry
 * @property int $project_id
 * @property string $ors_no
 * @property string $ors_date
 * @property string $ors_class
 * @property string $funding_source
 * @property int $ors_year
 * @property string $ors_month
 * @property string $ors_serial
 * @property string $dv_no
 * @property string $dv_date
 * @property string $reference
 * @property string $amount
 * @property string $status
 */
class Liquidations extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'liquidations';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date_entry', 'ors_date', 'dv_date', 'liquidation_date'], 'safe'],
            [['project_id', 'ors_no', 'ors_date', 'ors_class', 'funding_source', 'ors_year', 'ors_month', 'ors_serial', 'dv_no', 'dv_date', 'reference', 'amount', 'status', 'liquidation_date', 'operating_unit'], 'required'],
            [['project_id', 'ors_year'], 'integer'],
            [['amount'], 'number'],
            [['ors_no', 'ors_class', 'funding_source', 'ors_month', 'ors_serial', 'dv_no', 'status', 'operating_unit'], 'string', 'max' => 100],
            [['reference'], 'string', 'max' => 300],
        ];
    }

    public function getProject($id)
    {
        $data = Projects::find()->where(['id' => $id])->one();

        return $data;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date_entry' => 'Date Entry',
            'project_id' => 'Project ID',
            'ors_no' => 'ORS No',
            'ors_date' => 'ORS Date',
            'ors_class' => 'ORS Class',
            'funding_source' => 'Funding Source',
            'ors_year' => 'ORS Year',
            'ors_month' => 'ORS Month',
            'ors_serial' => 'ORS Serial',
            'dv_no' => 'DV No',
            'dv_date' => 'DV Date',
            'reference' => 'Reference',
            'amount' => 'Amount',
            'status' => 'Status',
        ];
    }
}
