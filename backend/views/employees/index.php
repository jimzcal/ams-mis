<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\EmployeesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Employees';
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="employees-index">

    <div class="btn-group btn-group-vertical" style="float: left; right: 0; z-index: 300; position: fixed;" id="noprint">
        <?= Html::a('<i class="glyphicon glyphicon-plus"></i><br> New', ['create'], ['class' => 'btn btn-default']) ?>
    </div>

    <div class="new-title">
        <i class="fa fa-group" aria-hidden="true"></i> Employees
    </div>

        <div style=" padding: 0; width: 88%; margin-left: auto; margin-right: auto; display: block;">
            <div class="row">
                <div class="col-md-8">
                    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
                </div>
                <div class="col-md-4">
                    <div style="float: right;">
                        
                    </div>
                </div>
            </div>
        </div>

    <div class="view-index">
        <?php Pjax::begin(); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                //'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    //'id',
                    'employee_id',
                    'name',
                    // 'password',
                    // 'biometrix',
                    //'qr_code',

                    ['class' => 'yii\grid\ActionColumn'],
                        ],
                ]); 
            ?>
        <?php Pjax::end(); ?>
    </div>
</div>
