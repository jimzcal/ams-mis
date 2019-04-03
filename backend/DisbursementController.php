<?php

namespace backend\controllers;

use Yii;
use backend\models\Disbursement;
use backend\models\DisbursementSearch;
use backend\models\CashAdvance;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\TransactionStatus;
use backend\models\Transaction;
use backend\models\AccountingEntry;
use yii\filters\AccessControl;
use backend\models\DisbursedDv;
use backend\models\Nca;
use kartik\mpdf\Pdf;
use backend\models\LddapAda;
use backend\models\Ors;
use backend\models\ActivityLog;
use backend\models\DvLog;
use backend\models\DvRemarks;
use backend\models\OrsRegistry;
use backend\models\NcaEarmarked;
use common\models\DraftDv;
use backend\models\Inbox;
use yii\helpers\ArrayHelper;

/**
 * DisbursementController implements the CRUD actions for Disbursement model.
 */
class DisbursementController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'view', 'create', 'update', 'delete', 'processor', 'cash', 'reports', 'nca', 'ada', 'disbursement', 'mDisbursement', 'cashStatus'],
                'rules' => [
                  [
                    'allow' => true,
                    'roles' => ['@']
                  ]
                            
              ],
          ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Disbursement models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DisbursementSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Disbursement model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $dv_no = Disbursement::find()->where(['id'=>$id])->one();
        $transaction = TransactionStatus::find()->where(['dv_no' => $dv_no->dv_no])->one();
        $dv_log = DvLog::find()->where(['dv_no' => $dv_no->dv_no])
                    ->andWhere(['region' => Yii::$app->user->identity->region])
                    ->all();

        $dvlog_model = new DvLog();
        // var_dump($dv_no);
        // exit();
        $transaction1 = explode(',', $transaction->receiving);
        $transaction2 = explode(',', $transaction->processing);
        $transaction3 = explode(',', $transaction->verification);
        $transaction4 = explode(',', $transaction->nca_control);
        $transaction5 = explode(',', $transaction->lddap_ada);
        $transaction6 = explode(',', $transaction->releasing);
        $transaction7 = explode(',', $transaction->indexing);
        $transaction8 = explode(',', $transaction->approval);

        if ($dvlog_model->load(Yii::$app->request->post()))
        {
            $dvlog_model->transaction = "Out from Accounting and Received by: ";
            $dvlog_model->save(false);

            $dv_no->status = $dv_no->status.' & Released';
            $dv_no->save(false);

            return $this->render('_loader', ['id' => $id]);
        }

        return $this->render('view', [
            'model' => $this->findModel($id), 
            'transaction1'=>$transaction1, 
            'transaction2'=>$transaction2,
            'transaction3'=>$transaction3, 
            'transaction4'=>$transaction4,
            'transaction5'=>$transaction5, 
            'transaction6'=>$transaction6,
            'transaction7'=>$transaction7,
            'transaction8'=>$transaction8,
            'dv_log' => $dv_log,
            'dvlog_model' => $dvlog_model,
        ]);
    }

    public function actionProcessor($id)
    {
        $model = $this->findModel($id);
        $model2 = new OrsRegistry();

        //$ors_model = Ors::find()->where(['dv_no' => $model->dv_no])->all();

        $dv_no = Disbursement::find(['dv_no'])->where(['id'=>$id])->one();
        $transaction = TransactionStatus::find()->where(['dv_no'=>$dv_no->dv_no])->one();
        $acounting_model = AccountingEntry::find()->where(['dv_no' => $dv_no->dv_no])->all();

        //$ors_checker = OrsRegistry::find()->where(['dv_no'=>$dv_no])->all();
        
        if ($model->load(Yii::$app->request->post()))
        {
            if ((\Yii::$app->user->can('Verifier'))  && (($model->action == null) || ($model->action == '')))
            {
                Yii::$app->getSession()->setFlash('warning', 'Please select action');

                return $this->render('viewP', [
                    'model' => $model,
                    'acounting_model' => $acounting_model,
                ]);
            }

            if ((\Yii::$app->user->can('processor'))  && (($model->action == null) || ($model->action == '')))
            {
                Yii::$app->getSession()->setFlash('warning', 'Please select action');

                return $this->render('viewP', [
                    'model' => $model,
                    'acounting_model' => $acounting_model,
                ]);
            }

            if (isset($_POST['debit']))
            {
                $debit = $_POST['debit'];

                if(($debit[0] ==="") || ($debit[0] == null) || ($debit[0] == "0.0") || ($debit[0] == "0"))
                {
                    Yii::$app->getSession()->setFlash('warning', 'Please provide debit amount at the beginning of Accounting Entry');

                    return $this->render('viewP', [
                        'model' => $model,
                        'acounting_model' => $acounting_model,
                    ]);
                }
            }

            if(isset($_POST['requirements']))
            {
                $model->attachments = implode(',', $_POST['requirements']);
            }

            if(isset($_POST['requirements']) === null )
            {
                $model->attachments = '';
            }

            $model->net_amount = $model->gross_amount - $model->less_amount;

            //Start of Ativity Log --------------------------------

            // $log = new ActivityLog();
            // $log->particular = "Made changes on DV No. ".$model->dv_no.' with the following short details: Gross Amount - '.$model->gross_amount.', Net Amount - '.$model->net_amount;
            // $log->date_time = date('m/d/Y h:i');
            // $log->user = Yii::$app->user->identity->fullname;
            // $log->save(false);

            //End of Ativity Log --------------------------------

            // var_dump($model->ors_no);
            // exit();
            
            for($i=0; $i<sizeof($model->ors_no); $i++)
            {
                $ors_registry_model = OrsRegistry::find()->where(['ors_no' => $model->ors_no[$i]])
                    ->andWhere(['dv_no' => $model->dv_no])
                    ->andWhere(['responsibility_center' => $model->responsibility_center[$i]])
                    ->andWhere(['mfo_pap' => $model->mfo_pap[$i]])
                    ->andWhere(['object_code' => $model->object_code[$i]])
                    ->andWhere(['region' => Yii::$app->user->identity->region])
                    ->one() == null ? new OrsRegistry() : 

                    OrsRegistry::find()->where(['ors_no' => $model->ors_no[$i]])
                    ->andWhere(['dv_no' => $model->dv_no])
                    ->andWhere(['responsibility_center' => $model->responsibility_center[$i]])
                    ->andWhere(['mfo_pap' => $model->mfo_pap[$i]])
                    ->andWhere(['object_code' => $model->object_code[$i]])
                    ->andWhere(['region' => Yii::$app->user->identity->region])
                    ->one();

                $ors_registry_model->region = Yii::$app->user->identity->region;
                $ors_registry_model->date = date('Y-m-d');
                $ors_registry_model->ors_no = $model->ors_no[$i];
                $ors_registry_model->dv_no = $model->dv_no;
                $ors_registry_model->disbursement_date = $model->date;
                $ors_registry_model->fund_cluster = $model->fund_cluster;
                $ors_registry_model->ors_class = $model->getOrsdetails($model->ors_no[$i])->ors_class;
                $ors_registry_model->funding_source = $model->getOrsdetails($model->ors_no[$i])->funding_source;
                $ors_registry_model->ors_year = $model->getOrsdetails($model->ors_no[$i])->ors_year;
                $ors_registry_model->ors_month = $model->getOrsdetails($model->ors_no[$i])->ors_month;
                $ors_registry_model->ors_serial = $model->getOrsdetails($model->ors_no[$i])->ors_serial;
                $ors_registry_model->responsibility_center = $model->responsibility_center[$i];
                $ors_registry_model->mfo_pap = $model->mfo_pap[$i];
                $ors_registry_model->object_code = $model->object_code[$i];
                $ors_registry_model->payment = $model->payment[$i];
                $ors_registry_model->status = 'For Payment';

                $ors_registry_model->save(false);
            }

            if(isset($_POST['uacs_code']))
            {
                $account_title = $_POST['account_title'];
                $uacs_code = $_POST['uacs_code'];
                $debit = $_POST['debit'];
                $credit_amount = $_POST['credit_amount'];
                $id = isset($_POST['id']) == true ? $_POST['id'] : null;

                for($i=0; $i<sizeof($account_title); $i++) 
                {
                    if(isset($id[$i]))
                    {
                        $acoounting_model = AccountingEntry::find()->where(['dv_no' => $model->dv_no])
                                            ->andWhere(['id' => $id[$i]])
                                            ->one();
                    }
                    if(isset($id[$i]) == false)
                    {
                        $acoounting_model = null;
                    }

                    $accounting_model = $acoounting_model == null ? new AccountingEntry() : $acoounting_model;

                    $accounting_model->account_title = $account_title[$i];
                    $accounting_model->dv_no = $model->dv_no;
                    $accounting_model->region = Yii::$app->user->identity->region;
                    $accounting_model->uacs_code = $uacs_code[$i];
                    $accounting_model->debit = $debit[$i] == "" ? 0.00 : $debit[$i];
                    $accounting_model->credit_amount = $credit_amount[$i] == "" ? 0.00 : $credit_amount[$i];

                    $accounting_model->save(false);

                    AccountingEntry::deleteAll(['account_title' => '', 'uacs_code' => '']);
                }
            }

            $model->status = \Yii::$app->user->can('processor') ? "Processed" : $model->action;
            $model->save(false);

            if($model->action == 'Back to Payee')
            {
                $inbox_model = Inbox::find()->where(['dv_no' => $model->dv_no])->andWhere(['user_role' => 'releaser'])->one();
                $inbox_model = $inbox_model == null ? new Inbox() : $inbox_model;
                $inbox_model->dv_no = $model->dv_no;
                $inbox_model->date = date('Y-m-d');
                $inbox_model->user_role = 'releaser';
                $inbox_model->status = 1;
                $inbox_model->save(false);

                $dv_logs_model = new DvLog();
                // $dv_logs_model->date = date('Y-m-d g:i a');
                $dv_logs_model->dv_no = $model->dv_no;
                $dv_logs_model->transaction = "Forwarded to releaser. ";
                $dv_logs_model->employee_id = $model->getId(Yii::$app->user->identity->id);
                $dv_logs_model->save(false);
            }

            if($model->action == 'Forward to Verifier')
            {
                $inbox_model = Inbox::find()->where(['dv_no' => $model->dv_no])->andWhere(['user_role' => 'Verifier'])->one();
                $inbox_model = $inbox_model == null ? new Inbox() : $inbox_model;
                $inbox_model->dv_no = $model->dv_no;
                $inbox_model->date = date('Y-m-d');
                $inbox_model->user_role = 'Verifier';
                $inbox_model->status = 1;
                $inbox_model->save(false);

                $dv_logs_model = new DvLog();
                // $dv_logs_model->date = date('Y-m-d g:i a');
                $dv_logs_model->dv_no = $model->dv_no;
                $dv_logs_model->transaction = "Forwarded to verifier.";
                $dv_logs_model->employee_id = $model->getId(Yii::$app->user->identity->id);
                $dv_logs_model->save(false);
            }

            if($model->action == 'For Approval')
            {
                $inbox_model = Inbox::find()->where(['dv_no' => $model->dv_no])->andWhere(['user_role' => 'admin'])->one();
                $inbox_model = $inbox_model == null ? new Inbox() : $inbox_model;
                $inbox_model->dv_no = $model->dv_no;
                $inbox_model->date = date('Y-m-d');
                $inbox_model->user_role = 'admin';
                $inbox_model->status = 1;
                $inbox_model->save(false);

                $dv_logs_model = new DvLog();
                // $dv_logs_model->date = date('Y-m-d g:i a');
                $dv_logs_model->dv_no = $model->dv_no;
                $dv_logs_model->transaction = "Forwarded to the Chief Accountant.";
                $dv_logs_model->employee_id = $model->getId(Yii::$app->user->identity->id);
                $dv_logs_model->save(false);
            }

            if($model->action == 'Approved')
            {
                $inbox_model = Inbox::find()->where(['dv_no' => $model->dv_no])->andWhere(['user_role' => 'nca_controller'])->one();
                $inbox_model = $inbox_model == null ? new Inbox() : $inbox_model;
                $inbox_model->dv_no = $model->dv_no;
                $inbox_model->date = date('Y-m-d');
                $inbox_model->user_role = 'nca_controller';
                $inbox_model->status = 1;
                $inbox_model->save(false);

                $dv_logs_model = new DvLog();
                // $dv_logs_model->date = date('Y-m-d g:i a');
                $dv_logs_model->dv_no = $model->dv_no;
                $dv_logs_model->transaction = "Forwarded to releaser.";
                $dv_logs_model->employee_id = $model->getId(Yii::$app->user->identity->id);
                $dv_logs_model->save(false);
            }

            

            //New Remarks ------------------------------------------
                $model_remarks = DvRemarks::find()
                        ->where(['dv_no' => $model->dv_no])
                        ->andWhere(['user_id' => Yii::$app->user->identity->id])
                        ->one();

                if($model_remarks == null)
                {
                    if(!empty($model->remarks))
                    {
                        $model_remarks = new DvRemarks();
                        $model_remarks->dv_no = $model->dv_no;
                        $model_remarks->remarks = $model->remarks;
                        $model_remarks->user_id = Yii::$app->user->identity->id;
                        // $model_remarks->date = date('Y-m-d g:i a');

                        $model_remarks->save(false);
                    }
                }

                else
                {
                    if(!empty($model->remarks))
                    {
                        $model_remarks->remarks = $model->remarks;
                        // $model_remarks->date = date('Y-m-d g:i a');

                        $model_remarks->save(false);
                    }
                    else
                    {
                        $model_remarks->delete();
                    }
                }
            //End Remarks ------------------------------------------

            Yii::$app->getSession()->setFlash('success', 'Successfully Saved');

            return $this->render('viewPr', [
                'model' => $model,
                'acounting_model' => $acounting_model,
            ]);
        }

        $dv_logs_model = new DvLog();
        //$dv_logs_model->date = date('Y-m-d g:i a');
        $dv_logs_model->dv_no = $model->dv_no;
        $dv_logs_model->region = Yii::$app->user->identity->region;
        $dv_logs_model->transaction = "Received DV.";
        $dv_logs_model->employee_id = $model->getId(Yii::$app->user->identity->id);
        $dv_logs_model->save(false);


        return $this->render('viewP', [
            'model' => $model,
            'acounting_model' => $acounting_model,
        ]);

    }

    public function actionCreate($reference_no)
    {
        if(\Yii::$app->user->can('createDisbursementVoucher'))
        {
            $model = new Disbursement();
            $values = Disbursement::find()->all();
            $serial = strlen((string) sizeof($values)) === 1 ? '000' : '00';
            $dv_no = date('Y').'-'.date('m').'-'.$serial.(sizeof($values)+1);

            if ($model->load(Yii::$app->request->post()))
            {
                $model->gross_amount = str_replace(',', '', $model->gross_amount);
                $model->payee = strtoupper($model->payee);
                $model->status = 'Received & Encoded';
                $model->ors = implode('/', $model->ors);
                $model->region = Yii::$app->user->identity->region;

                if($model->getValidating($model->payee, $model->particulars, $model->gross_amount) == null)
                {
                    $model->save(false);
                }

                else
                {
                    Yii::$app->getSession()->setFlash('info', '<i class="glyphicon glyphicon-alert" style="color: red;"></i> Similar transaction is detected. Please check <strong> DV No. '.$model->getValidating($model->payee, $model->particulars, $model->gross_amount). '</strong> for verification.');

                    return $this->render('create', [
                        'model' => $model,
                        'dv_no' => $dv_no,
                    ]);
                }
                
      
                
                //Start recording transactions ------------------------------------------

                $model3 = new TransactionStatus();
                $model3->dv_no = $model->dv_no;
                $detail = Yii::$app->user->identity->fullname.','.date('m/d/Y h:i');
                $model3->receiving = $detail;
                $model3->save(false);

                //End Recordinf transactions ------------------------------------------

                //Start recording transactions ------------------------------------------

                $model4 = new Inbox();
                $model4->dv_no = $model->dv_no;
                $model4->date = date('Y-m-d');
                $model4->user_role = 'processor';
                $model4->status = 1;
                $model4->save(false);

                //End Recordinf transactions ------------------------------------------


                //Start of Ativity Log --------------------------------

                $log = new ActivityLog();
                $log->particular = 'Adding new Disbursement Voucher with the following short details: DV No. - '.$model->dv_no.' Gross Amount - '.$model->gross_amount.', Net Amount - '.$model->net_amount;
                $log->date_time = date('m/d/Y h:i');
                $log->user = Yii::$app->user->identity->fullname;
                $log->save(false);

                //End of Ativity Log --------------------------------

                if(($model->period != null) && ($model->period != 0))
                {
                    $advance_model = new CashAdvance();

                    $advance_model->dv_no = $model->dv_no;
                    $advance_model->date = date('Y-m-d ');
                    $advance_model->status = 'Unliquidated';
                    $advance_model->due_date = $model->period;

                    $advance_model->save(false);
                }

                if($model->employee_id != null)
                {
                    $dvlog_model = new DvLog();
                    //$dvlog_model->date = date('Y-m-d g:i a');
                    $dvlog_model->dv_no = $model->dv_no;
                    $dvlog_model->transaction = 'Forward DV to accounting by: ';
                    $dvlog_model->employee_id = $model->employee_id;

                    $dvlog_model->save(false);
                }

                // print_r('Successfully Saved');
                // exit();
                return $this->redirect(['index']);

            } 
            else
            {
                $reference = $reference_no != "null" ? DraftDv::find()->where(['reference_no' =>$reference_no])->one() : null;

                return $this->render('create', [
                    'model' => $model,
                    'dv_no' => $dv_no,
                    'reference' => $reference,
                ]);
            }
        }
        else
        {
            Yii::$app->getSession()->setFlash('warning', 'Sorry, you are not authorized to Create Disbursement Voucher. Please contact your system administrator.');
               return $this->redirect(['index']);
        }
    }

    public function actionRedirected()
    {
        $data = ArrayHelper::map(DraftDv::find()->all(), 'reference_no', 'reference_no');

        if(isset($_POST['selection']))
        {
            if($_POST['selection'] == "1" && $_POST['reference_no'] != '')
            {
                $reference_no = $_POST['reference_no'];

                return $this->redirect(['create', 'reference_no' => $reference_no]);
            }

            elseif($_POST['selection'] == "0")
            {
                //$reference_no = $_POST['reference_no'];

                return $this->redirect(['create', 'reference_no' => 'null']);
            }

            else
            {
                Yii::$app->getSession()->setFlash('warning', 'Please enter Reference No.');

                return $this->render('create-redirected', ['data' => $data]);
            }
        }

        return $this->render('create-redirected', ['data' => $data]);
    }


    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if(\Yii::$app->user->can('updateDisbursementVoucher'))
        {

            if ($model->load(Yii::$app->request->post())) 
            {   
                
                if($model->status == 'Cancelled')
                {
                   $model->obligated = 'no';
                }

                if($model->cash_advance == 'no')
                {
                   //CashAdvance::delete(['dv_no' => $model->dv_no]);
                    \Yii::$app
                    ->db
                    ->createCommand()
                    ->delete('cash_advance', ['dv_no' => $model->dv_no])
                    ->execute();
                }
                
                if (\Yii::$app->user->can('processor'))
                {
                    $model->status = 'Processed';
                }

                if (\Yii::$app->user->can('Verifier'))
                {
                    $model->status = 'Verified';
                }

                $model->gross_amount = str_replace(',', '', $model->gross_amount);
                // var_dump($model->ors);
                // exit();
                $ors = implode('/', $model->ors);
                $model->ors = $ors;

                // var_dump($model->ors);
                // exit();

                $model->payee = strtoupper($model->payee);
                $model->save(false);

                if(($model->period != null) && ($model->period != 0))
                {
                    $advance_model = new CashAdvance();

                    $advance_model->dv_no = $model->dv_no;
                    $advance_model->date = date('Y-m-d');
                    $advance_model->status = 'Unliquidated';
                    $advance_model->due_date = $model->period;

                    $advance_model->save(false);
                }

                //Start of Ativity Log --------------------------------

                $log = new ActivityLog();
                $log->particular = "Made changes on DV No. ".$model->dv_no.' with the following short details: Gross Amount - '.$model->gross_amount.', Net Amount - '.$model->net_amount;
                // $log->date_time = date('m/d/Y h:i');
                $log->user = Yii::$app->user->identity->fullname;
                $log->save(false);

                //End of Ativity Log --------------------------------

                if($model->employee_id != null)
                {
                    $dvlog_model = new DvLog();
                    // $dvlog_model->date = date('Y-m-d g:i a');
                    $dvlog_model->dv_no = $model->dv_no;
                    $dvlog_model->transaction = 'Forward DV to accounting by: ';
                    $dvlog_model->employee_id = $model->employee_id;

                    $dvlog_model->save(false);
                }

                return $this->redirect(['index']);
            }

            return $this->render('update', [
                'model' => $model,
            ]);
            
        }
        else
        {
            Yii::$app->getSession()->setFlash('warning', 'Sorry, you are not authorized to make changes in Disbursement Voucher. Please contact your system administrator.');
               return $this->redirect(['index']);
        }

    }

    public function actionDelete($id)
    {
        if(\Yii::$app->user->can('deleteDisbursementVoucher'))
        {   
            $this->findModel($id)->delete();
            $dv_no = Disbursement::find(['dv_no'])->where(['id'=>$id])->one();
            CashAdvance::delete(['dv_no' => $dv_no->dv_no]);

            //Start of Ativity Log --------------------------------

            $log = new ActivityLog();
            $log->particular = "Delete DV No. ".$dv_no->dv_no.' with the following short details: Gross Amount - '.$dv_no->gross_amount.', Net Amount - '.$dv_no->net_amount;
            $log->date_time = date('m/d/Y h:i');
            $log->user = Yii::$app->user->identity->fullname;
            $log->save(false);

            //End of Ativity Log --------------------------------

            return $this->redirect(['index']);
        }
        else
        {
            Yii::$app->getSession()->setFlash('warning', 'Sorry, you are not authorized to delete Disbursement Voucher. Please contact your system administrator.');
               return $this->redirect(['index']);
        }

    }

    public function actionCash()
    {
        $results = Disbursement::find()->where(['cash_advance'=>'yes'])->all();
        return $this->render('advanceView', [
                'results' => $results,
            ]);
    }

    public function actionPrint($id)
    {
        $dv_no = Disbursement::find()->where(['id'=>$id])->one();
        $transaction = TransactionStatus::find()->where(['dv_no' => $dv_no->dv_no])->one();
        // var_dump($dv_no);
        // exit();
        $transaction1 = explode(',', $transaction->receiving);
        $transaction2 = explode(',', $transaction->processing);
        $transaction3 = explode(',', $transaction->verification);
        $transaction4 = explode(',', $transaction->nca_control);
        $transaction5 = explode(',', $transaction->lddap_ada);
        $transaction6 = explode(',', $transaction->releasing);
        $transaction7 = explode(',', $transaction->indexing);

            $pdf = new Pdf([
                'mode' => Pdf::MODE_CORE, // leaner size using standard fonts
                'format' => Pdf::FORMAT_FOLIO,
                'destination' => Pdf::DEST_BROWSER,
                'content' => $this->renderPartial('view', [
                    'model' => $this->findModel($id), 
                    'transaction1'=>$transaction1, 
                    'transaction2'=>$transaction2,
                    'transaction3'=>$transaction3, 
                    'transaction4'=>$transaction4,
                    'transaction5'=>$transaction5, 
                    'transaction6'=>$transaction6,
                    'transaction7'=>$transaction7
                ]),
                'options' => [
                    'title' => 'View',
                    'filename' => $id,
                    'marginTop' => .25
                ]
            ]);

            return $pdf->render();   
    }

    public function actionReports()
    {
        //$results = Disbursement::find()->where(['cash_advance'=>'yes'])->all();
        return $this->render('indexReport');
    }

    public function actionNca()
    {
        $ncas = Nca::find()->all();

        return $this->render('nca_list', ['ncas' => $ncas]);

    }

    public function actionCashstatus($id)
    {
        $model = $this->findModel($id);
        $nca_model = Nca::find()->where(['fiscal_year' => date('Y')])->andWhere(['region' => Yii::$app->user->identity->region])->all();
        $nca_earmarked = NcaEarmarked::find(['nca_no'])->where(['dv_no' => $model->dv_no])->all();

        if($model->load(Yii::$app->request->post())) 
        {
            if(isset($_POST['nca_id']))
            {
                $nca_id = $_POST['nca_id'];
                $x =0;
                $sum = 0;

                foreach ($nca_id as $value) 
                {
                    if(($model->payment[$value] !== 0.00) && (!empty($model->payment[$value]) && ($model->payment[$value] != '0.00')) && ($model->payment[$value] != null))
                    {
                        $x++;

                        $payment = str_replace(',', '', $model->payment[$value]);
                        $sum += (float)$payment;
                    }

                    if($model->payment[$value] == 'cancelled')
                    {
                        NcaEarmarked::deleteAll(['dv_no' => $model->dv_no, 'nca_no' => $model->nca_no[$value], 'funding_source' => $model->funding_source[$value]]);
                    }
                }

                if(($sum>((float)$model->net_amount)) == true)
                {
                    Yii::$app->getSession()->setFlash('warning', 'Total Earmarked amount cannot be exceeded to the DV Payable Amount');

                    return $this->render('cash-status/_form', [
                    'model' => $model,
                    'nca_model' => $nca_model,
                    ]);
                }

                if(($sum<((float)$model->net_amount)) == true)
                {
                    Yii::$app->getSession()->setFlash('warning', 'Total Earmarked amount cannot be less that the DV Payable Amount');

                    return $this->render('cash-status/_form', [
                    'model' => $model,
                    'nca_model' => $nca_model,
                    ]);
                }

                if($x == sizeof($nca_id))
                {
                    foreach ($nca_id as $index) 
                    {
                        $model_earmarked = NcaEarmarked::find()
                                ->where(['dv_no' => $model->dv_no])
                                ->andWhere(['nca_no' => $model->nca_no[$index]])
                                ->andWhere(['funding_source' => $model->funding_source[$index]])
                                ->one();

                        if($model_earmarked == null)
                        {
                            $model_earmarked = new NcaEarmarked();

                            $model_earmarked->region = Yii::$app->user->identity->region;
                            $model_earmarked->date = date('Y-m-d');
                            $model_earmarked->dv_no = $model->dv_no;
                            $model_earmarked->disbursement_date = $model->date;
                            $model_earmarked->nca_no = $model->nca_no[$index];
                            $model_earmarked->funding_source = $model->funding_source[$index];
                            $model_earmarked->amount = str_replace(',', '', $model->payment[$index]);

                            $model_earmarked->save(false);
                        }

                        else
                        {
                            $model_earmarked->date = date('Y-m-d');
                            $model_earmarked->dv_no = $model->dv_no;
                            $model_earmarked->disbursement_date = $model->date;
                            $model_earmarked->nca_no = $model->nca_no[$index];
                            $model_earmarked->funding_source = $model->funding_source[$index];
                            $model_earmarked->amount = str_replace(',', '', $model->payment[$index]);

                            $model_earmarked->save(false);
                        }
                    }
                    $model->obligated = 'Yes';
                    $model->status = $model->status == "Approved" ? "Approved/Earmarked" : "Earmarked";
                    $model->save(false);

                    if(($model->mode_of_payment == 'lldap_ada') && ($model->status == 'Approved/Earmarked'))
                    {
                        $inbox_model = new Inbox();
                        $inbox_model->dv_no = $model->dv_no;
                        $inbox_model->date = date('Y-m-d');
                        $inbox_model->user_role = 'lddap_ada';
                        $inbox_model->status = 1;
                        $inbox_model->save(false);
                    }

                    //New Remarks ------------------------------------------
                        $model_remarks = DvRemarks::find()
                                ->where(['dv_no' => $model->dv_no])
                                ->andWhere(['user_id' => Yii::$app->user->identity->id])
                                ->one();

                        if($model_remarks == null)
                        {
                            if(!empty($model->remarks))
                            {
                                $model_remarks = new DvRemarks();
                                $model_remarks->dv_no = $model->dv_no;
                                $model_remarks->remarks = $model->remarks;
                                $model_remarks->user_id = Yii::$app->user->identity->id;
                                // $model_remarks->date = date('Y-m-d g:i a');

                                $model_remarks->save(false);
                            }
                        }

                        else
                        {
                            if(!empty($model->remarks))
                            {
                                $model_remarks->remarks = $model->remarks;
                                // $model_remarks->date = date('Y-m-d g:i a');

                                $model_remarks->save(false);
                            }
                            else
                            {
                                $model_remarks->delete();
                            }
                        }
                    //End Remarks ------------------------------------------
                }
                else
                {
                    Yii::$app->getSession()->setFlash('warning', 'Selected NCA cannot be Zero');

                    return $this->render('cash-status/_form', [
                    'model' => $model,
                    'nca_model' => $nca_model,
                    ]);
                }   
            }

            else
            {
                Yii::$app->getSession()->setFlash('warning', 'Please Select NCA');

                return $this->render('cash-status/_form', [
                'model' => $model,
                'nca_model' => $nca_model,
                ]);
            }

            return $this->render('cash-status/view', [
                'model' => $model,
                'nca_model' => $nca_model,
                'nca_earmarked' => $nca_earmarked,
                ]); 
            
        }

        $dv_logs_model = new DvLog();
        //$dv_logs_model->date = date('Y-m-d g:i a');
        $dv_logs_model->dv_no = $model->dv_no;
        $dv_logs_model->transaction = "Received DV.";
        $dv_logs_model->employee_id = $model->getId(Yii::$app->user->identity->id);
        $dv_logs_model->save(false);

        return $this->render('cash-status/_form', [
            'model' => $model,
            'nca_model' => $nca_model,
            ]);

    }

    public function actionDisbursements($id)
    {
        $model = $this->findModel($id);
        $disbursements = Disbursement::find()->where(['nca'=>$model->nca])->andWhere(['obligated' => 'yes'])->all();
        $model3 = Nca::find()->where(['nca_no'=>$model->nca])->one();

        return $this->render('cash-status/obligated', [
                'model' => $model,
                'model3' => $model3,
                'disbursements' => $disbursements,
                ]);
    }

    public function actionMdisbursement()
    {
        $disbursements = Disbursement::find()->all();
    }

    public function actionAda($dv_no)
    {
        $model = new Disbursement();
        $model2 = new LddapAda();
        $disbursement = AccountingEntry::find()->where(['credit_to' => 'payee'])
                        ->andWhere(['mode_of_payment' => 'lldap_ada'])
                        ->joinWith('disbursement')
                        ->all();

        if ($model->load(Yii::$app->request->post()))
        {
            if(isset($_POST['dvs']) != null)
            {
                $dvs = $_POST['dvs'];
                $num_recs = LddapAda::find()->groupBy(['lddap_no'])->all();
                $series = strlen((string) sizeof($num_recs)) === 1 ? '00' : '0';
                $lddap_no = '101'.'-'.date('m').'-'.$series.(sizeof($num_recs)+1).'-'.date('Y');
                return $this->render('/disbursement/lddap/lddap_form', ['dvs' => $dvs, 'lddap_no' => $lddap_no, 'model2' => $model2]);
            }

            else
            {
                Yii::$app->getSession()->setFlash('warning', 'Please Select Disbursement Voucher (DV)');
                return $this->render('/disbursement/lddap/lddapIndex', ['disbursement' => $disbursement, 'dv_no' => $dv_no, 'model' => $model]);
            }
            
        }

        if ($model2->load(Yii::$app->request->post()))
        {
            if(LddapAda::find()->where(['lddap_no' => $model2->lddap_no])->one() == null)
            {
                for($i=0; $i<sizeof($model2->dv_no); $i++)
                {
                    $model3 = new LddapAda();

                    $model3->date = $model2->date;
                    $model3->region = Yii::$app->user->identity->region;
                    $model3->dv_no = $model2->dv_no[$i];
                    $model3->current_account = $model2->current_account[$i];
                    $model3->uacs_code = $model2->uacs_code[$i];
                    $model3->net_amount = $model2->net_amount[$i];
                    $model3->lddap_no = $model2->lddap_no;
                    $model3->certified = $model2->certified;
                    $model3->approved = $model2->approved;
                    $model3->signatory1 = $model2->signatory1;
                    $model3->signatory2 = $model2->signatory2;

                    $model3->save(false);

                    //Start of Ativity Log --------------------------------

                    $log = new ActivityLog();
                    $log->particular = "Generated a LDDAP/ADA Form for DV No. ".$model3->dv_no.', LDDAP/ADA No. '.$model3->lddap_no.', with net amount of '.$model3->net_amount;
                    $log->date_time = date('m/d/Y h:i');
                    $log->user = Yii::$app->user->identity->fullname;
                    $log->save(false);

                    //End of Ativity Log --------------------------------
                }
            }

            $dvs = LddapAda::find()
                    ->where(['lddap_no' => $model2->lddap_no])
                    ->joinWith('dv')
                    ->all();

            $ada = LddapAda::find()
                    ->where(['lddap_no' => $model2->lddap_no])
                    ->joinWith('dv')
                    ->one();

            $certified = explode(';', $ada->certified);
            $approved = explode(';', $ada->approved);
            $signatory1 = explode(';', $ada->signatory1);
            $signatory2 = explode(';', $ada->signatory2);


            $pdf = new Pdf([
                'mode' => Pdf::MODE_CORE, // leaner size using standard fonts
                'format' => Pdf::FORMAT_FOLIO,
                'destination' => Pdf::DEST_BROWSER,
                'content' => $this->renderPartial('/disbursement/lddap/lddap_view', ['dvs' => $dvs, 'certified' => $certified, 'approved' => $approved, 'signatory1' => $signatory1, 'signatory2' => $signatory2]),
                'options' => [
                    'title' => $model2->lddap_no,
                    'filename' => $model2->lddap_no,
                    'marginTop' => .25
                ]
            ]);
            return $pdf->render();
            
        }
        return $this->render('/disbursement/lddap/lddapIndex', ['disbursement' => $disbursement, 'dv_no' => $dv_no, 'model' => $model]);
    }

    public function actionIndexpayment($dv_no)
    {
        $name = Disbursement::find(['payee'])->where(['dv_no' => $dv_no])->one();
        $searchModel = new DisbursementSearch();

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['payee'=>$name->payee]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    protected function findModel($id)
    {
        if (($model = Disbursement::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionClusters($fund_cluster)
    {
        $countClusters = Nca::find()
            ->where(['fund_cluster'=>$fund_cluster])
            ->count();

        $clusters = Nca::find()
            ->where(['fund_cluster'=>$fund_cluster])
            ->all();

        if($countClusters>0)
        {
            foreach($clusters as $cluster)
            {
                 echo "<option value='".$cluster->nca_no."'>".$cluster->nca_no."</option>";
            }
        }
        else
            {
                echo "<option> - </option>";
            }
    }

    public function actionSources($nca_no)
    {
        $countSources  = Nca::find()
            ->where(['nca_no'=>$nca_no])
            ->count();

        $sources = Nca::find()
            ->where(['nca_no'=>$nca_no])
            ->all();

        if($countSources >0)
        {
            foreach($sources as $source)
            {
                 echo "<option value='".$source->funding_source."'>".$source->funding_source."</option>";
            }
        }
        else
            {
                echo "<option> - </option>";
            }
    }
}
?>