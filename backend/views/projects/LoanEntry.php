<?php

namespace backend\models;

use Yii;
use backend\models\SubLedgerAccounts;
use backend\models\SubsidiaryLedger;
use yii\helpers\ArrayHelper;
use backend\models\TempLoanpayment;
use backend\models\AmortizationSchedule;

/**
 * This is the model class for table "loan_entry".
 *
 * @property int $id
 * @property string $date_entry
 * @property string $date_loan
 * @property string $loan_account_code
 * @property string $full_name
 * @property string $principal_amount
 * @property int $monthly_interest
 * @property int $loan_period
 * @property string $loan_type
 * @property string $status
 */
class LoanEntry extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'loan_entry';
    }

    /**
     * {@inheritdoc}
     */
    public $totalPrincipal, $totalInterest, $totalSurcharge, $credit, $interest, $deficit, $surcharge, $previous_surcharge, $remarks;
    
    public function rules()
    {
        return [
            [['date_entry', 'date_loan'], 'safe'],
            [['date_loan', 'loan_account_code', 'full_name', 'principal_amount', 'monthly_interest', 'loan_period', 'loan_type', 'status'], 'required'],
            [['principal_amount', 'totalPrincipal', 'totalInterest', 'totalSurcharge', 'credit', 'interest', 'deficit', 'surcharge', 'previous_surcharge'], 'number'],
            [['monthly_interest', 'loan_period'], 'integer'],
            [['loan_account_code'], 'string', 'max' => 200],
            [['remarks'], 'string'],
            [['full_name', 'loan_type', 'status', 'employee_id', 'agency'], 'string', 'max' => 100],
        ];
    }

    public function getSeq()
    {
        $seq = SubLedgerAccounts::find()->all();

        return sizeof($seq);
    }

    public function getMemberdetails($name)
    {
        $data = MembersProfile::find()->where(['full_name' => $name])->one();

        return $data;
    }

    public function getMembersprofile($id)
    {
        $data = MembersProfile::find()->where(['employee_id' => $id])->one();

        return $data;
    }

    public function getRemittance($month)
    {
        $remittance = SubsidiaryLedger::find()
                        ->where(['account_code' => $this->loan_account_code])
                        ->andWhere(['status' => 'Approved'])
                        ->andFilterWhere(['like', 'date_loan', $month])
                        ->one();

        return $remittance == null ? 0.00 : $remittance->credit;
        //return $this->loan_account_code;
    }

    public function getRemittances($account_code, $month)
    {
        $remittance = TempLoanpayment::find()
                        ->where(['account_code' => $account_code])
                        // ->andWhere(['status' => 'Appoved'])
                        ->andFilterWhere(['like', 'date_loan', $month])
                        ->one();

        return $remittance == null ? 0.00 : $remittance->actual_remittance;
        //return $this->loan_account_code;
    }

    public function getActualPrincipal($account_code, $month)
    {
        $remittance = TempLoanpayment::find()
                        ->where(['account_code' => $account_code])
                        ->andFilterWhere(['like', 'date_loan', $month])
                        ->one();

        return $remittance == null ? 0.00 : $remittance->actual_principal;
        //return $this->loan_account_code;
    }

    public function getActualInterest($account_code, $month)
    {
        $remittance = TempLoanpayment::find()
                        ->where(['account_code' => $account_code])
                        ->andFilterWhere(['like', 'date_loan', $month])
                        ->one();

        return $remittance == null ? 0.00 : $remittance->actual_interest;
        //return $this->loan_account_code;
    }

    public function getActualPaymentsurcharge($account_code, $month)
    {
        $remittance = TempLoanpayment::find()->where(['account_code' => $account_code])
                        ->andFilterWhere(['like', 'date_loan', $month])
                        ->one();

        return $remittance == null ? 0.00 : $remittance->actual_surcharge;
        //return $this->loan_account_code;
    }

    public function getPrevsurcharge($account_code, $month)
    {
        $value = SubsidiaryLedger::find()
                        ->where(['account_code' => $account_code])
                        ->andFilterWhere(['like', 'date_loan', $month])
                        ->one();

        return $value == null ? 0.00 : $value->debit;
        //return $this->loan_account_code;
    }

    public function getActualPrevsurcharge($account_code, $month)
    {
        $remittance = TempLoanpayment::find()->where(['account_code' => $account_code])
                        ->andFilterWhere(['like', 'date_loan', $month])
                        ->one();

        return $remittance == null ? 0.00 : $remittance->current_surcharge;
        //return $this->loan_account_code;
    }

    public function getLoanbalance($account_code)
    {
        $loan_debit = array_sum(ArrayHelper::getColumn(SubsidiaryLedger::find()
                            ->where(['account_code' => $account_code])
                            ->andWhere(['status' => 'Approved'])
                            ->all(), 'debit'));

        $loan_credit = array_sum(ArrayHelper::getColumn(SubsidiaryLedger::find()
                            ->where(['account_code' => $account_code])
                            ->andWhere(['status' => 'Approved'])
                            ->all(), 'credit'));

        return $loan_balance = $loan_debit - $loan_credit == null ? 0.00 : $loan_debit - $loan_credit;
    }

    public function getLoansurcharge($account_code)
    {
        $surcharge_debit = array_sum(ArrayHelper::getColumn(SubsidiaryLedger::find()
                            ->where(['account_code' => $account_code])
                            ->andWhere(['status' => 'Approved'])
                            ->andFilterWhere(['like', 'particulars', 'Surcharge'])
                            ->all(), 'debit'));

        $surcharge_credit = array_sum(ArrayHelper::getColumn(SubsidiaryLedger::find()
                            ->where(['account_code' => $account_code])
                            ->andWhere(['status' => 'Approved'])
                            ->andFilterWhere(['like', 'particulars', 'Surcharge'])
                            ->all(), 'credit'));

        return $loan_balance = $surcharge_debit - $surcharge_credit == null ? 0.00 : $surcharge_debit - $surcharge_credit;
    }

    // public function getLoanbalance($fullname, $type)
    // {

    // }

    public function getAccount($full_name, $type)
    {
        $account_code = LoanEntry::find()->where(['full_name' => $full_name])
                            ->andWhere(['loan_type' => $type])
                            ->andWhere(['status' => 'Active'])
                            ->one();

        return $account_code == null ? 0000 : $account_code->loan_account_code;
    }

    public function getStatus($type)
    {
        $status = LoanEntry::find()->where(['loan_type' => $type])->groupBY(['loan_account_code'])->all();

        return sizeof($status);
    }

    public function getPaid()
    {
        $paids = SubLedgerAccounts::find()->where(['status' => 'Inactive'])->andWhere(['mother_account' => '11210'])->all();

        return sizeof($paids);
    }

    public function getAmortization($account_code, $date_loan)
    {
        $data = AmortizationSchedule::find()->where(['sl_account_code' => $account_code])
                    ->andWhere(['like', 'date_remittance', date('Y-m', strtotime($date_loan))])
                    ->one();

        return $data != null ? $data->monthly_amortization : 0.00;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date_entry' => 'Date Entry',
            'date_loan' => 'Date Loan',
            'remarks' => 'Remarks',
            'loan_account_code' => 'Loan Account Code',
            'full_name' => 'Full Name',
            'principal_amount' => 'Principal Amount',
            'monthly_interest' => 'Monthly Interest (%)',
            'loan_period' => 'Loan Period',
            'loan_type' => 'Loan Type',
            'status' => 'Status',
            'agency' => 'Agency',
        ];
    }
}
