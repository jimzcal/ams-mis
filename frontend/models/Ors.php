<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "ors".
 *
 * @property int $id
 * @property string $dv_no
 * @property string $particular
 * @property string $ors_class
 * @property string $ors_year
 * @property string $ors_month
 * @property string $ors_serial
 * @property string $mfo_pap
 * @property string $responsibility_center
 * @property string $amount
 * @property string $status
 *
 * @property Disbursement $dvNo
 */
class Ors extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ors';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dv_no', 'particular', 'ors_class', 'ors_year', 'ors_month', 'ors_serial', 'mfo_pap', 'responsibility_center', 'amount', 'status'], 'required'],
            [['amount'], 'number'],
            [['dv_no', 'ors_year', 'ors_month', 'ors_serial', 'mfo_pap', 'responsibility_center'], 'string', 'max' => 100],
            [['particular'], 'string', 'max' => 200],
            [['ors_class', 'status'], 'string', 'max' => 50],
            [['dv_no'], 'exist', 'skipOnError' => true, 'targetClass' => Disbursement::className(), 'targetAttribute' => ['dv_no' => 'dv_no']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'dv_no' => 'Dv No',
            'particular' => 'Particular',
            'ors_class' => 'Ors Class',
            'ors_year' => 'Ors Year',
            'ors_month' => 'Ors Month',
            'ors_serial' => 'Ors Serial',
            'mfo_pap' => 'Mfo Pap',
            'responsibility_center' => 'Responsibility Center',
            'amount' => 'Amount',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDvNo()
    {
        return $this->hasOne(Disbursement::className(), ['dv_no' => 'dv_no']);
    }
}
