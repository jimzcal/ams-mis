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
 * @property string $dv_no
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
            [['date', 'region', 'sub_office', 'appropriation_class', 'ors_no', 'particulars', 'ors_class', 'funding_source', 'ors_year', 'ors_month', 'ors_serial', 'mfo_pap', 'rc', 'object_code', 'obligation', 'dv_no'], 'required'],
            [['date'], 'safe'],
            [['particulars'], 'string'],
            [['obligation'], 'number'],
            [['region', 'sub_office', 'appropriation_class', 'ors_no', 'ors_serial', 'mfo_pap', 'rc', 'object_code', 'dv_no'], 'string', 'max' => 100],
            [['funding_source'], 'string', 'max' => 8],
            [['ors_year'], 'string', 'max' => 4],
            [['ors_class', 'ors_month'], 'string', 'max' => 2],
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
            'sub_office' => 'Sub-Office',
            'appropriation_class' => 'Appropriation',
            'ors_no' => 'ORS No',
            'particulars' => 'Particulars',
            'ors_class' => 'Class',
            'funding_source' => 'Funding Source',
            'ors_year' => 'Year',
            'ors_month' => 'Month',
            'ors_serial' => 'Serial',
            'mfo_pap' => 'MFO-PAP',
            'rc' => 'Responsibility Center',
            'object_code' => 'Object Code',
            'obligation' => 'Obligation',
            'dv_no' => 'Dv No',
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
}
