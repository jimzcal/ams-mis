<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TransactionStatusSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Transaction Statuses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaction-status-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Transaction Status', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'region',
            'dv_no',
            'date',
            'process',
            //'employee',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
