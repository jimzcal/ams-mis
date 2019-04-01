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
            $dv = Disbursement::find(['id'])->where(['dv_no'=>$dv_no])->one();
            //$result = Disbursement::find()->where(['dv_no'=>$dv_no])->one();
            if($dv != null)
            {
                if (\Yii::$app->user->can('receiver'))
                {
                    return $this->redirect(['disbursement/view', 'id' => $dv->id]);
                }

                if(\Yii::$app->user->identity->isAdmin)
                {
                    $check_data = TransactionStatus::find()->where(['dv_no' => $dv_no])
                                    ->andWhere(['process' => 'Verifying'])
                                    ->one();

                    $model = $check_data == null ? new TransactionStatus() : $check_data;

                    $model->dv_no = $dv_no;
                    $model->date = date('Y-m-d');
                    $model->process = 'Verifying';
                    $model->employee = Yii::$app->user->identity->fullname;

                    $model->save(false);

                    return $this->redirect(['disbursement/processing', 'id' => $dv->id]);
                }

                if (\Yii::$app->user->can('processor'))
                {
                    $check_data = TransactionStatus::find()->where(['dv_no' => $dv_no])
                                    ->andWhere(['process' => 'Verifying'])
                                    ->one();

                    $model = $check_data == null ? new TransactionStatus() : $check_data;

                    $model->dv_no = $dv_no;
                    $model->date = date('Y-m-d');
                    $model->process = 'Verifying';
                    $model->employee = Yii::$app->user->identity->fullname;

                    $model->save(false);
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
