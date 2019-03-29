<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\DisbursementSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Disbursements';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="disbursement-index">

    <div style="color: #fff; border-bottom: solid 2px #fff; text-align: right;">
        <h3>DISBURSEMENT VOUCHER</h3>
    </div>
    <br>
    <div class="row">
        <div class="col-md-3">
            <div style="width: 100%; min-height: 400px; padding: 10px; background-color: #0099cc">
                <div style="background-color: #33ccff; width: 100%; padding: 12px; color: #fff; border: solid 1px #00ace6;">
                    <span class="fa fa-search" style="color: green; text-shadow: 2px 2px 2px #fff; font-size: 20px;"></span> SEARCH DV
                </div><br>
                <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
            </div>
        </div>
        <div class="col-md-9">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                //'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    //'id',
                    'date',
                    //'region',
                    'dv_no',
                    'payee',
                    //'fund_cluster',
                    //'rc_code',
                    //'transaction',
                    'particulars:ntext',
                    //'attachments:ntext',
                    'gross_amount',
                    'net_amount',
                    'status',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
    </div>
</div>
<!-- <p>
        <?php// Html::a('Create Disbursement', ['create'], ['class' => 'btn btn-success']) ?>
    </p> -->