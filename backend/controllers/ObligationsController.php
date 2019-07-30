<?php

namespace backend\controllers;

use Yii;
use backend\models\Obligations;
use backend\models\ObligationsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ObligationsController implements the CRUD actions for Obligations model.
 */
class ObligationsController extends Controller
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
     * Lists all Obligations models.
     * @return mixed
     */
    public function actionIndex($project_id)
    {
        $searchModel = new ObligationsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $model = new Obligations();

        if ($model->load(Yii::$app->request->post()))
        {
            foreach($model->rc as $key => $value) 
            {
                $new_model = new Obligations();

                $new_model->ors_date = $model->ors_date;
                $new_model->ors_no = $model->ors_no;
                $ors_no = explode('-', $model->ors_no);
                $new_model->ors_class = $ors_no[0];
                $new_model->funding_source = $ors_no[1];
                $new_model->ors_year = $ors_no[2];
                $new_model->ors_month = $ors_no[3];
                $new_model->ors_serial = $ors_no[4];
                $new_model->payee = $model->payee;
                $new_model->operating_unit = $model->operating_unit;
                $new_model->fund_cluster = $model->fund_cluster;
                $new_model->particulars = $model->particulars;
                $new_model->rc = $model->rc[$key];
                $new_model->mfo_pap = $model->mfo_pap[$key];
                $new_model->object_code = $model->object_code[$key];
                $new_model->amount = $model->amount[$key];
                $new_model->project_id = $project_id;

                if($model->rc[$key] != null && $model->amount[$key] != null)
                {
                    if(sizeof($ors_no) == 5)
                    {
                        $new_model->save(false); 
                    }
                    else{

                        Yii::$app->getSession()->setFlash('warning', 'Wrong format of ORS Number.');

                        return $this->redirect(['index', 'project_id' => $project_id]);
                    }
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
     * Displays a single Obligations model.
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
     * Creates a new Obligations model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Obligations();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Obligations model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $data = Obligations::find()->where(['project_id' => $model->project_id])->all();

        if ($model->load(Yii::$app->request->post()))
        {
            foreach($model->rc as $key => $value) 
            {
                // var_dump($model->ids[$key]);
                // exit();

                $new_model = isset($model->ids[$key]) == null ? new Obligations() : Obligations::find()->where(['id' => $model->ids[$key]])->one();

                $new_model->ors_date = $model->ors_date;
                $new_model->ors_no = $model->ors_no;
                $ors_no = explode('-', $model->ors_no);
                $new_model->ors_class = $ors_no[0];
                $new_model->ors_year = $ors_no[1];
                $new_model->ors_month = $ors_no[2];
                $new_model->ors_serial = $ors_no[3];
                $new_model->payee = $model->payee;
                $new_model->operating_unit = $model->operating_unit;
                $new_model->fund_cluster = $model->fund_cluster;
                $new_model->particulars = $model->particulars;
                $new_model->rc = $model->rc[$key];
                $new_model->mfo_pap = $model->mfo_pap[$key];
                $new_model->object_code = $model->object_code[$key];
                $new_model->amount = $model->amount[$key];
                $new_model->project_id = $model->project_id;
                $new_model->appropriation_class = $model->appropriation_class;

                if($model->rc[$key] != null && $model->amount[$key] != null)
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
     * Deletes an existing Obligations model.
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
     * Finds the Obligations model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Obligations the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Obligations::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
