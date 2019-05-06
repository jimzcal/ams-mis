<?php

namespace backend\controllers;

use Yii;
use backend\models\BursLiquidation;
use backend\models\BursLiquidationSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\RegistryBudgetutilization;

/**
 * BursLiquidationController implements the CRUD actions for BursLiquidation model.
 */
class BursLiquidationController extends Controller
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
     * Lists all BursLiquidation models.
     * @return mixed
     */
    public function actionIndex($project_id)
    {
        $searchModel = new BursLiquidationSearch();
        $searchModel->project_id = $project_id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $model = new BursLiquidation();

        if ($model->load(Yii::$app->request->post()))
        {
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
     * Displays a single BursLiquidation model.
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
     * Creates a new BursLiquidation model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new BursLiquidation();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing BursLiquidation model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'project_id' => $model->project_id]);
        }

        return $this->render('update', [
            'model' => $model,
            'project_id' => $model->project_id,
        ]);
    }

    /**
     * Deletes an existing BursLiquidation model.
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
     * Finds the BursLiquidation model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BursLiquidation the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BursLiquidation::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
