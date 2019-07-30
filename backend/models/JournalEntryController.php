<?php

namespace backend\controllers;

use Yii;
use backend\models\JournalEntry;
use backend\models\JournalEntrySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\GeneralLedgers;
use backend\models\SubLedgerAccounts;
use backend\models\SubsidiaryLedger;
use backend\models\LoanEntry;
use backend\models\JournalTemplates;
use backend\models\TempLoanpayment;

/**
 * JournalEntryController implements the CRUD actions for JournalEntry model.
 */
class JournalEntryController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all JournalEntry models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new JournalEntrySearch();
        // $searchModel->date_transaction = date('Y-m-d');
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $journal_templates = new JournalEntry();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'journal_templates' => $journal_templates,
        ]);
    }

    public function actionReview()
    {
        $searchModel = new JournalEntrySearch();
        $searchModel->status = 'For Review';
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('for_approval', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionRedirectindex()
    {
        return $this->redirect(['index']);
    }

    /**
     * Displays a single JournalEntry model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $jev = JournalEntry::find()->where(['id' => $id])->one();

        $model = JournalEntry::find()->where(['jev_no' => $jev->jev_no])->all();

        return $this->render('view', [
            'model' => $model,
            'jev' => $jev,
        ]);
    }

    /**
     * Creates a new JournalEntry model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($method)
    {
        if(Yii::$app->user->can('addJournalEntry'))
        {
            $model = new JournalEntry();

            $method_value = JournalTemplates::find()->where(['name' => $method])->one();

            $method = explode('*', $method_value->account_no);

            if ($model->load(Yii::$app->request->post())) 
            {

                if($model->total_credit != $model->total_debit)
                {
                    Yii::$app->getSession()->setFlash('warning', 'Total Debit and Credit are not equal. Please check your Accounting Entry.');
                    
                    if($method_value->transaction_type == 'Disbursement')
                    {
                        return $this->render('create', [
                            'model' => $model,
                            'method' => $method,
                        ]);
                    }
                    
                    if($method_value->transaction_type == 'Collection')
                    {
                        return $this->render('collection', [
                            'model' => $model,
                            'method' => $method,
                        ]);
                    }

                    if($method_value->transaction_type == 'Deposit')
                    {
                        return $this->render('deposit', [
                            'model' => $model,
                            'method' => $method,
                        ]);
                    }

                    if($method_value->transaction_type == 'Non-cash')
                    {
                        return $this->render('noncash', [
                            'model' => $model,
                            'method' => $method,
                        ]);
                    }
                }

                if($model->date_transaction != $model->attach_date[0])
                {
                    Yii::$app->getSession()->setFlash('warning', 'Date of transaction and date of issued OR should be the same.');
                    
                    if($method_value->transaction_type == 'Disbursement')
                    {
                        return $this->render('create', [
                            'model' => $model,
                            'method' => $method,
                        ]);
                    }
                    
                    if($method_value->transaction_type == 'Collection')
                    {
                        return $this->render('collection', [
                            'model' => $model,
                            'method' => $method,
                        ]);
                    }

                    if($method_value->transaction_type == 'Deposit')
                    {
                        return $this->render('deposit', [
                            'model' => $model,
                            'method' => $method,
                        ]);
                    }

                    if($method_value->transaction_type == 'Non-cash')
                    {
                        return $this->render('noncash', [
                            'model' => $model,
                            'method' => $method,
                        ]);
                    }
                }

                $jev_no = $model->getJev();

                // var_dump($model);
                // exit();

                foreach ($model->account_code as $key => $value) 
                {
                    $attachments = implode('^', $model->attachments);
                    $attach_no = implode('^', $model->attach_no);
                    $attach_date = implode('^', $model->attach_date);

                    $model2 = new JournalEntry();

                    $model2->date_transaction = $model->date_transaction;
                    $model2->jev_no = $jev_no;
                    $model2->particulars = $model->particulars;
                    $model2->attachments = $attachments;
                    $model2->attach_no = $attach_no;
                    $model2->attach_date = $attach_date;
                    $model2->remarks = '';
                    $model2->status = 'For Review';
                    $model2->transaction_type = $method_value->transaction_type;
                    $model2->account_code = $model->account_code[$key];
                    $model2->debit = $model->debit[$key];
                    $model2->credit = $model->credit[$key];
                    $model2->prepared_by = Yii::$app->user->identity->id;

                    $model2->save(false);
                }

                // var_dump($model);
                // exit();

                foreach ($model->sub_account as $key => $sub_account_value) 
                {
                    $model_sub_ledger = new SubsidiaryLedger();

                    $model_sub_ledger->date_transaction = $model->date_transaction;
                    $model_sub_ledger->jev_no = $jev_no;
                    $model_sub_ledger->account_code = $sub_account_value == null ? '' : $sub_account_value;
                    $model_sub_ledger->particulars = $model->particulars;
                    $model_sub_ledger->debit = $model->sub_debit[$key];
                    $model_sub_ledger->credit = $model->sub_credit[$key];
                    $model_sub_ledger->status = 'For Review';

                    if(($model->sub_credit[$key] != 0.00) || ($model->sub_debit[$key] != 0.00))
                    {
                        $model_sub_ledger->save(false);
                    }
                    
                }
                
                Yii::$app->getSession()->setFlash('info', 'Record was successfully saved.');
                return $this->redirect(['index']);
            }

            if($method_value->transaction_type == 'Disbursement')
            {
                return $this->render('create', [
                    'model' => $model,
                    'method' => $method,
                ]);
            }
            
            if($method_value->transaction_type == 'Collection')
            {
                return $this->render('collection', [
                    'model' => $model,
                    'method' => $method,
                ]);
            }

            if($method_value->transaction_type == 'Deposit')
            {
                return $this->render('deposit', [
                    'model' => $model,
                    'method' => $method,
                ]);
            }

            if($method_value->transaction_type == 'Non-cash')
            {
                return $this->render('noncash', [
                    'model' => $model,
                    'method' => $method,
                ]);
            }
        }

        Yii::$app->getSession()->setFlash('info', 'Sorry, you are not authorized to this action.');
        return $this->redirect(['site/index']);
    }


    public function actionLoanpayment()
    {
        $model = new JournalEntry();

        if($model->load(Yii::$app->request->post())) 
        {
            return $this->redirect(['paymentform', 'date' => $model->date_transaction]);
        }

        return $this->render('loan-payment', [
                'model' => $model,
            ]);
    }

    public function actionPaymentform($date)
    {

        $dataProvider = LoanEntry::find()->where(['status' => 'Active'])
                        // ->andWhere(['like', 'date_loan', date('Y-m', strtotime($date))])
                        ->all();

        $model = new JournalEntry();

        if($model->load(Yii::$app->request->post())) 
        {
            if($model->total_credit != $model->total_debit)
                {
                    Yii::$app->getSession()->setFlash('warning', 'Total Debit and Credit are not equal. Please check your Accounting Entry.');

                    return $this->render('payment', [
                        'dataProvider' => $dataProvider,
                        'model' => $model,
                        'date' => $date,
                    ]);
                }

                $jev_no = $model->getJev();

                foreach ($model->account_code as $key => $value) 
                {
                    $attachments = implode('^', $model->attachments);
                    $attach_no = implode('^', $model->attach_no);
                    $attach_date = implode('^', $model->attach_date);

                    $model2 = new JournalEntry();

                    $model2->date_transaction = $model->date_transaction;
                    $model2->jev_no = $jev_no;
                    $model2->particulars = $model->particulars;
                    $model2->attachments = $attachments;
                    $model2->attach_no = $attach_no;
                    $model2->attach_date = $attach_date;
                    $model2->status = 'For Review';
                    $model2->transaction_type = 'Loan';
                    $model2->account_code = $model->account_code[$key];
                    $model2->debit = $model->debit[$key];
                    $model2->credit = $model->credit[$key];
                    $model2->prepared_by = Yii::$app->user->identity->id;

                    if(($model->debit[$key] != 0.00) || ($model->credit[$key] != 0.00))
                    {
                        $model2->save(false);
                    }

                }

                if(($model->sub_debit != 0) || ($model->sub_credit != 0))
                {
                    $model_sub_ledger = new SubsidiaryLedger();

                    $model_sub_ledger->date_transaction = $model->date_transaction;
                    $model_sub_ledger->jev_no = $model2->jev_no;
                    $model_sub_ledger->account_code = $model->sub_account;
                    $model_sub_ledger->particulars = $model->particulars;
                    $model_sub_ledger->debit = $model->sub_debit;
                    $model_sub_ledger->credit = $model->sub_credit;
                    $model_sub_ledger->status = 'For Review';

                    $model_sub_ledger->save(false);
                }

                foreach ($model->sub_loan_account as $key => $value)
                {
                    $model_payment = new TempLoanpayment();

                    $model_payment->date_loan = $model->date_loan;
                    $model_payment->account_code = $model->sub_loan_account[$key];
                    $model_payment->jev_no = $model2->jev_no;
                    $model_payment->fullname = $model->fullname[$key];
                    $model_payment->actual_remittance = $model->remittance[$key];
                    $model_payment->actual_principal = $model->sub_loan_principal[$key];
                    $model_payment->actual_interest = $model->sub_loan_interest[$key];
                    $model_payment->actual_surcharge = $model->surcharge_payment[$key];
                    $model_payment->deficit = $model->deficit[$key];
                    $model_payment->prev_surcharge = $model->prev_surcharge[$key];
                    $model_payment->current_surcharge = $model->surcharge[$key];
                    $model_payment->status = 'For Approval';

                    if(($model_payment->actual_remittance != false) || ($model_payment->current_surcharge != false))
                    {
                        $model_payment->save(false);
                    }
                }

                Yii::$app->getSession()->setFlash('info', 'Record was successfully saved and is subject for review and approval.');
                return $this->redirect(['index']);
        }
        
        return $this->render('payment', [
                'dataProvider' => $dataProvider,
                'model' => $model,
                'date' => $date,
            ]);
    }

    /**
     * Updates an existing JournalEntry model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if(Yii::$app->user->can('reviewApproveJournalEntry'))
        {
            $model = $this->findModel($id);

            $journal_entry = JournalEntry::find()->where(['jev_no' => $model->jev_no])->all();

            $model_sub = SubsidiaryLedger::find()->where(['jev_no' => $model->jev_no])->all();

            $model_2 = new JournalEntry();

            $method = [];

            foreach ($journal_entry as $key => $value) 
            {
                array_push($method, $value->account_code);
            }


            if ($model_2->load(Yii::$app->request->post())) 
            {
                if($model_2->total_credit != $model_2->total_debit)
                {
                    Yii::$app->getSession()->setFlash('warning', 'Total Debit and Credit are not equal. Please check your Accounting Entry.');

                    if($model->transaction_type == 'Disbursement')
                    {
                        return $this->render('_formUpdate', [
                            'model' => $model,
                            'journal_entry' => $journal_entry,
                            'model_sub' => $model_sub, 
                            'model_2' => $model_2,
                        ]);
                    }
                    
                    if($model->transaction_type == 'Collection')
                    {
                        return $this->render('_formCollectionUpdate', [
                            'model' => $model,
                            'journal_entry' => $journal_entry,
                            'model_sub' => $model_sub, 
                            'model_2' => $model_2,
                        ]);
                    }

                    if($model->transaction_type == 'Deposit')
                    {
                        return $this->render('_formDepositUpdate', [
                            'model' => $model,
                            'journal_entry' => $journal_entry,
                            'model_sub' => $model_sub, 
                            'model_2' => $model_2,
                        ]);
                    }

                }

                foreach ($model_2->account_code as $key => $value) 
                {
                    $check_journal = JournalEntry::find()
                            ->where(['jev_no' => $model_2->jev_no])
                            ->andWhere(['id' => $model_2->ids[$key]])
                            ->one();

                    if(isset($check_journal) == true)
                    {
                        $model2 =   JournalEntry::find()
                                    ->where(['jev_no' => $model_2->jev_no])
                                    ->andWhere(['id' => $model_2->ids[$key]])
                                    ->one();
                    }

                    if(isset($check_journal) == null)
                    {
                        $model2 = new JournalEntry();
                    }

                    $attachments = implode('^', $model_2->attachments);
                    $attach_no = implode('^', $model_2->attach_no);
                    $attach_date = implode('^', $model_2->attach_date);

                    $model2->date_transaction = $model_2->date_transaction;
                    $model2->jev_no = $model_2->jev_no;
                    $model2->particulars = $model_2->particulars;
                    $model2->attachments = $attachments;
                    $model2->attach_no = $attach_no;
                    $model2->attach_date = $attach_date;
                    $model2->remarks = $model_2->remarks == null ? '' : $model_2->remarks;
                    $model2->status = $model_2->status;
                    $model2->account_code = $model_2->account_code[$key];
                    $model2->debit = $model_2->debit[$key];
                    $model2->credit = $model_2->credit[$key];
                    $model2->approved_by = Yii::$app->user->identity->id;

                    $model2->save(false);

                    if($model_2->status == 'Approved')
                    {
                        $model_general_ledger = new GeneralLedgers();

                        $model_general_ledger->date_transaction = $model_2->date_transaction;
                        $model_general_ledger->jev_no = $model_2->jev_no;
                        $model_general_ledger->account_code = $model_2->account_code[$key];
                        $model_general_ledger->particulars = $model_2->particulars;
                        $model_general_ledger->debit = $model_2->debit[$key];
                        $model_general_ledger->credit = $model_2->credit[$key];
                        $model_general_ledger->balance = 0.00;

                        $model_general_ledger->save(false);   
                    }
                }

                if($model_2->sub_account != null && $model_2->sub_account != " ")
                {
                    foreach ($model_2->sub_account as $key => $value) 
                    {
                        $model_sub2 = SubsidiaryLedger::find()
                                    ->where(['jev_no' => $model_2->jev_no])
                                    ->andWhere(['account_code' => $model_2->sub_account[$key]])
                                    ->andWhere(['id' => $model_2->id2[$key]])
                                    ->one();

                        $model_sub2->date_transaction = $model_2->date_transaction;
                        $model_sub2->jev_no = $model_2->jev_no;
                        $model_sub2->account_code = $model_2->sub_account[$key];
                        $model_sub2->particulars = $model_2->particulars;
                        $model_sub2->debit = $model_2->sub_debit[$key];
                        $model_sub2->credit = $model_2->sub_credit[$key];
                        $model_sub2->status = $model_2->status;

                        $model_sub2->save(false);
                    }
                }

                Yii::$app->getSession()->setFlash('info', 'Record has been successfully updated.');

                return $this->redirect(['index']);
            }

            if($model->transaction_type == 'Disbursement')
            {
                return $this->render('_formUpdate', [
                    'model' => $model,
                    'journal_entry' => $journal_entry,
                    'model_sub' => $model_sub, 
                    'model_2' => $model_2,
                    'method' => $method,
                ]);
            }
            
            if($model->transaction_type == 'Collection')
            {
               
                return $this->render('_formCollectionUpdate', [
                    'model' => $model,
                    'journal_entry' => $journal_entry,
                    'model_sub' => $model_sub, 
                    'model_2' => $model_2,
                    'method' => $method,
                ]);
            }

            if($model->transaction_type == 'Deposit')
            {
                return $this->render('_formDepositUpdate', [
                    'model' => $model,
                    'journal_entry' => $journal_entry,
                    'model_sub' => $model_sub, 
                    'model_2' => $model_2,
                    'method' => $method,
                ]);
            }

            if($model->transaction_type == 'Loan')
            {
                return $this->redirect(['updateloan', 'id' => $id]);
            }
            
            if($model->transaction_type == 'Non-cash')
            {
                return $this->render('_noncashUpdate', [
                    'model' => $model,
                    'journal_entry' => $journal_entry,
                    'model_sub' => $model_sub, 
                    'model_2' => $model_2,
                    'method' => $method,
                ]);
            }

            // return $this->render('update', [
            //     'model' => $model,
            //     'journal_entry' => $journal_entry,
            //     'model_sub' => $model_sub,
            //     'model_2' => $model_2,
            // ]);
        }

        Yii::$app->getSession()->setFlash('info', 'Sorry, you are not authorized to this action.');
        return $this->redirect(['journal-entry/index']);

    }

    public function actionUpdateloan($id)
    {

        if(Yii::$app->user->can('reviewApproveJournalEntry'))
        {
            $model = $this->findModel($id);

            $dataProvider = TempLoanpayment::find()->where(['jev_no' => $model->jev_no])->all();

            $dateloan = TempLoanpayment::find()->where(['jev_no' => $model->jev_no])->one();

            $journal_entry = JournalEntry::find()->where(['jev_no' => $model->jev_no])->all();

            $sl_treasurer = SubsidiaryLedger::find()->where(['like', 'account_code', '11110'])->andWhere(['jev_no' => $model->jev_no])->one();

            $model2 = new JournalEntry();

            if ($model2->load(Yii::$app->request->post())) 
            {
                if($model2->total_credit != $model2->total_debit)
                {
                    Yii::$app->getSession()->setFlash('warning', 'Total Debit and Credit are not equal. Please check your Accounting Entry.');

                    return $this->render('_paymentFormUpdate', [
                        'model' => $model,
                        'dataProvider' => $dataProvider,
                        'model2' => $model2, 
                        'journal_entry' => $journal_entry,
                        'sl_treasurer' => $sl_treasurer,
                    ]);
                }

                foreach ($model2->account_code as $key => $value) 
                {
                    $check_journal = JournalEntry::find()
                            ->where(['jev_no' => $model2->jev_no])
                            ->andWhere(['id' => $model2->ids[$key]])
                            ->one();

                    $model_2 = isset($check_journal) == true ? $check_journal : new JournalEntry();

                    $attachments = implode('^', $model2->attachments);
                    $attach_no = implode('^', $model2->attach_no);
                    $attach_date = implode('^', $model2->attach_date);

                    $model_2->date_transaction = $model2->date_transaction;
                    $model_2->jev_no = $model2->jev_no;
                    $model_2->particulars = $model2->particulars;
                    $model_2->attachments = $attachments;
                    $model_2->attach_no = $attach_no;
                    $model_2->attach_date = $attach_date;
                    // $model_2->remarks = $model2->remarks == null ? '' : $model2->remarks;
                    $model_2->status = $model2->status;
                    $model_2->account_code = $model2->account_code[$key];
                    $model_2->debit = $model2->debit[$key];
                    $model_2->credit = $model2->credit[$key];
                    $model_2->approved_by = Yii::$app->user->identity->id;

                    $model_2->save(false);

                    if($model_2->status == 'Approved')
                    {
                        $model_general_ledger = new GeneralLedgers();

                        $model_general_ledger->date_transaction = $model2->date_transaction;
                        $model_general_ledger->jev_no = $model2->jev_no;
                        $model_general_ledger->account_code = $model2->account_code[$key];
                        $model_general_ledger->particulars = $model2->particulars;
                        $model_general_ledger->debit = $model2->debit[$key];
                        $model_general_ledger->credit = $model2->credit[$key];
                        $model_general_ledger->balance = 0.00;

                        $model_general_ledger->save(false);   
                    }
                }

                foreach ($model2->sub_loan_account as $key => $value)
                {
                    $model_payment = TempLoanpayment::find()->where(['account_code' => $model2->sub_loan_account[$key]])->andWhere(['date_loan' => $dateloan->date_loan])->one();

                    $model_payment->date_loan = $dateloan->date_loan;
                    $model_payment->account_code = $model2->sub_loan_account[$key];
                    $model_payment->jev_no = $model2->jev_no;
                    $model_payment->fullname = $model2->fullname[$key];
                    $model_payment->actual_remittance = $model2->remittance[$key];
                    $model_payment->actual_principal = $model2->sub_loan_principal[$key];
                    $model_payment->actual_interest = $model2->sub_loan_interest[$key];
                    $model_payment->actual_surcharge = $model2->surcharge_payment[$key];
                    $model_payment->deficit = $model2->deficit[$key];
                    $model_payment->prev_surcharge = $model2->prev_surcharge[$key];
                    $model_payment->current_surcharge = $model2->surcharge[$key];
                    $model_payment->status = $model2->status;

                    $model_payment->save(false);
                }

                $check_sl = SubsidiaryLedger::find()
                                ->where(['jev_no' => $model2->jev_no])
                                ->andWhere(['account_code' => $model2->sub_account])
                                ->one();

                $model_sl = isset($check_sl) == true ? $check_sl : new SubsidiaryLedger();

                $model_sl->date_transaction = $model2->date_transaction;
                $model_sl->date_loan = $dateloan->date_loan;
                $model_sl->jev_no = $model2->jev_no;
                $model_sl->account_code = $model2->sub_account;
                $model_sl->particulars = $model2->particulars;
                $model_sl->debit = $model2->sub_debit;
                $model_sl->credit = $model2->sub_credit;
                $model_sl->status = $model2->status;

                $model_sl->save(false);
                

                $array_size = sizeof($model2->sub_loan_account);

                for($i = 0; $i < $array_size; $i++) 
                {
                    $check_sl = SubsidiaryLedger::find()->where(['jev_no' => $model2->jev_no])
                                    ->andWhere(['account_code' => $model2->sub_loan_account[$i]])->one();

                    $model_loan_sl = isset($check_sl) == true ? $check_sl : new SubsidiaryLedger();

                    $model_loan_sl->date_transaction = $model2->date_transaction;
                    $model_loan_sl->date_loan = $dateloan->date_loan;
                    $model_loan_sl->jev_no = $model2->jev_no;
                    $model_loan_sl->account_code = $model2->sub_loan_account[$i];
                    $model_loan_sl->particulars = $model2->particulars;
                    $model_loan_sl->debit = 0.00;
                    $model_loan_sl->credit = $model2->sub_loan_principal[$i];
                    $model_loan_sl->status = $model2->status;

                    $model_loan_sl->save(false);
                }

                for($key = 0; $key < $array_size; $key++) 
                {
                    $check_sl_surcharge = SubsidiaryLedger::find()->where(['jev_no' => $model2->jev_no])
                                    ->andWhere(['account_code' => $model2->sub_loan_account[$key]])
                                    ->andWhere(['credit' => 0.00])
                                    ->one();

                    $model_sl_surcharge = isset($check_sl_surcharge) == true ? $check_sl_surcharge : new SubsidiaryLedger();

                    $model_sl_surcharge->date_transaction = $model2->date_transaction;
                    $model_sl_surcharge->jev_no = $model2->jev_no;
                    $model_sl_surcharge->account_code = $model2->sub_loan_account[$key];
                    $model_sl_surcharge->date_loan = $dateloan->date_loan;
                    $model_sl_surcharge->particulars = "Surcharge";
                    $model_sl_surcharge->debit = $model2->surcharge[$key];
                    $model_sl_surcharge->credit = 0.00;
                    $model_sl_surcharge->status = $model2->status;

                    if($model2->surcharge[$key] != 0.00)
                    {
                        $model_sl_surcharge->save(false);
                    }
                }

                for($key = 0; $key < $array_size; $key++) 
                {
                    $check_surcharge_payment = SubsidiaryLedger::find()->where(['jev_no' => $model2->jev_no])
                                    ->andWhere(['account_code' => $model2->sub_loan_account[$key]])
                                    ->andWhere(['debit' => 0.00])
                                    ->one();

                    $sl_surcharge_payment = isset($check_surcharge_payment) == true ? $check_surcharge_payment : new SubsidiaryLedger();

                    $sl_surcharge_payment->date_transaction = $model2->date_transaction;
                    $sl_surcharge_payment->jev_no = $model2->jev_no;
                    $sl_surcharge_payment->account_code = $model2->sub_loan_account[$key];
                    $sl_surcharge_payment->date_loan = $dateloan->date_loan;
                    $sl_surcharge_payment->particulars = "Surcharge";
                    $sl_surcharge_payment->debit = 0.00;
                    $sl_surcharge_payment->credit = $model2->surcharge_payment[$key];
                    $sl_surcharge_payment->status = $model2->status;

                    if($model2->surcharge_payment[$key] != 0.00)
                    {
                        $sl_surcharge_payment->save(false);
                    }
                }

                Yii::$app->getSession()->setFlash('info', 'Record has been successfully updated.');

                return $this->redirect(['index']);
            }

            return $this->render('_paymentFormUpdate', [
                    'model' => $model,
                    'dataProvider' => $dataProvider,
                    'model2' => $model2, 
                    'journal_entry' => $journal_entry,
                    'sl_treasurer' => $sl_treasurer,
                ]);
        }
    }

    /**
     * Deletes an existing JournalEntry model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if(Yii::$app->user->can('reviewApproveJournalEntry'))
        {

            $model = JournalEntry::findOne($id);

            JournalEntry::deleteAll(['jev_no' => $model->jev_no]);

            SubsidiaryLedger::deleteAll(['jev_no' => $model->jev_no]);

            Yii::$app->getSession()->setFlash('info', 'Record was successfully deleted.');
            return $this->redirect(['review']);
        }

        Yii::$app->getSession()->setFlash('info', 'Sorry, you are not authorized to this action.');
        return $this->redirect(['journal-entry/index']);
    }

    /**
     * Finds the JournalEntry model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return JournalEntry the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = JournalEntry::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
