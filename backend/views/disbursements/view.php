<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Disbursements */

$this->title = $model->dv_no;
// $this->params['breadcrumbs'][] = ['label' => 'Disbursements', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="disbursements-view">

    <div style="color: #fff; border-bottom: solid 2px #fff; text-align: right; padding-top: 13px;">
        <h3><?= 'DV No. '.Html::encode($this->title) ?></h3>
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
                [
                    'attribute' => 'project_id',
                    'value' => function($data)
                    {
                        return $data->getProjecttitle($data->project_id)->project_title;
                    }
                ],
                'ors_no',
                // 'ors_date',
                // 'ors_class',
                // 'funding_source',
                // 'ors_year',
                // 'ors_month',
                // 'ors_serial',
                'dv_no',
                'dv_date',
                'amount',
            ],
        ]) ?>
    </div>
</div>
