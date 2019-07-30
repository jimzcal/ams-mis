<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use backend\models\GeneralLedgers;
use backend\models\JournalEntry;
use yii\helpers\ArrayHelper;
use backend\models\Accounts;
use backend\models\LoanEntry;
use backend\models\MembersProfile;
use dektrium\user\models\user;
use backend\models\SubLedgerAccounts;

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
                        'actions' => ['logout', 'index', 'view', 'control', 'inbox', 'reportindex', 'incomelosssummary',
                        'generalledger', 'generaljournal', 'trialbalance', 'scheduleaccount'
                        ],
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
        $model = new GeneralLedgers();
        $loans = new LoanEntry();
        $members = new MembersProfile();
        $users = new User();

        return $this->render('index', ['model' => $model, 'loans' => $loans, 'members' => $members, 'users' => $users]);
    }

    public function actionReportindex()
    {
        $model = new GeneralLedgers();

        return $this->render('report_index', ['model' => $model]);
    }

    public function actionIncomelosssummary()
    {
        $model = new Disbursement();


        if ($model->load(Yii::$app->request->post())) 
        {

            return $this->render('summary_report');
        }

        return $this->render('income_loss_summary', ['model' => $model]);
    }

    public function actionGeneralledger()
    {
        $model = new GeneralLedgers();

        if ($model->load(Yii::$app->request->post())) 
        {
            $dataProvider = GeneralLedgers::find()
                            ->where(['between', 'date_transaction', $model->date_from, $model->date_to])
                            // ->orWhere(['<=', 'date_transaction', $model->date_to])
                            ->andWhere(['account_code' => $model->account_code])
                            //->orderBy(['date_transaction' => SORT_ASC])
                            ->all();

            //  var_dump($dataProvider);
            // exit();

            if($dataProvider == null)
            {
                Yii::$app->getSession()->setFlash('warning', 'No record found between the given period.');
                return $this->render('general_ledger',
                [
                    'model' => $model,
                ]);
            }

            return $this->render('_general_ledgerReport', 
            [
                'dataProvider' => $dataProvider,
                'model' => $model,
                //'account_code' => $model->account_code,
                // 'credit' => $credit,
            ]);
        }

        return $this->render('general_ledger', ['model' => $model]);
    }

    public function actionScheduleaccount()
    {
        $model = new GeneralLedgers();

        if ($model->load(Yii::$app->request->post())) 
        {
            $dataProvider = SubLedgerAccounts::find()
                            ->where(['mother_account' => $model->account_code])
                            //->andWhere(['status' => 'Approved'])
                            //->orderBy(['date_transaction' => SORT_ASC])
                            ->all();

            //  var_dump($dataProvider);
            // exit();

            if($dataProvider == null)
            {
                Yii::$app->getSession()->setFlash('warning', 'No Subsidiary Ledger found under this account');
                return $this->redirect(['scheduleaccount']);
            }

            return $this->render('_scheduleAccount', 
            [
                'dataProvider' => $dataProvider,
                'model' => $model,
                //'account_code' => $model->account_code,
                // 'credit' => $credit,
            ]);
        }

        return $this->render('schedule_account', ['model' => $model]);
    }

    public function actionTrialbalance()
    {
        $model = new Accounts();

        if ($model->load(Yii::$app->request->post())) 
        {
            $dataProvider = Accounts::find()
                            ->where(['status' => 'Active'])
                            ->orderBy(['account_code' => SORT_ASC])
                            ->all();

            if($dataProvider == null)
            {
                Yii::$app->getSession()->setFlash('warning', 'No record found between the given period.');
                return $this->render('trial_balance',
                [
                    'model' => $model,
                ]);
            }

            return $this->render('_trial-balance', 
            [
                'dataProvider' => $dataProvider,
                'model' => $model,
            ]);
        }

        return $this->render('trial_balance', ['model' => $model]);
    }

    public function actionGeneraljournal()
    {
        $model = new JournalEntry();

        if ($model->load(Yii::$app->request->post())) 
        {

            $dataProvider = JournalEntry::find()
                            ->where(['between', 'date_transaction', $model->date_from, $model->date_to])
                            ->andWhere(['status' => 'Approved'])
                            ->groupBy(['jev_no'])
                            ->orderBy(['date_transaction' => SORT_ASC])
                            ->all();

            return $this->render('_general-journalReport', 
            [
                'dataProvider' => $dataProvider,
                'date_month' => $model->date_transaction,
                'date_from' => $model->date_from,
                'date_to' => $model->date_to,
            ]);
        }

        return $this->render('general_journal', ['model' => $model]);
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
