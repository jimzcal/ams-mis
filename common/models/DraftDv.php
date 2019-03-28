<?php

namespace common\models;
use backend\models\FundCluster;

use Yii;

/**
 * This is the model class for table "draft_dv".
 *
 * @property int $id
 * @property string $reference_no
 * @property string $date
 * @property string $payee
 * @property string $tin
 * @property string $fund_cluster
 * @property string $transaction_type
 * @property string $particulars
 * @property string $gross_amount
 * @property string $created_by
 * @property string $status
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
            [['reference_no', 'date', 'payee', 'fund_cluster', 'transaction_type', 'particulars', 'gross_amount'], 'required'],
            [['date'], 'safe'],
            [['particulars'], 'string'],
            [['gross_amount'], 'number'],
            [['reference_no', 'payee', 'tin', 'fund_cluster', 'transaction_type', 'created_by', 'status'], 'string', 'max' => 100],
        ];
    }

    public function getCluster()
    {
        return $this->hasOne(FundCluster::className(), ['fund_cluster' => 'fund_cluster']);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'reference_no' => 'Reference No',
            'date' => 'Date',
            'payee' => 'Payee',
            'tin' => 'Tin',
            'fund_cluster' => 'Fund Cluster',
            'transaction_type' => 'Transaction Type',
            'particulars' => 'Particulars',
            'gross_amount' => 'Gross Amount',
            'created_by' => 'Created By',
            'status' => 'Status',
        ];
    }
}
