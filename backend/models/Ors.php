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
 * @property string $date_obligated
 * @property string $obligated_amount
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
            [['date', 'region', 'sub_office', 'appropriation_class', 'ors_no', 'particulars', 'ors_class', 'funding_source', 'ors_year', 'ors_month', 'ors_serial', 'mfo_pap', 'rc', 'object_code', 'obligation'], 'required'],
            [['date', 'date_obligated', 'dv_date', 'liquidation_date'], 'safe'],
            [['particulars'], 'string'],
            [['obligation', 'obligated_amount', 'dv_amount', 'liquidation_amount'], 'number'],
            [['region', 'sub_office', 'appropriation_class', 'ors_no', 'ors_serial', 'mfo_pap', 'rc', 'object_code', 'dv_no', 'fund_cluster', 'liquidation_status'], 'string', 'max' => 100],
            [['funding_source'], 'string', 'max' => 8],
            [['ors_year'], 'string', 'max' => 4],
            [['ors_class', 'ors_month'], 'string', 'max' => 2],
        ];
    }

    public function getOrs($ors_no, $region, $sub_office)
    {
        $data = Ors::find()->where(['ors_no' => $ors_no])
                    ->andWhere(['region' => $region])
                    ->andWhere(['sub_office' => $sub_office])
                    ->groupBy(['rc', 'mfo_pap', 'object_code'])
                    ->all();

        return $data;
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
            'appropriation_class' => 'Appropriation',
            'ors_no' => 'ORS No',
            'particulars' => 'Particulars',
            'ors_class' => 'ORS Class',
            'funding_source' => 'Funding Source',
            'ors_year' => 'ORS Year',
            'ors_month' => 'ORS Month',
            'ors_serial' => 'ORS Serial',
            'mfo_pap' => 'MFO/PAP',
            'rc' => 'Responsibility Center',
            'object_code' => 'Object Code',
            'obligation' => 'Obligation',
            'date_obligated' => 'Date Obligated',
            'obligated_amount' => 'Obligated Amount',
            'dv_date' => 'DV Date',
            'dv_no' => 'DV No',
            'fund_cluster' => 'Fund Cluster',
            'dv_amount' => 'DV Amount',
            'liquidation_date' => 'Liquidation Date',
            'liquidation_amount' => 'Liquidation Amount',
            'liquidation_status' => 'Liquidation Status',
        ];
    }
}
