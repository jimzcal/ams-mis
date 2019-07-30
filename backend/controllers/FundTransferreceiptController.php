<?php

namespace backend\controllers;

use Yii;
use backend\models\FundTransferreceipt;
use backend\models\FundTransferreceiptSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Far6Projects;

/**
 * FundTransferreceiptController implements the CRUD actions for FundTransferreceipt model.
 */
class FundTransferreceiptController extends Controller
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
     * Lists all FundTransferreceipt models.
     * @return mixed
     */
    public function actionIndex($project_id)
    {
        $searchModel = new FundTransferreceiptSearch();
        $searchModel->operating_unit = Yii::$app->user->identity->region; 
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $project = Far6Projects::find()->where(['id' => $project_id])->one();

        $model = new FundTransferreceipt();

        if ($model->load(Yii::$app->request->post()))
        {
            // $model->ors_no = implode('*', $model->ors_no);
            $model->save(false);
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
            'project' => $project,
        ]);
    }

    /**
     * Displays a single FundTransferreceipt model.
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
     * Creates a new FundTransferreceipt model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new FundTransferreceipt();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing FundTransferreceipt model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $project = Far6Projects::find()->where(['id' => $model->project_id])->one();

        if ($model->load(Yii::$app->request->post()) && $model->save()) 
        {
            return $this->redirect(['view', 'id' => $model->id, 'project' => $project]);
        }

        return $this->render('update', [
            'model' => $model,
            'project' => $project
        ]);
    }

    /**
     * Deletes an existing FundTransferreceipt model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        $this->findModel($id)->delete();

        return $this->redirect(['index', 'project_id' => $model->project_id]);
    }

    /**
     * Finds the FundTransferreceipt model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FundTransferreceipt the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FundTransferreceipt::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
