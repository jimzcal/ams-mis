<?php

namespace backend\controllers;

use Yii;
use backend\models\Project;
use backend\models\ProjectSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Obligated;
use backend\models\DisbursedDv;
use backend\models\Liquidation;

/**
 * ProjectController implements the CRUD actions for Project model.
 */
class ProjectController extends Controller
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
     * Lists all Project models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProjectSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $model = new Project();

        if ($model->load(Yii::$app->request->post()))
        {
            $model->ors_no = implode('*', $model->ors_no);
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
     * Displays a single Project model.
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
     * Creates a new Project model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Project();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Project model.
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
            Yii::$app->getSession()->setFlash('success', 'Data has been successfully updated');

            $model->ors_no = implode('*', $model->ors_no);
            $model->save(false);
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Project model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        Yii::$app->getSession()->setFlash('success', 'Data has been successfully deleted');
        return $this->redirect(['index']);
    }

    public function actionObligate($id)
    {
        $model = $this->findModel($id);

        $new_model = new Obligated();

        if($new_model->load(Yii::$app->request->post())) 
        {
            foreach ($new_model->ors_no as $key => $value) 
            {
                $obligation_model = new Obligated();

                $obligation_model->date = $new_model->date;
                $obligation_model->region = $model->region;
                $obligation_model->appropriation_class = $new_model->appropriation_class[$key];
                $obligation_model->project_id = $model->id;
                $obligation_model->ors_no = $new_model->ors_no[$key];
                $ors_no = explode('-', $new_model->ors_no[$key]);
                $obligation_model->ors_class = $ors_no[0];
                $obligation_model->funding_source = $ors_no[1];
                $obligation_model->ors_year = $ors_no[2];
                $obligation_model->ors_month = $ors_no[3];
                $obligation_model->ors_serial = $ors_no[4];
                $obligation_model->mfo_pap = $new_model->mfo_pap[$key];
                $obligation_model->rc = $new_model->rc[$key];
                $obligation_model->object_code = $new_model->object_code[$key];
                $obligation_model->amount = $new_model->amount[$key];

                $obligation_model->save(false);
            }

            Yii::$app->getSession()->setFlash('success', 'Successfully obligated an amount for the project');

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('obligate', [
            'model' => $model,
            'new_model' => $new_model,
        ]);
    }

    public function actionDisburse($id)
    {
        $model = $this->findModel($id);

        $new_model = new DisbursedDv();

        if($new_model->load(Yii::$app->request->post())) 
        {
            foreach ($new_model->ors_no as $key => $value) 
            {
                $disbursed_model = new DisbursedDv();

                $disbursed_model->date = $new_model->date;
                $disbursed_model->fund_cluster = $new_model->fund_cluster;
                $disbursed_model->region = $model->region;
                $disbursed_model->project_id = $model->id;
                $disbursed_model->ors_no = $new_model->ors_no[$key];
                $ors_no = explode('-', $new_model->ors_no[$key]);
                $disbursed_model->ors_class = $ors_no[0];
                $disbursed_model->funding_source = $ors_no[1];
                $disbursed_model->ors_year = $ors_no[2];
                $disbursed_model->ors_month = $ors_no[3];
                $disbursed_model->ors_serial = $ors_no[4];
                $disbursed_model->mfo_pap = $new_model->mfo_pap[$key];
                $disbursed_model->rc = $new_model->rc[$key];
                $disbursed_model->object_code = $new_model->object_code[$key];
                $disbursed_model->amount = $new_model->amount[$key];

                $disbursed_model->save(false);
            }

            Yii::$app->getSession()->setFlash('success', 'Successfully disbursed an amount for the project');
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('disburse', [
            'model' => $model,
            'new_model' => $new_model,
        ]);
    }

    public function actionLiquidate($id)
    {
        $model = $this->findModel($id);

        $new_model = new Liquidation();

        if($new_model->load(Yii::$app->request->post())) 
        {
            foreach ($new_model->ors_no as $key => $value) 
            {
                $liquidated_model = new Liquidation();

                $liquidated_model->date = $new_model->date;
                $liquidated_model->status = $new_model->status;
                $liquidated_model->region = $model->region;
                $liquidated_model->project_id = $model->id;
                $liquidated_model->ors_no = $new_model->ors_no[$key];
                $ors_no = explode('-', $new_model->ors_no[$key]);
                $liquidated_model->ors_class = $ors_no[0];
                $liquidated_model->funding_source = $ors_no[1];
                $liquidated_model->ors_year = $ors_no[2];
                $liquidated_model->ors_month = $ors_no[3];
                $liquidated_model->ors_serial = $ors_no[4];
                $liquidated_model->mfo_pap = $new_model->mfo_pap[$key];
                $liquidated_model->rc = $new_model->rc[$key];
                $liquidated_model->object_code = $new_model->object_code[$key];
                $liquidated_model->amount = $new_model->amount[$key];

                $liquidated_model->save(false);
            }

            Yii::$app->getSession()->setFlash('success', 'Successfully liquidated an amount for the project');

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('liquidate', [
            'model' => $model,
            'new_model' => $new_model,
        ]);
    }

    public function actionReport()
    {
        $model = new Project();

        if($model->load(Yii::$app->request->post())) 
        {
            $data = Project::find()->where(['region' => $model->region])->all();

            return $this->render('report', [
                'data' => $data,
                'appropriation_class' => $model->appropriation_class,
            ]);

        }

        return $this->render('reportIndex', [
            'model' => $model,
        ]);
    }

    /**
     * Finds the Project model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Project the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Project::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
