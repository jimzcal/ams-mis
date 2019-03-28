<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\LoginForm;
use backend\models\User;
use backend\models\Disbursement;
use backend\models\DvLog;
use yii\data\ActiveDataProvider;
use backend\models\TransactionStatus;
use backend\models\AccountingEntry;
use backend\models\Ors;
use backend\models\OrsRegistry;
use backend\models\Inbox;
use yii\helpers\Html;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'view', 'control', 'inbox'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        if(\Yii::$app->user->can('client'))
        {
            Yii::$app->session->destroy();
            Yii::$app->getSession()->setFlash('warning', 'ACCESS DENIED - Please contact the Accounting Head to enable your account from accessing the system');

            return $this->redirect(['/user/login']);
        }

        if(isset($_POST['dv_no']))
        {
            $dv_no = $_POST['dv_no'];
            $id = Disbursement::find(['id'])->where(['dv_no'=>$dv_no])->one();
            //$result = Disbursement::find()->where(['dv_no'=>$dv_no])->one();
            if($id != null)
            {
                if(\Yii::$app->user->identity->isAdmin)
                {
                    $status = TransactionStatus::find(['approval'])->where(['dv_no'=>$dv_no])->one();
                    $disbursement = Disbursement::find()->where(['dv_no' => $dv_no])->one();
                    if(empty($status->approval))
                    {
                        $detail = Yii::$app->user->identity->fullname.','.date('m/d/Y h:i');
                        Yii::$app->db->createCommand()->update('transaction_status', ['approval' => $detail], ['dv_no' => $dv_no])->execute();

                        $inbox = Inbox::find()->where(['dv_no' => $dv_no])
                                ->andWhere(['user_role' => 'admin'])->one(); 
                        if($inbox != null)
                        {
                            $inbox->status = 0;
                            $inbox->save(false);
                        }

                        return $this->redirect(['/disbursement/processor', 'id' => $disbursement->id]);
                    }
                    else
                    {
                        $stat = explode(',', $status->approval);
                        $detail = $stat[0].','.$stat[(sizeof($stat)-1)].'-'.date('m/d/Y h:i');

                        Yii::$app->db->createCommand()->update('transaction_status', ['approval' => $detail], ['dv_no' => $dv_no])->execute();

                        $inbox = Inbox::find()->where(['dv_no' => $dv_no])
                                ->andWhere(['user_role' => 'admin'])->one(); 
                        if($inbox != null)
                        {
                            $inbox->status = 0;
                            $inbox->save(false);
                        }

                         return $this->redirect(['/disbursement/processor', 'id' => $id->id]);
                    }   
                }
                
                if (\Yii::$app->user->can('receiver'))
                {
                    $status = TransactionStatus::find()->where(['dv_no'=>$dv_no])->one();
                    $stat = explode(',', $status->receiving);
                    $detail = $stat[0].','.$stat[(sizeof($stat)-1)].'-'.date('m/d/Y h:i');

                    Yii::$app->db->createCommand()->update('transaction_status', ['receiving' => $detail], ['dv_no' => $dv_no])->execute();

                    return $this->redirect(['/disbursement/view', 'id' => $id->id]);
                }

                if (\Yii::$app->user->can('processor'))
                {
                    $status = TransactionStatus::find(['processing'])->where(['dv_no'=>$dv_no])->one();
                    if(empty($status->processing))
                    {
                        $detail = Yii::$app->user->identity->fullname.','.date('m/d/Y h:i');
                        Yii::$app->db->createCommand()->update('transaction_status', ['processing' => $detail], ['dv_no' => $dv_no])->execute();

                        $inbox = Inbox::find()->where(['dv_no' => $dv_no])
                                ->andWhere(['user_role' => 'processor'])->one(); 
                        if($inbox != null)
                        {
                            $inbox->status = 0;
                            $inbox->save(false);
                        }

                        return $this->redirect(['/disbursement/processor', 'id' => $id->id]);
                    }
                    else
                    {
                        $stat = explode(',', $status->processing);
                        $detail = $stat[0].','.$stat[(sizeof($stat)-1)].'-'.date('m/d/Y h:i');

                        Yii::$app->db->createCommand()->update('transaction_status', ['processing' => $detail], ['dv_no' => $dv_no])->execute();
                        $inbox = Inbox::find()->where(['dv_no' => $dv_no])
                                ->andWhere(['user_role' => 'processor'])->one(); 
                        if($inbox != null)
                        {
                            $inbox->status = 0;
                            $inbox->save(false);
                        }

                         return $this->redirect(['/disbursement/processor', 'id' => $id->id]);
                    }   
                }

                if (\Yii::$app->user->can('Verifier'))
                {
                    $status = TransactionStatus::find(['verification'])->where(['dv_no'=>$dv_no])->one();
                    if(empty($status->verification))
                    {
                        $detail = Yii::$app->user->identity->fullname.','.date('m/d/Y h:i');
                        Yii::$app->db->createCommand()->update('transaction_status', ['verification' => $detail], ['dv_no' => $dv_no])->execute();

                        $inbox = Inbox::find()->where(['dv_no' => $dv_no])
                                ->andWhere(['user_role' => 'verifier'])->one(); 
                        if($inbox != null)
                        {
                            $inbox->status = 0;
                            $inbox->save(false);
                        }

                        return $this->redirect(['/disbursement/processor', 'id' => $id->id]);
                    }
                    else
                    {
                        $stat = explode(',', $status->verification);
                        $detail = $stat[0].','.$stat[(sizeof($stat)-1)].'-'.date('m/d/Y h:i');

                        Yii::$app->db->createCommand()->update('transaction_status', ['verification' => $detail], ['dv_no' => $dv_no])->execute();

                        $inbox = Inbox::find()->where(['dv_no' => $dv_no])
                                ->andWhere(['user_role' => 'verifier'])->one(); 
                        if($inbox != null)
                        {
                            $inbox->status = 0;
                            $inbox->save(false);
                        }

                         return $this->redirect(['/disbursement/processor', 'id' => $id->id]);
                    }   
                }

                if (\Yii::$app->user->can('NCA_Controller'))
                {
                    $status = TransactionStatus::find(['nca_control'])->where(['dv_no'=>$dv_no])->one();
                    $disbursement = Disbursement::find()->where(['dv_no' => $dv_no])->one();
                    if(empty($status->nca_control))
                    {
                        $detail = Yii::$app->user->identity->fullname.','.date('m/d/Y h:i');
                        Yii::$app->db->createCommand()->update('transaction_status', ['nca_control' => $detail], ['dv_no' => $dv_no])->execute();

                        $inbox = Inbox::find()->where(['dv_no' => $dv_no])
                                ->andWhere(['user_role' => 'nca_controller'])->one(); 
                       if($inbox != null)
                        {
                            $inbox->status = 0;
                            $inbox->save(false);
                        }

                        return $this->redirect(['/disbursement/cashstatus', 'id' => $disbursement->id]);
                    }
                    else
                    {
                        $stat = explode(',', $status->nca_control);
                        $detail = $stat[0].','.$stat[(sizeof($stat)-1)].'-'.date('m/d/Y h:i');

                        Yii::$app->db->createCommand()->update('transaction_status', ['nca_control' => $detail], ['dv_no' => $dv_no])->execute();

                        $inbox = Inbox::find()->where(['dv_no' => $dv_no])
                                ->andWhere(['user_role' => 'nca_controller'])->one(); 
                        if($inbox != null)
                        {
                            $inbox->status = 0;
                            $inbox->save(false);
                        }

                         return $this->redirect(['/disbursement/cashstatus', 'id' => $id->id]);
                    }   
                }

                if (\Yii::$app->user->can('indexer'))
                {
                    $status = TransactionStatus::find(['indexing'])->where(['dv_no'=>$dv_no])->one();
                    $disbursement = Disbursement::find()->where(['dv_no' => $dv_no])->all();
                        
                    if(empty($status->indexing))
                    {
                        $detail = Yii::$app->user->identity->fullname.','.date('m/d/Y h:i');
                        Yii::$app->db->createCommand()->update('transaction_status', ['indexing' => $detail], ['dv_no' => $dv_no])->execute();

                        Yii::$app->getSession()->setFlash('success', 'DV No. '.$dv_no.' has been received');


                        return $this->redirect(['/disbursement/indexpayment', 'dv_no' => $dv_no]);
                    }
                    else
                    {
                        $stat = explode(',', $status->indexing);
                        $detail = $stat[0].','.$stat[(sizeof($stat)-1)].'-'.date('m/d/Y h:i');

                        Yii::$app->db->createCommand()->update('transaction_status', ['indexing' => $detail], ['dv_no' => $dv_no])->execute();

                         return $this->redirect(['/disbursement/indexpayment', 'dv_no' => $dv_no]);
                    }
                }

                if (\Yii::$app->user->can('lddap_ada'))
                {
                    $status = TransactionStatus::find(['lddap_ada'])->where(['dv_no'=>$dv_no])->one();
                    $disbursement = Disbursement::find()->where(['dv_no' => $dv_no])->all();
                        
                    if(empty($status->lddap_ada))
                    {
                        $detail = Yii::$app->user->identity->fullname.','.date('m/d/Y h:i');
                        Yii::$app->db->createCommand()->update('transaction_status', ['lddap_ada' => $detail], ['dv_no' => $dv_no])->execute();

                        $inbox = Inbox::find()->where(['dv_no' => $dv_no])
                                ->andWhere(['user_role' => 'lddap_ada'])->one(); 
                        if($inbox != null)
                        {
                            $inbox->status = 0;
                            $inbox->save(false);
                        }


                        Yii::$app->getSession()->setFlash('success', 'DV No. '.$dv_no.' has been received');
                        return $this->redirect(['/disbursement/ada', 'dv_no' => $dv_no]);
                    }
                    else
                    {
                        $stat = explode(',', $status->lddap_ada);
                        $detail = $stat[0].','.$stat[(sizeof($stat)-1)].'-'.date('m/d/Y h:i');

                        Yii::$app->db->createCommand()->update('transaction_status', ['lddap_ada' => $detail], ['dv_no' => $dv_no])->execute();

                        $inbox = Inbox::find()->where(['dv_no' => $dv_no])
                                ->andWhere(['user_role' => 'lddap_ada'])->one(); 
                        if($inbox != null)
                        {
                            $inbox->status = 0;
                            $inbox->save(false);
                        }

                         return $this->redirect(['/disbursement/ada', 'dv_no' => $dv_no]);
                    }
                }

                if (\Yii::$app->user->can('releaser'))
                {
                    $status = TransactionStatus::find()->where(['dv_no'=>$dv_no])->one();
                    $disbursement = Disbursement::find()->where(['dv_no' => $dv_no])->all();

                    if(empty($status->releasing))
                    {
                        $detail = Yii::$app->user->identity->fullname.','.date('m/d/Y h:i');
                    }

                    if(!empty($status->releasing))
                    {
                        $stat = explode(',', $status->releasing);
                        $detail = $stat[0].','.$stat[(sizeof($stat)-1)].'-'.date('m/d/Y h:i');
                    }

                    Yii::$app->db->createCommand()->update('transaction_status', ['releasing' => $detail], ['dv_no' => $dv_no])->execute();
                    Yii::$app->getSession()->setFlash('success', 'DV No. '.$dv_no.' has been received');

                    $inbox = Inbox::find()->where(['dv_no' => $dv_no])
                                ->andWhere(['user_role' => 'releaser'])->one(); 
                        if($inbox != null)
                        {
                            $inbox->status = 0;
                            $inbox->save(false);
                        }

                    return $this->redirect(['/disbursement/view', 'id' => $id->id]);
                }

                if (\Yii::$app->user->can('bookkeeper'))
                {
                    $ors = OrsRegistry::find()->where(['dv_no' => $dv_no])->all();

                    if($ors == null)
                    {

                        return $this->redirect(['/ors-registry/create', 'dv_no' => $dv_no]);
                    }

                    if($ors !== null)
                    {

                        return $this->redirect(['/ors-registry/update', 'dv_no' => $dv_no]);
                    }
                }

            }
            else
            {
                Yii::$app->getSession()->setFlash('info', 'No Results Found');
                return $this->render('index');
            }
        }

        return $this->render('index');
    }

    public function actionInbox($dv_no)
    {
        if($dv_no != null)
        {
            // $dv_no = $dv_no;
            $id = Disbursement::find(['id'])->where(['dv_no'=>$dv_no])->one();
            //$result = Disbursement::find()->where(['dv_no'=>$dv_no])->one();
            if($id != null)
            {
                if(\Yii::$app->user->identity->isAdmin)
                {
                    $status = TransactionStatus::find(['approval'])->where(['dv_no'=>$dv_no])->one();
                    $disbursement = Disbursement::find()->where(['dv_no' => $dv_no])->one();

                    if(empty($status->approval))
                    {
                        $detail = Yii::$app->user->identity->fullname.','.date('m/d/Y h:i');
                        Yii::$app->db->createCommand()->update('transaction_status', ['approval' => $detail], ['dv_no' => $dv_no])->execute();

                        $inbox = Inbox::find()->where(['dv_no' => $dv_no])
                                ->andWhere(['user_role' => 'admin'])->one(); 
                        if($inbox != null)
                        {
                            $inbox->status = 0;
                            $inbox->save(false);
                        }

                        return $this->redirect(['/disbursement/main', 'id' => $disbursement->id]);
                    }
                    else
                    {
                        $stat = explode(',', $status->approval);
                        $detail = $stat[0].','.$stat[(sizeof($stat)-1)].'-'.date('m/d/Y h:i');

                        Yii::$app->db->createCommand()->update('transaction_status', ['approval' => $detail], ['dv_no' => $dv_no])->execute();

                        $inbox = Inbox::find()->where(['dv_no' => $dv_no])
                                ->andWhere(['user_role' => 'admin'])->one();
                        if($inbox != null)
                        {
                            $inbox->status = 0;
                            $inbox->save(false);
                        }
                        

                         return $this->redirect(['/disbursement/main', 'id' => $id->id]);
                    }   
                }
                
                if (\Yii::$app->user->can('receiver'))
                {
                    $status = TransactionStatus::find()->where(['dv_no'=>$dv_no])->one();
                    $stat = explode(',', $status->receiving);
                    $detail = $stat[0].','.$stat[(sizeof($stat)-1)].'-'.date('m/d/Y h:i');

                    Yii::$app->db->createCommand()->update('transaction_status', ['receiving' => $detail], ['dv_no' => $dv_no])->execute();

                    $inbox = Inbox::find()->where(['dv_no' => $dv_no])
                                ->andWhere(['user_role' => 'processor'])->one(); 
                    if($inbox != null)
                    {
                        $inbox->status = 0;
                        $inbox->save(false);
                    }

                    return $this->redirect(['/disbursement/view', 'id' => $id->id]);
                }

                if (\Yii::$app->user->can('processor'))
                {
                    $status = TransactionStatus::find(['processing'])->where(['dv_no'=>$dv_no])->one();
                    if(empty($status->processing))
                    {
                        $detail = Yii::$app->user->identity->fullname.','.date('m/d/Y h:i');
                        Yii::$app->db->createCommand()->update('transaction_status', ['processing' => $detail], ['dv_no' => $dv_no])->execute();

                        $inbox = Inbox::find()->where(['dv_no' => $dv_no])
                                ->andWhere(['user_role' => 'processor'])->one(); 
                        if($inbox != null)
                        {
                            $inbox->status = 0;
                            $inbox->save(false);
                        }

                        return $this->redirect(['/disbursement/processor', 'id' => $id->id]);
                    }
                    else
                    {
                        $stat = explode(',', $status->processing);
                        $detail = $stat[0].','.$stat[(sizeof($stat)-1)].'-'.date('m/d/Y h:i');

                        Yii::$app->db->createCommand()->update('transaction_status', ['processing' => $detail], ['dv_no' => $dv_no])->execute();

                        $inbox = Inbox::find()->where(['dv_no' => $dv_no])
                                ->andWhere(['user_role' => 'processor'])->one(); 
                        if($inbox != null)
                        {
                            $inbox->status = 0;
                            $inbox->save(false);
                        }
                         return $this->redirect(['/disbursement/processor', 'id' => $id->id]);
                    } 

                }

                if (\Yii::$app->user->can('Verifier'))
                {
                    $status = TransactionStatus::find(['verification'])->where(['dv_no'=>$dv_no])->one();
                    if(empty($status->verification))
                    {
                        $detail = Yii::$app->user->identity->fullname.','.date('m/d/Y h:i');
                        Yii::$app->db->createCommand()->update('transaction_status', ['verification' => $detail], ['dv_no' => $dv_no])->execute();

                        $inbox = Inbox::find()->where(['dv_no' => $dv_no])
                                ->andWhere(['user_role' => 'Verifier'])->one(); 
                        if($inbox != null)
                        {
                            $inbox->status = 0;
                            $inbox->save(false);
                        }

                        return $this->redirect(['/disbursement/processor', 'id' => $id->id]);
                    }
                    else
                    {
                        $stat = explode(',', $status->verification);
                        $detail = $stat[0].','.$stat[(sizeof($stat)-1)].'-'.date('m/d/Y h:i');

                        Yii::$app->db->createCommand()->update('transaction_status', ['verification' => $detail], ['dv_no' => $dv_no])->execute();

                        $inbox = Inbox::find()->where(['dv_no' => $dv_no])
                                ->andWhere(['user_role' => 'Verifier'])->one(); 
                        if($inbox != null)
                        {
                            $inbox->status = 0;
                            $inbox->save(false);
                        }

                         return $this->redirect(['/disbursement/processor', 'id' => $id->id]);
                    }   
                }

                if (\Yii::$app->user->can('NCA_Controller'))
                {
                    $status = TransactionStatus::find(['nca_control'])->where(['dv_no'=>$dv_no])->one();
                    $disbursement = Disbursement::find()->where(['dv_no' => $dv_no])->one();
                    if(empty($status->nca_control))
                    {
                        $detail = Yii::$app->user->identity->fullname.','.date('m/d/Y h:i');
                        Yii::$app->db->createCommand()->update('transaction_status', ['nca_control' => $detail], ['dv_no' => $dv_no])->execute();

                        $inbox = Inbox::find()->where(['dv_no' => $dv_no])
                                ->andWhere(['user_role' => 'nca_controller'])->one(); 
                        if($inbox != null)
                        {
                            $inbox->status = 0;
                            $inbox->save(false);
                        }

                        return $this->redirect(['/disbursement/cashstatus', 'id' => $disbursement->id]);
                    }
                    else
                    {
                        $stat = explode(',', $status->nca_control);
                        $detail = $stat[0].','.$stat[(sizeof($stat)-1)].'-'.date('m/d/Y h:i');

                        Yii::$app->db->createCommand()->update('transaction_status', ['nca_control' => $detail], ['dv_no' => $dv_no])->execute();

                        $inbox = Inbox::find()->where(['dv_no' => $dv_no])
                                ->andWhere(['user_role' => 'nca_controller'])->one(); 
                        if($inbox != null)
                        {
                            $inbox->status = 0;
                            $inbox->save(false);
                        }

                         return $this->redirect(['/disbursement/cashstatus', 'id' => $id->id]);
                    }   
                }

                if (\Yii::$app->user->can('indexer'))
                {
                    $status = TransactionStatus::find(['indexing'])->where(['dv_no'=>$dv_no])->one();
                    $disbursement = Disbursement::find()->where(['dv_no' => $dv_no])->all();
                        
                    if(empty($status->indexing))
                    {
                        $detail = Yii::$app->user->identity->fullname.','.date('m/d/Y h:i');
                        Yii::$app->db->createCommand()->update('transaction_status', ['indexing' => $detail], ['dv_no' => $dv_no])->execute();

                        Yii::$app->getSession()->setFlash('success', 'DV No. '.$dv_no.' has been received');
                        return $this->redirect(['/disbursement/indexpayment', 'dv_no' => $dv_no]);
                    }
                    else
                    {
                        $stat = explode(',', $status->indexing);
                        $detail = $stat[0].','.$stat[(sizeof($stat)-1)].'-'.date('m/d/Y h:i');

                        Yii::$app->db->createCommand()->update('transaction_status', ['indexing' => $detail], ['dv_no' => $dv_no])->execute();

                         return $this->redirect(['/disbursement/indexpayment', 'dv_no' => $dv_no]);
                    }
                }

                if (\Yii::$app->user->can('lddap_ada'))
                {
                    $status = TransactionStatus::find(['lddap_ada'])->where(['dv_no'=>$dv_no])->one();
                    $disbursement = Disbursement::find()->where(['dv_no' => $dv_no])->all();
                        
                    if(empty($status->lddap_ada))
                    {
                        $detail = Yii::$app->user->identity->fullname.','.date('m/d/Y h:i');
                        Yii::$app->db->createCommand()->update('transaction_status', ['lddap_ada' => $detail], ['dv_no' => $dv_no])->execute();

                        $inbox = Inbox::find()->where(['dv_no' => $dv_no])
                                ->andWhere(['user_role' => 'lddap_ada'])->one(); 
                        if($inbox != null)
                        {
                            $inbox->status = 0;
                            $inbox->save(false);
                        }

                        Yii::$app->getSession()->setFlash('success', 'DV No. '.$dv_no.' has been received');
                        return $this->redirect(['/disbursement/ada', 'dv_no' => $dv_no]);
                    }
                    else
                    {
                        $stat = explode(',', $status->lddap_ada);
                        $detail = $stat[0].','.$stat[(sizeof($stat)-1)].'-'.date('m/d/Y h:i');

                        Yii::$app->db->createCommand()->update('transaction_status', ['lddap_ada' => $detail], ['dv_no' => $dv_no])->execute();

                        $inbox = Inbox::find()->where(['dv_no' => $dv_no])
                                ->andWhere(['user_role' => 'lddap_ada'])->one(); 
                        if($inbox != null)
                        {
                            $inbox->status = 0;
                            $inbox->save(false);
                        }

                         return $this->redirect(['/disbursement/ada', 'dv_no' => $dv_no]);
                    }
                }

                if (\Yii::$app->user->can('releaser'))
                {
                    $status = TransactionStatus::find()->where(['dv_no'=>$dv_no])->one();
                    $disbursement = Disbursement::find()->where(['dv_no' => $dv_no])->all();

                    if(empty($status->releasing))
                    {
                        $detail = Yii::$app->user->identity->fullname.','.date('m/d/Y h:i');
                    }

                    if(!empty($status->releasing))
                    {
                        $stat = explode(',', $status->releasing);
                        $detail = $stat[0].','.$stat[(sizeof($stat)-1)].'-'.date('m/d/Y h:i');
                    }

                    Yii::$app->db->createCommand()->update('transaction_status', ['releasing' => $detail], ['dv_no' => $dv_no])->execute();
                    Yii::$app->getSession()->setFlash('success', 'DV No. '.$dv_no.' has been received');

                    $inbox = Inbox::find()->where(['dv_no' => $dv_no])
                                ->andWhere(['user_role' => 'releaser'])->one(); 
                    if($inbox != null)
                    {
                        $inbox->status = 0;
                        $inbox->save(false);
                    }

                    return $this->redirect(['/disbursement/view', 'id' => $id->id]);
                }

                if (\Yii::$app->user->can('bookkeeper'))
                {
                    $ors = OrsRegistry::find()->where(['dv_no' => $dv_no])->all();

                    if($ors == null)
                    {
                        // var_dump($model_registry);
                        // exit();
                        return $this->redirect(['/ors-registry/create', 'dv_no' => $dv_no]);
                    }

                    if($ors !== null)
                    {
                        return $this->redirect(['/ors-registry/update', 'dv_no' => $dv_no]);
                    }
                }
            }
            else
            {
                Yii::$app->getSession()->setFlash('info', 'No Results Found');
                return $this->render('index');
            }

             $dv_logs_model = new DvLog();
           // $dv_logs_model->date = date('Y-m-d g:i a');
            $dv_logs_model->dv_no = $model->dv_no;
            $dv_logs_model->transaction = "Received DV.";
            $dv_logs_model->employee_id = Yii::$app->user->identity->id;
            $dv_logs_model->save(false);    
        }

        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionControl()
    {
        
        return $this->render('controlPanel', [

        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
