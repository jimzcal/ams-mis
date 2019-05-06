<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "draft_dv".
 *
 * @property int $id
 * @property string $payee
 * @property string $tin
 * @property string $transaction_type
 * @property string $particulars
 * @property string $gross_amount
 */
class DraftDv extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'draft_dv';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['payee', 'tin', 'transaction_type', 'particulars', 'gross_amount'], 'required'],
            [['particulars'], 'string'],
            [['gross_amount'], 'number'],
            [['payee', 'tin', 'transaction_type'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'payee' => 'Payee',
            'tin' => 'Tin',
            'transaction_type' => 'Transaction Type',
            'particulars' => 'Particulars',
            'gross_amount' => 'Gross Amount',
        ];
    }
}
