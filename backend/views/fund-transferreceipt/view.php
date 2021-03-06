<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\FundTransferreceipt */

$this->title = $model->date_entry;
$this->params['breadcrumbs'][] = ['label' => 'Fund Transferreceipts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fund-transferreceipt-view">

   <div style="color: #fff; border-bottom: solid 2px #fff; text-align: right; padding-top: 13px;">
        <h3>FUND TRANSFER RECEIPT</h3>
    </div>
    <br>
    <div class="row">
        <div class="col-md-3">
            <div style="width: 100%; min-height: 400px; padding: 10px; background-color: #0099cc">
                <div style="background-color: #33ccff; width: 100%; padding: 12px; color: #fff; border: solid 1px #00ace6;">
                    <span class="fa fa-pen" style="color: green; text-shadow: 2px 2px 2px #fff; font-size: 20px;"></span> SELECT ACTION
                </div><br>
                <?= Html::a('RECEIPTS', ['fund-transferreceipt/index', 'project_id' => $model->project_id], ['class' => 'btn btn-primary', 'style' => 'width: 100%; display: inline-block; margin-bottom: 5px;']) ?>
                <br>
                <?= Html::a('PROJECTS', ['far6-projects/index'], ['class' => 'btn btn-primary', 'style' => 'width: 100%; display: inline-block; margin-bottom: 5px;']) ?>
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
            </div>
        </div>
        <div class="col-md-9">
            <div style="background-color: #fff; width: 100%; font-size: 13px; margin-right: auto; margin-left: auto; border-radius: 5px;">
                <div style="width: 100%; border-top-right-radius: 5px; border-bottom-left-radius: 5px; background-color: #e6e6e6; height: 30px; padding: 5px; line-height: 20px; color: #4d4d4d">
                    
                </div>
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            //'id',
                            'date_entry',
                            //'project_id',
                            [
                                'attribute' => 'project_id',
                                'value' => function($data)
                                {
                                    return $data->getProject();
                                }
                            ],
                            //'operating_unit',
                            'date_fundreceipt',
                            'reference',
                            'department',
                            'agency',
                            'operating_office',
                            'amount',
                        ],
                    ]) ?>
            </div>
        </div>
    </div>
</div>
