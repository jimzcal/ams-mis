<?php

namespace backend\models;

use Yii;
use backend\models\TransactionStatus;
use backend\models\ResponsibilityCenter;
use backend\models\Transaction;

/**
 * This is the model class for table "disbursement".
 *
 * @property int $id
 * @property string $date
 * @property string $region
 * @property string $dv_no
 * @property string $payee
 * @property string $fund_cluster
 * @property string $rc_code
 * @property string $transaction
 * @property string $particulars
 * @property string $attachments
 * @property string $gross_amount
 * @property string $net_amount
 * @property string $status
 */
class Disbursement extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'disbursement';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date', 'region', 'dv_no', 'payee', 'fund_cluster', 'rc_code', 'transaction', 'particulars', 'attachments', 'gross_amount', 'net_amount', 'status'], 'required'],
            [['date'], 'safe'],
            [['particulars', 'attachments'], 'string'],
            [['gross_amount', 'net_amount'], 'number'],
            [['region', 'dv_no', 'payee', 'fund_cluster', 'rc_code', 'transaction', 'status'], 'string', 'max' => 100],
        ];
    }

    public function getStatus($dv_no, $process)
    {
        $data = TransactionStatus::find()->where(['dv_no' => $dv_no])
                    ->andWhere(['region' => Yii::$app->user->identity->region])
                    ->andWhere(['process' => $process])
                    ->one();

        return $data;
    }

    public function getRc($code)
    {
        $data = ResponsibilityCenter::find()->where(['code' => $code])->one();

        $value = $data != null ? $data->description.' - '.$data->code : 'RC Not registered.';

        return $value;
    }

    public function getTransaction($transaction)
    {
        $data = Transaction::find()->where(['id' => $transaction])->one();

        $value = $data != null ? $data->name : 'RC Not registered.';

        return $value;
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
            'dv_no' => 'Dv No',
            'payee' => 'Payee',
            'fund_cluster' => 'Fund Cluster',
            'rc_code' => 'Rc Code',
            'transaction' => 'Transaction',
            'particulars' => 'Particulars',
            'attachments' => 'Attachments',
            'gross_amount' => 'Gross Amount',
            'net_amount' => 'Net Amount',
            'status' => 'Status',
        ];
    }
}
