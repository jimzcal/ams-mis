<?php

namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use backend\models\Disbursement;
use backend\models\DisbursementSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Transaction;
use backend\models\DvRemarks;
use backend\models\TransactionStatus;

/**
 * DisbursementController implements the CRUD actions for Disbursement model.
 */
class DisbursementController extends Controller
{
    /**
     * {@inheritdoc}
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
                        'actions' => ['index', 'create', 'view', 'delete', 'update', 'processing', 'logsheet'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
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
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = Disbursement::find()->where(['id' => $id])->one();

        $dv_attachments = explode('*', $model->attachments);
        $requirements = Transaction::find()->where(['id' => $model->transaction])->one();
        $required = explode('*', $requirements->requirements);
        $lacking = array_diff($required, $dv_attachments);

        $remarks = DvRemarks::find()->where(['dv_no' => $model->dv_no])
                                    ->all();

        return $this->render('view', [
            'model' => $model,
            'dv_attachments' => $dv_attachments,
            'lacking' => $lacking,
            'remarks' => $remarks,
        ]);
    }

    /**
     * Creates a new Disbursement model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Disbursement();

        if ($model->load(Yii::$app->request->post()))
        {
            $transaction_model = new TransactionStatus();

            $transaction_model->region = Yii::$app->user->identity->region;
            $transaction_model->dv_no = $model->dv_no;
            $transaction_model->process = 'Receiving';
            $transaction_model->employee = Yii::$app->user->identity->fullname;
            $transaction_model->save(false);

            $model->payee = strtoupper($model->payee);
            $model->save(false);

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Disbursement model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()))
        {
            $model->payee = strtoupper($model->payee);
            $model->save(false);

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Disbursement model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionProcessing($id)
    {
        $model = $this->findModel($id);

        $remarks = DvRemarks::find()->where(['dv_no' => $model->dv_no])->all();

        $check_remark = DvRemarks::find()->where(['employee_id' => Yii::$app->user->identity->id])
                                    ->andWhere(['dv_no' => $model->dv_no])
                                    ->one();

        $attachments = explode('*', $model->attachments);
        $requirements = Transaction::find()->where(['id' => $model->transaction])->one();
        $documents = explode("*", $requirements->requirements);

        $lacking = array_diff($documents, $attachments);

        if ($model->load(Yii::$app->request->post()))
        {
            $model->attachments = isset($_POST['requirements']) == false ? '' : implode('*', $_POST['requirements']);
            $model->save(false);

            $remark_model = $check_remark == null ? new DvRemarks() : $check_remark;

            if($model->remarks == null && $check_remark != null)
            {
                $check_remark->delete();
            }

            if($model->remarks != null)
            {
                $remark_model->remarks = $model->remarks;
                $remark_model->dv_no = $model->dv_no;
                $remark_model->employee_id = Yii::$app->user->identity->id;
                $remark_model->save(false);
            }

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('processing', [
            'model' => $model,
            'remarks' => $remarks,
            'check_remark' => $check_remark,
            'attachments' => $attachments,
            'lacking' => $lacking,
        ]);
    }

    public function actionLogsheet()
    {
        $model = new Disbursement();

        if ($model->load(Yii::$app->request->post()))
        {
            $data = Disbursement::find()->where(['fund_cluster' => $model->fund_cluster])
                                    ->andWhere(['between', 'date', $model->date_from, $model->date_to])
                                    ->all();

            return $this->render('report', [
            'model' => $model,
            'data' => $data,
        ]);
        }

        return $this->render('logsheetIndex', [
            'model' => $model,
        ]);
    }

    /**
     * Finds the Disbursement model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Disbursement the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Disbursement::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
