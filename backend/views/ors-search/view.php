<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Ors */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ors-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'date',
            'region',
            'sub_office',
            'appropriation_class',
            'ors_no',
            'particulars:ntext',
            'ors_class',
            'funding_source',
            'ors_year',
            'ors_month',
            'ors_serial',
            'mfo_pap',
            'rc',
            'object_code',
            'obligation',
            'dv_date',
            'dv_no',
            'fund_cluster',
            'dv_amount',
            'liquidation_date',
            'liquidation_amount',
            'liquidation_status',
        ],
    ]) ?>

</div>
