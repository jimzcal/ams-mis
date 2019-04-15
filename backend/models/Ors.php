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
 * @property string $general_appropriation
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
            [['date', 'region', 'general_appropriation', 'ors_no', 'particulars', 'mfo_pap', 'rc', 'object_code', 'obligation'], 'required'],
            [['date'], 'safe'],
            [['particulars'], 'string'],
            [['obligation'], 'number'],
            [['region', 'sub_office', 'general_appropriation', 'ors_no', 'ors_class', 'funding_source', 'ors_year', 'ors_month', 'ors_serial', 'mfo_pap', 'rc', 'object_code'], 'string', 'max' => 100],
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
            'general_appropriation' => 'General Appropriation',
            'ors_no' => 'Ors No',
            'particulars' => 'Particulars',
            'ors_class' => 'ORS Class',
            'funding_source' => 'Funding Source',
            'ors_year' => 'ORS Year',
            'ors_month' => 'ORS Month',
            'ors_serial' => 'ORS Serial',
            'mfo_pap' => 'MFO/PAP',
            'rc' => 'RC',
            'object_code' => 'Object Code',
            'obligation' => 'Obligation Amount',
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
