<?php

namespace frontend\models;

use backend\models\DvRemarks;

use Yii;

/**
 * This is the model class for table "disbursement".
 *
 * @property int $id
 * @property string $dv_no
 * @property string $date
 * @property string $payee
 * @property string $mode_of_payment
 * @property string $nca
 * @property string $fund_cluster
 * @property string $gross_amount
 * @property string $less_amount
 * @property string $net_amount
 * @property string $tin
 * @property int $transaction_id
 * @property string $attachments
 * @property string $cash_advance
 * @property string $remarks
 * @property string $status
 * @property string $obligated
 *
 * @property AccountingEntry[] $accountingEntries
 * @property CashAdvance[] $cashAdvances
 * @property CashStatus[] $cashStatuses
 * @property Nca $nca0
 * @property FundCluster $fundCluster
 * @property LddapAda[] $lddapAdas
 * @property Ors[] $ors
 * @property TransactionStatus[] $transactionStatuses
 */
class Disbursement extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'disbursement';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dv_no', 'date', 'payee', 'mode_of_payment', 'nca', 'fund_cluster', 'gross_amount', 'less_amount', 'net_amount', 'tin', 'transaction_id', 'attachments', 'cash_advance', 'remarks', 'status', 'obligated'], 'required'],
            [['gross_amount', 'less_amount', 'net_amount'], 'number'],
            [['transaction_id'], 'integer'],
            [['attachments', 'remarks'], 'string'],
            [['dv_no', 'payee', 'nca'], 'string', 'max' => 200],
            [['date', 'mode_of_payment', 'fund_cluster', 'tin', 'cash_advance', 'status', 'obligated'], 'string', 'max' => 100],
            [['dv_no'], 'unique'],
            [['nca'], 'exist', 'skipOnError' => true, 'targetClass' => Nca::className(), 'targetAttribute' => ['nca' => 'nca_no']],
            [['fund_cluster'], 'exist', 'skipOnError' => true, 'targetClass' => FundCluster::className(), 'targetAttribute' => ['fund_cluster' => 'fund_cluster']],
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
            'date' => 'Date',
            'payee' => 'Payee',
            'mode_of_payment' => 'Mode Of Payment',
            'nca' => 'Nca',
            'fund_cluster' => 'Fund Cluster',
            'gross_amount' => 'Gross Amount',
            'less_amount' => 'Less Amount',
            'net_amount' => 'Net Amount',
            'tin' => 'Tin',
            'transaction_id' => 'Transaction ID',
            'attachments' => 'Attachments',
            'cash_advance' => 'Cash Advance',
            'remarks' => 'Remarks',
            'status' => 'Status',
            'obligated' => 'Obligated',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountingEntries()
    {
        return $this->hasMany(AccountingEntry::className(), ['dv_no' => 'dv_no']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCashAdvances()
    {
        return $this->hasMany(CashAdvance::className(), ['dv_no' => 'dv_no']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCashStatuses()
    {
        return $this->hasMany(CashStatus::className(), ['dv_no' => 'dv_no']);
    }

    public function getRemarkss()
    {
        return $this->hasMany(DvRemarks::className(), ['dv_no' => 'dv_no']);
    }

    public function getRemark()
    {
        $remark = DvRemarks::find()
            ->where(['dv_no' => $this->dv_no])
            ->andWhere(['user_id' => Yii::$app->user->identity->id])
            ->one();

        return isset($remark->remarks) ? $remark->remarks : '' ;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNca()
    {
        return $this->hasOne(Nca::className(), ['nca_no' => 'nca']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFundCluster()
    {
        return $this->hasOne(FundCluster::className(), ['fund_cluster' => 'fund_cluster']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLddapAdas()
    {
        return $this->hasMany(LddapAda::className(), ['dv_no' => 'dv_no']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrs()
    {
        return $this->hasOne(Ors::className(), ['dv_no' => 'dv_no']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactionStatuses()
    {
        return $this->hasMany(TransactionStatus::className(), ['dv_no' => 'dv_no']);
    }
}
