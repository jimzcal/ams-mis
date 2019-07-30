<?php

namespace backend\controllers;

use Yii;
use backend\models\Disbursements;
use backend\models\DisbursementsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Obligations;

/**
 * DisbursementsController implements the CRUD actions for Disbursements model.
 */
class DisbursementsController extends Controller
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
     * Lists all Disbursements models.
     * @return mixed
     */
    public function actionIndex($project_id)
    {
        $searchModel = new DisbursementsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $model = new Disbursements();

        if ($model->load(Yii::$app->request->post()))
        {
            $ors = explode('-', $model->ors_no);

            $model->ors_class = $ors[0];
            $model->funding_source = $ors[1];
            $model->ors_year = $ors[2];
            $model->ors_month = $ors[3];
            $model->ors_serial = $ors[4];

            $model->save(false);            
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
            'project_id' => $project_id,
        ]);
    }

    /**
     * Displays a single Disbursements model.
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
     * Creates a new Disbursements model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Disbursements();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Disbursements model.
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
            $ors = explode('-', $model->ors_no);
            
            $model->ors_class = $ors[0];
            $model->funding_source = $ors[1];
            $model->ors_year = $ors[2];
            $model->ors_month = $ors[3];
            $model->ors_serial = $ors[4];

            $model->save(false);

            Yii::$app->getSession()->setFlash('info', 'Registry of Disbursements has successfully been updated.');
            
            return $this->redirect(['index', 'project_id' => $model->project_id]);           
        }

        return $this->render('update', [
            'model' => $model,
            'project_id' => $model->project_id,
        ]);
    }

    /**
     * Deletes an existing Disbursements model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $this->findModel($id)->delete();

        Yii::$app->getSession()->setFlash('info', 'Registry of Disbursements has successfully been updated.');

        return $this->redirect(['index', 'project_id' => $model->project_id]);
    }

    public function actionOrs($ors_no)
    {
        // $countBursburs = RegistryBudgetutilization::find()
        //     ->where(['burs_no' => $burs_no])
        //     ->count();

        $ors = Obligations::find()
            ->where(['ors_no' => $ors_no])
            ->andWhere(['operating_unit' => Yii::$app->user->identity->region])
            ->one();

        if($ors != null )
        {
                echo $ors->ors_date;
        }

        else
        {
            echo " ";
        }
    }

    /**
     * Finds the Disbursements model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Disbursements the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Disbursements::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
