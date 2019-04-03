<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "disbursed_po".
 *
 * @property int $id
 * @property string $dv_no
 * @property string $dv_date
 * @property string $po_no
 * @property string $amount
 * @property string $date
 */
class DisbursedPo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'disbursed_po';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dv_no', 'dv_date', 'amount'], 'required'],
            [['dv_date', 'date'], 'safe'],
            [['amount'], 'number'],
            [['dv_no', 'po_no'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'dv_no' => 'DV No',
            'dv_date' => 'DV Date',
            'po_no' => 'PO No',
            'amount' => 'Amount',
            'date' => 'Date',
        ];
    }
}
