<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\OrsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ors';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ors-index">

    <div style="color: #fff; border-bottom: solid 2px #fff; text-align: right;">
        <h3>OBLIGATION</h3>
    </div>
    <p>
        <?= Html::a('New Obligation', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <!-- <br> -->
    <div class="row">
        <div class="col-md-3">
            <div style="width: 100%; min-height: 400px; padding: 10px; background-color: #0099cc">
                <div style="background-color: #33ccff; width: 100%; padding: 12px; color: #fff; border: solid 1px #00ace6;">
                    <span class="fa fa-search" style="color: green; text-shadow: 2px 2px 2px #fff; font-size: 20px;"></span> SEARCH OBLIGATION
                </div>
                <br>
                <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
            </div>
        </div>
        <div class="col-md-9">
            <div style="background-color: #fff; padding: 10px; font-size: 12px;">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    //'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        //'id',
                        'date',
                        'region',
                        'sub_office',
                        'appropriation_class',
                        'ors_no',
                        'particulars:ntext',
                        //'ors_class',
                        //'funding_source',
                        //'ors_year',
                        //'ors_month',
                        //'ors_serial',
                        //'mfo_pap',
                        //'rc',
                        //'object_code',
                        'obligation',
                        //'date_obligated',
                        //'obligated_amount',
                        //'dv_date',
                        //'dv_no',
                        //'fund_cluster',
                        //'dv_amount',
                        //'liquidation_date',
                        //'liquidation_amount',
                        //'liquidation_status',

                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>
