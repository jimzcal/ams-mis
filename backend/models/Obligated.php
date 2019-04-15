<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "obligated".
 *
 * @property int $id
 * @property string $date
 * @property string $region
 * @property string $sub_office
 * @property int $project_id
 * @property string $ors_no
 * @property string $general_appropriation
 * @property string $appropriation_type
 * @property string $ors_class
 * @property string $funding_source
 * @property string $ors_year
 * @property string $ors_month
 * @property string $ors_serial
 * @property string $mfo_pap
 * @property string $rc
 * @property string $object_code
 * @property string $amount
 */
class Obligated extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'obligated';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date', 'region', 'sub_office', 'project_id', 'ors_no', 'general_appropriation', 'appropriation_type', 'ors_class', 'funding_source', 'ors_year', 'ors_month', 'ors_serial', 'mfo_pap', 'rc', 'object_code', 'amount'], 'required'],
            [['date'], 'safe'],
            [['project_id'], 'integer'],
            [['amount'], 'number'],
            [['region', 'sub_office', 'ors_no', 'general_appropriation', 'appropriation_type', 'ors_class', 'funding_source', 'ors_year', 'ors_month', 'ors_serial', 'mfo_pap', 'rc', 'object_code'], 'string', 'max' => 100],
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
            'region' => 'Operating Unit',
            'sub_office' => 'Sub-Office',
            'project_id' => 'Project ID',
            'ors_no' => 'ORS No',
            'general_appropriation' => 'GAA',
            'appropriation_type' => 'Appropriation Type',
            'ors_class' => 'ORS Class',
            'funding_source' => 'Funding Source',
            'ors_year' => 'ORS Year',
            'ors_month' => 'ORS Month',
            'ors_serial' => 'ORS Serial',
            'mfo_pap' => 'MFO/PAP',
            'rc' => 'RC',
            'object_code' => 'Object Code',
            'amount' => 'Amount',
        ];
    }
}
