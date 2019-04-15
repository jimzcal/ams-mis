<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\PurchaseOrder */

$this->title = $model->po_no;
// $this->params['breadcrumbs'][] = ['label' => 'Purchase Orders', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<style type="text/css">
    .content{
      font-size: 12px;
      text-align: justify;
      white-space: pre;
    }
</style>
<div class="purchase-order-view">

    <div style="color: #fff; border-bottom: solid 2px #fff; text-align: right; padding-top: 13px;" id="no-print">
        <h3>PURCHASE ORDER</h3>
    </div>
    <br>
    <div class="row">
        <div class="col-md-3">
            <div style="width: 100%; min-height: 460px; padding: 10px; background-color: #0099cc">
                <div style="background-color: #33ccff; width: 100%; padding: 12px; color: #fff; border: solid 1px #00ace6;">
                    <span class="fa fa-pen" style="color: green; text-shadow: 2px 2px 2px #fff; font-size: 20px;"></span> SELECT ACTION
                </div><br>
                <?= Html::a('DISBURSE', ['disburse', 'id' => $model->id], ['class' => 'btn btn-primary', 'style' => 'width: 100%; display: inline-block; margin-bottom: 5px;']) ?>
                <br>
                <?= Html::a('UPDATE', ['update', 'id' => $model->id], ['class' => 'btn btn-primary', 'style' => 'width: 100%; display: inline-block; margin-bottom: 5px;']) ?>
                <?= Html::a('DELETE', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'style' => 'width: 100%; display: inline-block; margin-bottom: 5px;',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
                <span class = 'btn btn-success' data-toggle="modal" data-target="#newModal" style="width: 100%; display: inline-block; margin-bottom: 5px;"> View PO Logs </span>
            </div>
        </div>
        <div class="col-md-9">
            <div style="background-color: #fff; width: 100%; border-radius: 5px;">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        //'id',
                        'date',
                        'date_recived',
                        'po_no',
                        'supplier',
                        'tin',
                        'mode_procurement',
                        'payment_term',
                        //'description:ntext',
                        [
                            'attribute' => 'description',
                            'format' => 'Html',
                            'options' => ['class' => 'content'],
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
                        'attachments',
                        'fund_cluster',
                        'status',
                    ],
                ]) ?>
            </div>
        </div>
    </div>
</div>

<div id="newModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
         <h4 class="modal-title">PO Log History</h4>
      </div>
      <div class="modal-body">
            <div class="news-content-modal">
                <table class="table table-striped table-condensed">
                    <tr>
                        <th style="text-align: center;">Date</th>
                        <th style="text-align: center;">Process</th>
                        <th style="text-align: center;">Employee</th>
                    </tr>
                    <?php foreach ($po_model as $key => $value) : ?>
                    <tr>
                        <td style="text-align: center;"><?= $value->date ?></td>
                        <td style="text-align: center;"><?= $value->process ?></td>
                        <td style="text-align: center;">
                            <?= $value->employee ?>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </table>
            </div>
      </div>
    </div>
    </div>
</div>
