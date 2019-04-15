<?php

namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use backend\models\Ors;
use backend\models\OrsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrsController implements the CRUD actions for Ors model.
 */
class OrsController extends Controller
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
                        'actions' => ['index', 'create', 'view', 'delete', 'update'],
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
     * Lists all Ors models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Ors model.
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
     * Creates a new Ors model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Ors();

        if($model->load(Yii::$app->request->post())) 
        {
            foreach ($model->rc as $key => $value) 
            {
                $new_model = new Ors();

                $new_model->date = $model->date;
                $new_model->region = $model->region;
                // $new_model->sub_office = $model->sub_office;
                $new_model->general_appropriation = $model->general_appropriation;
                $new_model->ors_no = $model->ors_class.'-'.$model->funding_source.'-'.$model->ors_year.'-'.$model->ors_month.'-'.$model->ors_serial;
                $new_model->ors_class = $model->ors_class;
                $new_model->particulars = $model->particulars;
                $new_model->funding_source = $model->funding_source;
                $new_model->ors_year = $model->ors_year;
                $new_model->ors_month = $model->ors_month;
                $new_model->ors_serial = $model->ors_serial;
                $new_model->rc = $model->rc[$key];
                $new_model->object_code = $model->object_code[$key];
                $new_model->mfo_pap = $model->mfo_pap[$key];
                $new_model->obligation = $model->obligation[$key];

                $new_model->save(false);

            }

            return $this->redirect(['view', 'id' => $new_model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Ors model.
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
            foreach ($model->rc as $key => $value) 
            {
                $check_data = Ors::find()->where(['id' => $model->id[$key]])->one();
                $new_model = $check_data == null ? new Ors() : $check_data;

                $new_model->date = $model->date;
                $new_model->region = $model->region;
                //$new_model->sub_office = $model->sub_office;
                $new_model->general_appropriation = $model->general_appropriation;
                $new_model->ors_no = $model->ors_class.'-'.$model->funding_source.'-'.$model->ors_year.'-'.$model->ors_month.'-'.$model->ors_serial;
                $new_model->ors_class = $model->ors_class;
                $new_model->particulars = $model->particulars;
                $new_model->funding_source = $model->funding_source;
                $new_model->ors_year = $model->ors_year;
                $new_model->ors_month = $model->ors_month;
                $new_model->ors_serial = $model->ors_serial;
                $new_model->rc = $model->rc[$key];
                $new_model->object_code = $model->object_code[$key];
                $new_model->mfo_pap = $model->mfo_pap[$key];
                $new_model->obligation = $model->obligation[$key];

                $new_model->save(false);

            }

            return $this->redirect(['view', 'id' => $new_model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Ors model.
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
     * Finds the Ors model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Ors the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Ors::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
