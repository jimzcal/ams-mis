<?php

namespace backend\models;

use Yii;
use backend\models\Accounts;
use yii\helpers\ArrayHelper;
use dektrium\user\models\User;
use backend\models\SubsidiaryLedger;
use backend\models\TempTable;
use backend\models\LoanEntry;
use backend\models\AmortizationSchedule;

/**
 * This is the model class for table "journal_entry".
 *
 * @property int $id
 * @property string $date_entry
 * @property string $jev_no
 * @property string $date_transaction
 * @property string $particulars
 * @property string $dv_no
 * @property string $dv_date
 * @property string $check_no
 * @property string $check_date
 * @property string $account_code
 * @property string $debit
 * @property string $credit
 * @property string $status
 */
class JournalEntry extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'journal_entry';
    }

    public $ids, $sub_account, $sub_debit, $sub_credit, $interest, $surcharge, $total_credit, $total_debit, $date_loan, $sub_loan_account, $sub_loan_credit, $sub_loan_debit, $sub_loan_surcharge, $sub_loan_principal, $deficit, $sub_loan_interest, $prev_surcharge, $total_amortization, $total_loan_principal, $total_loan_interest, $total_loan_surcharge, $date_from, $date_to, $id2, $remittance, $total_loan_remittance, $surcharge_payment, $surcharge_total, $sub_monthly_principal, $interest_2, $fullname, $sub_debit_total, $sub_credit_total;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date_entry'], 'safe'],
            [['date_transaction', 'date_loan', 'date_from', 'date_to'], 'date'],
            [['jev_no', 'date_transaction', 'particulars', 'attachments', 'attach_date', 'attach_no', 'account_code', 'debit', 'credit'], 'required'],
            [['particulars', 'remarks', 'transaction_type', 'fullname'], 'string'],
            [['debit', 'credit', 'ids', 'prepared_by', 'approved_by', 'sub_debit', 'sub_credit', 'interest', 'surcharge', 'total_debit', 'total_credit', 'sub_loan_account', 'sub_loan_debit', 'sub_loan_credit', 'sub_loan_surcharge', 'sub_loan_principal', 'sub_loan_interest', 'deficit', 'prev_surcharge', 'total_amortization', 'total_loan_principal', 'total_loan_interest', 'total_loan_surcharge', 'id2', 'remittance', 'total_loan_remittance', 'surcharge_payment', 'sub_monthly_principal', 'interest_2', 'surcharge_total', 'sub_debit_total', 'sub_credit_total'], 'number'],
            [['jev_no', 'status'], 'string', 'max' => 300],
            [['account_code', 'attach_date', 'sub_account'], 'string', 'max' => 200],
            [['attachments'], 'string', 'max' => 500],
        ];
    }

    public function getJev()
    {
        $jev_number = JournalEntry::find()->Filterwhere(['like', 'date_transaction', date('Y')])->groupBy(['jev_no'])->all();

        return date('Y').'-'.date('m').'-000'.(sizeof($jev_number) + 1);
    }

    public function getJevdetails($jev_no)
    {
        $jev = JournalEntry::find()->where(['jev_no' => $jev_no])->all();

        return $jev;
    }

    public function getPrevsurcharge($account_code)
    {
        $total_debit = array_sum(ArrayHelper::getColumn(SubsidiaryLedger::find()
                            ->where(['account_code' => $account_code])
                            ->andWhere(['status' => 'Approved'])
                            ->andWhere(['like', 'particulars', 'Surcharge'])
                            ->all(), 'debit'));

        $total_credit = array_sum(ArrayHelper::getColumn(SubsidiaryLedger::find()
                            ->where(['account_code' => $account_code])
                            ->andWhere(['status' => 'Approved'])
                            ->andWhere(['like', 'particulars', 'Surcharge'])
                            ->all(), 'credit'));

        return $total_debit - $total_credit;
    }

    public function getAmount($account_code)
    {
        $data = LoanEntry::find()->where(['loan_account_code' => $account_code])->one();

        return $data != null ? $data->principal_amount : 0.00;
    }

    public function getDebit($jev_no)
    {
        $debit = array_sum(ArrayHelper::getColumn(JournalEntry::find()
                            ->where(['jev_no' => $jev_no])
                            ->andWhere(['status' => 'Approved'])
                            ->all(), 'debit'));
        return $debit;
    }

    public function getCredit($jev_no)
    {
        $credit = array_sum(ArrayHelper::getColumn($this->find()
                            ->where(['jev_no' => $jev_no])
                            ->andWhere(['status' => 'Approved'])
                            ->all(), 'credit'));
        return $credit;
    }

    public function getTitle($account_code)
    {
        $account = Accounts::find()->where(['account_code' => $account_code])->one();

        return $account->account_name;
    }

    public function getUser($user_id)
    {
        $name = User::find()->where(['id' => $user_id])->one();

        return $name->fullname;
    }

    public function getTemptableinterest($account_code, $date)
    {
        $data = TempTable::find()->where(['sl_account_code' => $account_code])
                    ->andWhere(['date_transaction' => $date])->one();

        return $data != null ? $data->interest : 0.00;
    }

    public function getTemptablesurecharge($account_code, $date)
    {
        $data = TempTable::find()->where(['sl_account_code' => $account_code])
                    ->andWhere(['date_transaction' => $date])->one();

        return $data != null ? $data->surcharge : 0.00;
    }

    public function getType1($value)
    {
        $account = Accounts::find()->where(['account_code' => $value])->one();
        return $account->normal_balance == 'Debit' ? $value : '';
    }

    public function getType2($value)
    {
        $account = Accounts::find()->where(['account_code' => $value])->one();
        return $account->normal_balance == 'Credit' ? $value : '';
    }

    public function getSltype($account_code)
    {
        $data = LoanEntry::find()->where(['loan_account_code' => $account_code])->one();

        return $data != null ? '('.$data->loan_type.' Loan)' : '';
    }

    public function getAmortization($account_code, $date)
    {
        $date = strtotime($date);
        $amortization = AmortizationSchedule::find()
                        ->where(['sl_account_code' => $account_code])
                        ->andWhere(['like', 'date_remittance', date('Y-m', $date)])
                        ->one();

        // var_dump($amortization);
        return $amortization;
    }

    public function getInterest($account_code)
    {

        $debit = array_sum(ArrayHelper::getColumn(SubsidiaryLedger::find()
                            ->where(['account_code' => $account_code])
                            ->andWhere(['status' => 'Approved'])
                            ->all(), 'debit'));

        $debit_surcharge = array_sum(ArrayHelper::getColumn(SubsidiaryLedger::find()
                            ->where(['account_code' => $account_code])
                            ->andWhere(['status' => 'Approved'])
                            ->andWhere(['like', 'particulars', 'Surcharge'])
                            ->all(), 'debit'));

        $credit = array_sum(ArrayHelper::getColumn(SubsidiaryLedger::find()
                            ->where(['account_code' => $account_code])
                            ->andWhere(['status' => 'Approved'])
                            ->all(), 'credit'));

        $credit_surcharge = array_sum(ArrayHelper::getColumn(SubsidiaryLedger::find()
                            ->where(['account_code' => $account_code])
                            ->andWhere(['status' => 'Approved'])
                            ->andWhere(['like', 'particulars', 'Surcharge'])
                            ->all(), 'credit'));

        // var_dump($amortization);
        return ($debit - $debit_surcharge) - ($credit - $credit_surcharge);
    }

    public function getTemplates($transaction)
    {
        $templates = JournalTemplates::find()->where(['transaction_type' => $transaction])->all();

        return $templates;
    }

    public function getSl($mother_account)
    {
        $sl = SubLedgerAccounts::find()
                ->where(['like', 'mother_account', $mother_account])
                ->andWhere(['status' => 'Active'])
                // ->orderBy(['account_title'=> SORT_ASC])
                ->all();

        return $sl;
    }

    public function getSubledger($account, $jev_no)
    {
        $sl = SubsidiaryLedger::find()
                ->where(['like', 'account_code', $account])
                ->andWhere(['jev_no' => $jev_no])
                ->all();

        return $sl;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date_entry' => 'Date Entry',
            'jev_no' => 'JEV No.',
            'remarks' => 'Remarks',
            'date_transaction' => 'Date Transaction',
            'particulars' => 'Particulars',
            'attachments' => 'Attachments',
            'attach_date' => 'Attachment Date',
            'attach_no' => 'Attach_no',
            'account_code' => 'Account Code',
            'debit' => 'Debit',
            'credit' => 'Credit',
            'status' => 'Status',
        ];
    }
}
