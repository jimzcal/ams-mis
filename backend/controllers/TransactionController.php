<?php

namespace backend\controllers;

use Yii;
use backend\models\Transaction;
use backend\models\TransactionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Requirements;
use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;

/**
 * TransactionController implements the CRUD actions for Transaction model.
 */
class TransactionController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                    'class' => AccessControl::className(),
                    'only' => ['index', 'view', 'create', 'update', 'delete'],
                    'rules' => [
                          [
                            'allow' => true,
                            'roles' => ['@']
                          ]             
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
     * Lists all Transaction models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TransactionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Transaction model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Transaction model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Transaction();
        $requirements = requirements::find()->orderBy(['requirement'=>SORT_NATURAL])->all();
        //$requirements = $requirements->orderBy([$requirements->requirements, SORT_NATURAL])->all();
        //$requirements=ArrayHelper::map(requirements::find()->all(), 'requirement', 'requirement'); 

        if ($model->load(Yii::$app->request->post()))
        {
            $Requirements = array_filter($model->requirements, function($value){ return $value != '0'; } );
            $model->requirements = implode(',', $Requirements);
            $model->save();

            Yii::$app->getSession()->setFlash('success', 'Success! New transaction has been added');
            return $this->redirect(['index']);
        }

        // //$x = array_filter($requirements);
        // var_dump($requirements);
        // exit();
        
        return $this->render('create', [
            'model' => $model,
            'requirements' => $requirements,

        ]);
    }

    /**
     * Updates an existing Transaction model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $all = ArrayHelper::map(Requirements::find(['requirements'])->orderBy(['requirement'=>SORT_NATURAL])->all(), 'requirement', 'requirement'); 
        $requirements = Transaction::find(['requirements'])->where(['id'=>$id])->one();
        $requirements = explode(',', $requirements->requirements);

        $data = array_diff($all, $requirements);

        if ($model->load(Yii::$app->request->post()))
        {
            $Requirements = array_filter($model->requirements, function($value){ return $value != '0'; } );
            $model->requirements = implode(',', $Requirements);
            $model->save();

            Yii::$app->getSession()->setFlash('success', 'Success! Transaction has been updated');
            return $this->redirect(['index']);
            
        }
   
        return $this->render('update', [
            'model' => $model,
        ]);
        
    }

    /**
     * Deletes an existing Transaction model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Transaction model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Transaction the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Transaction::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
