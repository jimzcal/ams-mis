<?php

namespace backend\controllers;

use Yii;
use backend\models\DueDemandables;
use backend\models\DueDemandablesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\RegistryBudgetutilization;

/**
 * DueDemandablesController implements the CRUD actions for DueDemandables model.
 */
class DueDemandablesController extends Controller
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
     * Lists all DueDemandables models.
     * @return mixed
     */
    public function actionIndex($project_id)
    {
        $searchModel = new DueDemandablesSearch();
        $searchModel->project_id = $project_id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        $model = new DueDemandables();

        if ($model->load(Yii::$app->request->post()))
        {
            $model->save(false);

            Yii::$app->getSession()->setFlash('success', '<i class="glyphicon glyphicon-ok" aria-hidden="true" style = "color: green;"></i> New Entry was successfully added.');

            return $this->redirect(['index',
                'project_id' => $project_id,
            ]);
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
            'project_id' => $project_id,
        ]);
    }

    /**
     * Displays a single DueDemandables model.
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
     * Creates a new DueDemandables model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DueDemandables();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing DueDemandables model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save(false)) 
        {
            Yii::$app->getSession()->setFlash('success', '<i class="glyphicon glyphicon-ok" aria-hidden="true" style = "color: green;"></i> Data has successfully been updated.');

            return $this->redirect(['index', 'project_id' => $model->project_id]);
        }

        return $this->render('update', [
            'model' => $model,
            'project_id' => $model->project_id,
        ]);
    }

    /**
     * Deletes an existing DueDemandables model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        $this->findModel($id)->delete();

        Yii::$app->getSession()->setFlash('success', '<i class="glyphicon glyphicon-ok" aria-hidden="true" style = "color: green;"></i> Data has successfully been updated.');
        return $this->redirect(['index', 'project_id' => $model->project_id]);
    }

    public function actionBurs($burs_no)
    {
        // $countBursburs = RegistryBudgetutilization::find()
        //     ->where(['burs_no' => $burs_no])
        //     ->count();

        $burs = RegistryBudgetutilization::find()
                ->where(['burs_no' => $burs_no])
                ->andWhere(['operating_unit' => Yii::$app->user->identity->region])
                ->one();

        if($burs != null )
        {
                echo $burs->burs_date;
        }

        else
        {
            echo " ";
        }
    }

    /**
     * Finds the DueDemandables model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DueDemandables the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DueDemandables::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
