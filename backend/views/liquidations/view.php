<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use dosamigos\chartjs\ChartJs;

/* @var $this yii\web\View */
/* @var $model backend\models\Liquidations */

$this->title = $model->id;
// $this->params['breadcrumbs'][] = ['label' => 'Liquidations', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="liquidations-view">

    <div style="color: #fff; border-bottom: solid 2px #fff; text-align: right; padding-top: 13px;">
        <h3><?= 'LIQUIDATION FOR '.strtoupper($model->getProject($model->project_id)->project_title) ?></h3>
    </div>
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
    <br>
    <div style="width: 85%; padding: 10px; background-color: #0099cc; opacity: .95; margin-right: auto; margin-left: auto; display: block;">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                //'id',
                //'date_entry',
                //'project_id',
                'ors_no',
                'ors_date',
                //'ors_class',
                //'funding_source',
                //'ors_year',
                //'ors_month',
                //'ors_serial',
                'dv_no',
                'dv_date',
                //'reference',
                //'amount',
                [
                    'attribute' => 'amount',
                    'value' => function($data)
                    {
                        return number_format($data->amount, 2);
                    }
                ],
                'status',
            ],
        ]) ?>
    </div>
</div>
