<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "journal_entry".
 *
 * @property int $id
 * @property string $date
 * @property string $operating_unit
 * @property int $year
 * @property int $project_id
 * @property string $fund_cluster
 * @property string $ors_no
 * @property string $ors_class
 * @property string $ors_fundingsource
 * @property string $ors_year
 * @property string $ors_month
 * @property string $ors_series
 * @property int $quarter
 * @property string $obligation
 * @property string $disbursement
 * @property string $liquidation
 * @property string $appropriation_type
 */
class JournalEntry extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'journal_entry';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date', 'ors_date'], 'safe'],
            [['operating_unit', 'year', 'project_id', 'fund_cluster', 'ors_no', 'ors_class', 'ors_fundingsource', 'ors_year', 'ors_month', 'ors_series', 'quarter', 'obligation', 'disbursement', 'liquidation', 'appropriation_type', 'ors_date'], 'required'],
            [['year', 'project_id', 'quarter'], 'integer'],
            [['obligation', 'disbursement', 'liquidation'], 'number'],
            [['operating_unit', 'fund_cluster', 'ors_no', 'ors_class', 'ors_fundingsource', 'ors_year', 'ors_month', 'ors_series', 'appropriation_type'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Date',
            'operating_unit' => 'Operating Unit',
            'year' => 'Year',
            'project_id' => 'Project ID',
            'fund_cluster' => 'Fund Cluster',
            'ors_no' => 'Ors No',
            'ors_class' => 'Ors Class',
            'ors_fundingsource' => 'Ors Fundingsource',
            'ors_year' => 'Ors Year',
            'ors_month' => 'Ors Month',
            'ors_series' => 'Ors Series',
            'quarter' => 'Quarter',
            'obligation' => 'Obligation',
            'disbursement' => 'Disbursement',
            'liquidation' => 'Liquidation',
            'appropriation_type' => 'Appropriation Type',
        ];
    }
}
