<?php

namespace backend\controllers;

use Yii;
use backend\models\Far6Projects;
use backend\models\Far6ProjectsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * Far6ProjectsController implements the CRUD actions for Far6Projects model.
 */
class Far6ProjectsController extends Controller
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
     * Lists all Far6Projects models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new Far6ProjectsSearch();
        $searchModel->operating_unit = Yii::$app->user->identity->region; 
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $model = new Far6Projects();

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
        ]);
    }

    /**
     * Displays a single Far6Projects model.
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
     * Creates a new Far6Projects model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Far6Projects();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Far6Projects model.
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
     * Deletes an existing Far6Projects model.
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

    public function actionReport()
    {
        $model = new Far6Projects();

        if($model->load(Yii::$app->request->post())) 
        {

            if($model->operating_unit == 'All')
            {
                $dataProvider = OperatingUnit::find()->all();

                return $this->render('consol_report', [
                    'dataProvider' => $dataProvider,
                    'model' => $model,
                ]);
            }

            if($model->operating_unit != 'All')
            {
                $data = Far6Projects::find()->where(['operating_unit' => $model->operating_unit])
                                    ->andWhere(['status' => 'Active'])
                                    ->andWhere(['type' => $model->type])
                                    ->groupBy(['department'])
                                    ->all();

                return $this->render('report', [
                    'data' => $data,
                    'model' => $model,
                ]);
            }
            

        }

        return $this->render('reportIndex', [
            'model' => $model,
        ]);
    }

    public function actionAgencies($department)
    {
        $countAgencies = Far6Projects::find()
            ->where(['department' => $department])
            ->count();

        $agencies = Far6Projects::find()
            ->where(['department' => $department])
            ->groupBy(['department'])
            ->all();

        if($countAgencies > 0)
        {
                foreach($agencies as $agency)
                {
                     echo "<option value='".$agency->agency."'>".$agency->agency."</option>";
                }
        }

        else
            {
                echo "<option> - </option>";
            }
    }

    /**
     * Finds the Far6Projects model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Far6Projects the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Far6Projects::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
