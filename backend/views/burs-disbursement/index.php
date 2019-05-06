<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BursDisbursementSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Disbursements';
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="burs-disbursement-index">

     <div style="color: #fff; border-bottom: solid 2px #fff; text-align: right; padding-top: 13px;">
        <h3>DISBURSEMENTS</h3>
    </div>
    <p>
        <span class = 'btn btn-success' data-toggle="modal" data-target="#newModal"> New Disbursement </span>
        <!-- <?= Html::a('Print', ['report'], ['class' => 'btn btn-success']) ?> -->

        <span style="float: right; color: #fff; font-style: italic;">
            <?= $model->getProjecttitle($project_id) ?>
        </span>
    </p>
    <!-- <br> -->
    <div class="row">
        <div class="col-md-3">
            <div style="width: 100%; min-height: 400px; padding: 10px; background-color: #0099cc">
                <div style="background-color: #33ccff; width: 100%; padding: 12px; color: #fff; border: solid 1px #00ace6;">
                    <span class="fa fa-search" style="color: green; text-shadow: 2px 2px 2px #fff; font-size: 20px;"></span> SEARCH Disbursement
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
                        //'date_entry',
                        //'burs_date',
                        //'burs_no',
                        'dv_date',
                        'dv_no',
                        // 'project_id',
                        [
                            'attribute' => 'project_id',
                            'value' => function($data)
                            {
                                return $data->getProjecttitle($data->project_id);
                            }
                        ],
                        'amount',
                        [
                            'attribute' => 'amount',
                            'value' => function($data)
                            {
                                return number_format($data->amount, 2);
                            }
                        ],
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
         <h4 class="modal-title">New Disbursement</h4>
      </div>
      <div class="modal-body">
            <div class="news-content-modal">
                <?= $this->render('_form', [
                    'model' => $model,
                    'project_id' => $project_id,
                ]) ?>
            </div>
      </div>
    </div>
    </div>
</div>