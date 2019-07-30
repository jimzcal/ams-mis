<?php

namespace backend\controllers;

use Yii;
use backend\models\Projects;
use yii\filters\AccessControl;
use backend\models\ProjectsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\NationalAgency;
use backend\models\JournalEntry;
use backend\models\OperatingUnit;

/**
 * ProjectsController implements the CRUD actions for Projects model.
 */
class ProjectsController extends Controller
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
                        'actions' => ['index', 'create', 'view', 'delete', 'update', 'report', 'agencies', 'journalize'],
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
     * Lists all Projects models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProjectsSearch();
        $searchModel->operating_unit = Yii::$app->user->identity->region; 
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $model = new Projects();

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
     * Displays a single Projects model.
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
     * Creates a new Projects model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Projects();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Projects model.
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
     * Deletes an existing Projects model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        JournalEntry::deleteAll(['project_id' => $id]);

        return $this->redirect(['index']);
    }

    public function actionAgencies($department)
    {
        $countAgencies = NationalAgency::find()
            ->where(['department' => $department])
            ->count();

        $agencies = NationalAgency::find()
            ->where(['department' => $department])
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

    public function actionJournalize($id)
    {
        $model = $this->findModel($id);

        $new_model = new JournalEntry();

        if ($new_model->load(Yii::$app->request->post()))
        {
            foreach ($new_model->ors_no as $key => $value) 
            {
                $model_new = new JournalEntry();

                $model_new->operating_unit = Yii::$app->user->identity->region;
                $model_new->year = $new_model->year;
                $model_new->project_id = $id;
                $model_new->fund_cluster = $new_model->fund_cluster;
                $model_new->ors_no = $new_model->ors_no[$key];
                $model_new->ors_date = $new_model->ors_date[$key];

                $ors = explode('-', $new_model->ors_no[$key]);
                $model_new->ors_class = $ors[0];
                $model_new->ors_fundingsource = $ors[1];
                $model_new->ors_year = $ors[2];
                $model_new->ors_month = $ors[3];
                $model_new->ors_series = $ors[4];

                $model_new->quarter = $new_model->quarter;
                $model_new->obligation = $new_model->obligation[$key];
                $model_new->disbursement = $new_model->disbursement[$key];
                $model_new->liquidation = $new_model->liquidation[$key];
                $model_new->appropriation_type = $new_model->appropriation_type;

                $model_new->save(false);

            }

            Yii::$app->getSession()->setFlash('info', 'Successfully Save Entry');

            return $this->redirect(['view', 'id' => $id]);
        }

        return $this->render('journalize', [
            'model' => $model,
            'new_model' => $new_model,
        ]);
    }

    public function actionReport()
    {
        $model = new Projects();

        if($model->load(Yii::$app->request->post())) 
        {

            if($model->operating_unit == 'All')
            {
                $dataProvider = OperatingUnit::find()->where(['status' => 'Active'])->all();

                return $this->render('consol_report', [
                    'dataProvider' => $dataProvider,
                    'model' => $model,
                ]);
            }

            if($model->operating_unit != 'All')
            {
                $data = Projects::find()->where(['operating_unit' => $model->operating_unit])
                                    ->andWhere(['status' => 'Active'])
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

    /**
     * Finds the Projects model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Projects the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Projects::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
