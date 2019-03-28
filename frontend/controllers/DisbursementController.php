<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Disbursement;
use frontend\models\DisbursementSearch;
use frontend\models\TransactionStatus;
use backend\models\DvLog;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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

    public function actionSearch()
    {
        if(isset($_POST['dv_no']))
        {
            $dv_no = $_POST['dv_no'];
            $result = Disbursement::find()->where(['dv_no' => $dv_no])->one();

            if($result !== null)
            {
                return $this->redirect(['disbursement/view', 'id' => $result->id]); 
            }

            else
            {
                Yii::$app->getSession()->setFlash('warning', 'No Results Found');   
                return $this->render('_search');
            }
            
        }
        return $this->render('_search');
    }

    /**
     * Displays a single Disbursement model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $dv_no = Disbursement::find()->where(['id'=>$id])->one();
        $transaction = TransactionStatus::find()->where(['dv_no' => $dv_no->dv_no])->one();
        $dv_log = DvLog::find()->where(['dv_no' => $dv_no->dv_no])->all();
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
            'dv_log' => $dv_log
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
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
