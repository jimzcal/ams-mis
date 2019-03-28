<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\DraftDvSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Draft Dvs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="draft-dv-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Draft Dv', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'reference_no',
            'date',
            'payee',
            'tin',
            //'fund_cluster',
            //'transaction_type',
            //'particulars:ntext',
            //'gross_amount',
            //'created_by',
            //'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
