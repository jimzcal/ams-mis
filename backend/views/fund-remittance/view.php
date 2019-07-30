<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\FundRemittance */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Fund Remittances', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fund-remittance-view">

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
            'date_entry',
            'project_id',
            'operating_unit',
            'btr_date',
            'btr_amount',
            'ncarequest_date',
            'ncarequest_amount',
            'nca_date',
            'nca_amount',
            'nca_reference',
        ],
    ]) ?>

</div>
