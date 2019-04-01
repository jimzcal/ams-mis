<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Projects';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-index">
    <div style="color: #fff; border-bottom: solid 2px #fff; text-align: right;">
        <h3>PROJECTS</h3>
    </div>
    <p>
        <?= Html::a('Obligation', ['ors/index'], ['class' => 'btn btn-success']) ?>
        <span class = 'btn btn-success' data-toggle="modal" data-target="#newModal"> New Project </span>
        <?= Html::a('Reports', ['report'], ['class' => 'btn btn-success']) ?>
    </p>
    <!-- <br> -->
    <div class="row">
        <div class="col-md-3">
            <div style="width: 100%; min-height: 400px; padding: 10px; background-color: #0099cc">
                <div style="background-color: #33ccff; width: 100%; padding: 12px; color: #fff; border: solid 1px #00ace6;">
                    <span class="fa fa-search" style="color: green; text-shadow: 2px 2px 2px #fff; font-size: 20px;"></span> SEARCH PROJECT
                </div>
                <br>
                <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
            </div>
        </div>
        <div class="col-md-9">
            <div style="width: 100%; background-color: #fff; padding: 10px;">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    //'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        //'id',
                        //'region',
                        //'sub_office',
                        'date',
                        'title',
                        'implementing_agency',
                        //'focal_person',
                        //'ors_no',
                        //'status',

                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>

<div id="newModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
         <h4 class="modal-title">New Project</h4>
      </div>
      <div class="modal-body">
            <div class="news-content-modal">
                <?= $this->render('_form', [
                    'model' => $model,
                ]) ?>
            </div>
      </div>
    </div>
    </div>
</div>
