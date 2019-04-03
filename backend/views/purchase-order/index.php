<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PurchaseOrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Purchase Orders';
// $this->params['breadcrumbs'][] = $this->title;
?>
<style type="text/css">
    .content{
      font-size: 12px;
      text-align: justify;
      white-space: pre;
    }
</style>

<div class="purchase-order-index">

    <div style="color: #fff; border-bottom: solid 2px #fff; text-align: right; padding-top: 13px;" id="no-print">
        <h3>PURCHASE ORDER</h3>
    </div>
    <p>
        <span class = 'btn btn-success' data-toggle="modal" data-target="#newModal"> New PO </span>
        <?= Html::a('Generate Report', ['report'], ['class' => 'btn btn-success']) ?>
    </p>
    <br>
    <div class="row">
        <div class="col-md-3">
            <div style="width: 100%; min-height: 400px; padding: 10px; background-color: #0099cc" id="no-print">
                <div style="background-color: #33ccff; width: 100%; padding: 12px; color: #fff; border: solid 1px #00ace6;">
                    <span class="fa fa-search" style="color: green; text-shadow: 2px 2px 2px #fff; font-size: 20px;"></span> SEARCH PURCHASE ORDER
                </div><br>
                <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
            </div>
        </div>
        <div class="col-md-9">
            <div style="background-color: #fff; padding: 5px;">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                //'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    //'id',
                    'date',
                    'po_no',
                    'supplier',
                    //'tin',
                    //'mode_procurement',
                    //'payment_term',
                    [
                        'attribute' => 'description',
                        'format' => 'Html',
                        'options' => ['class' => 'content', 'style' => 'width: 340px;'],
                        'value' => function($data)
                        {
                            return $data->description;
                        }
                    ],
                    [
                        'attribute' => 'total_amount',
                        'value' => function($val)
                        {
                            return number_format($val->total_amount, 2);
                        }
                    ],
                    //'date_recived',
                    //'fund_cluster',
                    'status',

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
         <h4 class="modal-title">New Purchase Order</h4>
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