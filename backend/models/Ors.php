<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "ors".
 *
 * @property int $id
 * @property string $date
 * @property string $region
 * @property string $sub_office
 * @property string $appropriation_class
 * @property string $ors_no
 * @property string $particulars
 * @property string $ors_class
 * @property string $funding_source
 * @property string $ors_year
 * @property string $ors_month
 * @property string $ors_serial
 * @property string $mfo_pap
 * @property string $rc
 * @property string $object_code
 * @property string $obligation
 * @property string $dv_date
 * @property string $dv_no
 * @property string $fund_cluster
 * @property string $dv_amount
 * @property string $liquidation_date
 * @property string $liquidation_amount
 * @property string $liquidation_status
 */
class Ors extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ors';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date', 'region', 'sub_office', 'appropriation_class', 'ors_no', 'particulars', 'ors_class', 'funding_source', 'ors_year', 'ors_month', 'ors_serial', 'mfo_pap', 'rc', 'object_code', 'obligation', 'dv_date', 'dv_no', 'fund_cluster', 'dv_amount', 'liquidation_date', 'liquidation_amount', 'liquidation_status'], 'required'],
            [['date', 'dv_date', 'liquidation_date'], 'safe'],
            [['particulars'], 'string'],
            [['obligation', 'dv_amount', 'liquidation_amount'], 'number'],
            [['region', 'sub_office', 'appropriation_class', 'ors_no', 'ors_class', 'funding_source', 'ors_year', 'ors_month', 'ors_serial', 'mfo_pap', 'rc', 'object_code', 'dv_no', 'fund_cluster', 'liquidation_status'], 'string', 'max' => 100],
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
            'region' => 'Region',
            'sub_office' => 'Sub Office',
            'appropriation_class' => 'Appropriation Class',
            'ors_no' => 'Ors No',
            'particulars' => 'Particulars',
            'ors_class' => 'Ors Class',
            'funding_source' => 'Funding Source',
            'ors_year' => 'Ors Year',
            'ors_month' => 'Ors Month',
            'ors_serial' => 'Ors Serial',
            'mfo_pap' => 'Mfo Pap',
            'rc' => 'Rc',
            'object_code' => 'Object Code',
            'obligation' => 'Obligation',
            'dv_date' => 'Dv Date',
            'dv_no' => 'Dv No',
            'fund_cluster' => 'Fund Cluster',
            'dv_amount' => 'Dv Amount',
            'liquidation_date' => 'Liquidation Date',
            'liquidation_amount' => 'Liquidation Amount',
            'liquidation_status' => 'Liquidation Status',
        ];
    }
}
