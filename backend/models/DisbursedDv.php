<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "disbursed_dv".
 *
 * @property int $id
 * @property string $date
 * @property string $dv_no
 * @property string $region
 * @property string $sub_office
 * @property int $project_id
 * @property string $ors_no
 * @property string $ors_class
 * @property string $funding_source
 * @property string $ors_year
 * @property string $ors_month
 * @property string $ors_serial
 * @property string $mfo_pap
 * @property string $rc
 * @property string $object_code
 * @property string $fund_cluster
 * @property string $amount
 */
class DisbursedDv extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'disbursed_dv';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date', 'dv_no', 'region', 'sub_office', 'project_id', 'ors_no', 'ors_class', 'funding_source', 'ors_year', 'ors_month', 'ors_serial', 'mfo_pap', 'rc', 'object_code', 'fund_cluster', 'amount'], 'required'],
            [['date'], 'safe'],
            [['project_id'], 'integer'],
            [['amount'], 'number'],
            [['dv_no', 'region', 'sub_office', 'ors_no', 'ors_class', 'funding_source', 'ors_year', 'ors_month', 'ors_serial', 'mfo_pap', 'rc', 'object_code', 'fund_cluster'], 'string', 'max' => 100],
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
            'dv_no' => 'Dv No',
            'region' => 'Region',
            'sub_office' => 'Sub Office',
            'project_id' => 'Project ID',
            'ors_no' => 'Ors No',
            'ors_class' => 'Ors Class',
            'funding_source' => 'Funding Source',
            'ors_year' => 'Ors Year',
            'ors_month' => 'Ors Month',
            'ors_serial' => 'Ors Serial',
            'mfo_pap' => 'Mfo Pap',
            'rc' => 'Rc',
            'object_code' => 'Object Code',
            'fund_cluster' => 'Fund Cluster',
            'amount' => 'Amount',
        ];
    }
}
