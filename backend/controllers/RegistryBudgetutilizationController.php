<?php

namespace backend\controllers;

use Yii;
use backend\models\RegistryBudgetutilization;
use backend\models\RegistryBudgetutilizationSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RegistryBudgetutilizationController implements the CRUD actions for RegistryBudgetutilization model.
 */
class RegistryBudgetutilizationController extends Controller
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
     * Lists all RegistryBudgetutilization models.
     * @return mixed
     */
    public function actionIndex($project_id)
    {
        $searchModel = new RegistryBudgetutilizationSearch();
        $searchModel->project_id = $project_id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $model = new RegistryBudgetutilization();

        if ($model->load(Yii::$app->request->post()))
        {
            foreach($model->responsibility_center as $key => $value) 
            {
                $new_model = new RegistryBudgetutilization();

                $new_model->burs_date = $model->burs_date;
                $new_model->burs_no = $model->burs_no;
                $burs_no = explode('-', $model->burs_no);
                $new_model->burs_class = $burs_no[0];
                $new_model->burs_year = $burs_no[1];
                $new_model->burs_month = $burs_no[2];
                $new_model->burs_serial = $burs_no[3];
                $new_model->payee = $model->payee;
                $new_model->operating_unit = $model->operating_unit;
                $new_model->fund_cluster = $model->fund_cluster;
                $new_model->particulars = $model->particulars;
                $new_model->responsibility_center = $model->responsibility_center[$key];
                $new_model->mfo_pap = $model->mfo_pap[$key];
                $new_model->uacs = $model->uacs[$key];
                $new_model->amount = $model->amount[$key];
                $new_model->project_id = $model->project_id;

                if($model->responsibility_center[$key] != null && $model->amount[$key] != null)
                {
                    $new_model->save(false); 
                }
            }
            
            return $this->redirect(['index', 'project_id' => $project_id]);
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
            'project_id' => $project_id,
        ]);
    }

    /**
     * Displays a single RegistryBudgetutilization model.
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
     * Creates a new RegistryBudgetutilization model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RegistryBudgetutilization();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing RegistryBudgetutilization model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $data = RegistryBudgetutilization::find()->where(['project_id' => $model->project_id])->all();

        if ($model->load(Yii::$app->request->post()))
        {
            foreach($model->responsibility_center as $key => $value) 
            {
                // var_dump($model->ids[$key]);
                // exit();

                $new_model = isset($model->ids[$key]) == null ? new RegistryBudgetutilization() : RegistryBudgetutilization::find()->where(['id' => $model->ids[$key]])->one();

                $new_model->burs_date = $model->burs_date;
                $new_model->burs_no = $model->burs_no;
                $burs_no = explode('-', $model->burs_no);
                $new_model->burs_class = $burs_no[0];
                $new_model->burs_year = $burs_no[1];
                $new_model->burs_month = $burs_no[2];
                $new_model->burs_serial = $burs_no[3];
                $new_model->payee = $model->payee;
                $new_model->operating_unit = $model->operating_unit;
                $new_model->fund_cluster = $model->fund_cluster;
                $new_model->particulars = $model->particulars;
                $new_model->responsibility_center = $model->responsibility_center[$key];
                $new_model->mfo_pap = $model->mfo_pap[$key];
                $new_model->uacs = $model->uacs[$key];
                $new_model->amount = $model->amount[$key];
                $new_model->project_id = $model->project_id;

                if($model->responsibility_center[$key] != null && $model->amount[$key] != null)
                {
                    $new_model->save(false); 
                }
            }
            
            return $this->redirect(['index', 'project_id' => $model->project_id]);
        }

        return $this->render('update', [
            'model' => $model,
            'data' => $data,
        ]);
    }

    /**
     * Deletes an existing RegistryBudgetutilization model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = RegistryBudgetutilization::find()->where(['id' => $id])->one();

        $this->findModel($id)->delete();

        return $this->redirect(['index', 'project_id' => $model->project_id]);
    }

    /**
     * Finds the RegistryBudgetutilization model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RegistryBudgetutilization the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RegistryBudgetutilization::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
