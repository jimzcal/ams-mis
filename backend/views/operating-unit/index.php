<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\OperatingUnitSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Operating Units';
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="operating-unit-index">

    <div style="color: #fff; border-bottom: solid 2px #fff; text-align: right; padding-top: 13px;" id="no-print">
        <h3>OPERATING UNIT</h3>
    </div>
    <p>
        <?= Html::a('New Operating Unit', ['create'], ['class' => 'btn btn-success']) ?>
        <!-- <?php// Html::a('SUB OPERATING UNIT', ['/sub-ou/index'], ['class' => 'btn btn-success']) ?> -->
        <?= Html::a('Implementing Agency', ['/national-agency/index'], ['class' => 'btn btn-success']) ?>
    </p>
    <br>
    <div class="row">
        <div class="col-md-3">
            <div style="width: 100%; min-height: 400px; padding: 10px; background-color: #0099cc" id="no-print">
                <div style="background-color: #33ccff; width: 100%; padding: 12px; color: #fff; border: solid 1px #00ace6;">
                    <span class="fa fa-search" style="color: green; text-shadow: 2px 2px 2px #fff; font-size: 20px;"></span> SEARCH OPERATING UNIT
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
                        'abbreviation',
                        'description',
                        'status',

                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>
