<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\FundRemittanceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Fund Remittances';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fund-remittance-index">

    <div style="color: #fff; border-bottom: solid 2px #fff; text-align: right; padding-top: 13px;">
        <h3>FUND REMITTANCE</h3>
    </div>
    <p>
        <span class = 'btn btn-success' data-toggle="modal" data-target="#newModal"> New Remittance </span>
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
                        //'date_entry',
                        'project_id',
                        'operating_unit',
                        'btr_date',
                        'btr_amount',
                        //'ncarequest_date',
                        //'ncarequest_amount',
                        //'nca_date',
                        //'nca_amount',
                        //'nca_reference',

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
         <h4 class="modal-title">Fund Remittance</h4>
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