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

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ors', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'date',
            'region',
            'sub_office',
            'appropriation_class',
            //'ors_no',
            //'particulars:ntext',
            //'ors_class',
            //'funding_source',
            //'ors_year',
            //'ors_month',
            //'ors_serial',
            //'mfo_pap',
            //'rc',
            //'object_code',
            //'obligation',
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
