<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\OperatingUnit */

$this->title = $model->abbreviation;
// $this->params['breadcrumbs'][] = ['label' => 'Operating Units', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="operating-unit-view">

    <div style="color: #fff; border-bottom: solid 2px #fff; padding-top: 13px; text-align: right;" id="no-print">
        <h3>OPERATING UNIT</h3>
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
    <div style="background-color: #fff; width: 40%; opacity: .9">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'abbreviation',
                'description',
                'status',
            ],
        ]) ?>
    </div>
</div>
