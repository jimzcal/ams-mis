<?php

namespace backend\controllers;

use Yii;
use backend\models\PurchaseOrder;
use backend\models\PurchaseOrderSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\DisbursedPo;
use yii\helpers\ArrayHelper;

/**
 * PurchaseOrderController implements the CRUD actions for PurchaseOrder model.
 */
class PurchaseOrderController extends Controller
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
     * Lists all PurchaseOrder models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PurchaseOrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $model = new PurchaseOrder();

        if ($model->load(Yii::$app->request->post()))
        {
            $model->supplier = strtoupper($model->supplier);
            $model->save(false);
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
    }

    /**
     * Displays a single PurchaseOrder model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new PurchaseOrder model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PurchaseOrder();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing PurchaseOrder model.
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
            $model->supplier = strtoupper($model->supplier);
            $model->save(false);
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing PurchaseOrder model.
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

    public function actionDisburse($id)
    {
        $model = $this->findModel($id);
        $new_model = new DisbursedPo();

        if ($new_model->load(Yii::$app->request->post())) 
        {
            $new_model->save();

            $total_disbursed = array_sum(ArrayHelper::getColumn(DisbursedPo::find()
                            ->where(['po_no' => $model->po_no])
                            ->all(), 'amount'));

            if(($total_disbursed == $model->total_amount) || ($total_disbursed > $model->total_amount))
            {
                $model->status = 'Paid';
                $model->save(false);
            }

            Yii::$app->getSession()->setFlash('success', 'Successfully disbursed amount for P.O. No. '.$model->po_no);

            return $this->redirect(['index']);
        }

        return $this->render('disburse', [
            'model' => $model,
            'new_model' => $new_model,
        ]);
    }

    public function actionReport()
    {

        $model = new PurchaseOrder();

        if ($model->load(Yii::$app->request->post())) 
        {
            // var_dump($model);
            // exit();

            $data = PurchaseOrder::find()->where(['fund_cluster' => $model->fund_cluster])
                                    ->andWhere(['status' => $model->status])
                                    ->andWhere(['between', 'date', $model->date_from, $model->date_to])
                                    ->all();

            return $this->render('report', ['data' => $data, 'model' => $model]);
        }

        return $this->render('reportIndex', ['model' => $model]);
    }

    /**
     * Finds the PurchaseOrder model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PurchaseOrder the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PurchaseOrder::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
