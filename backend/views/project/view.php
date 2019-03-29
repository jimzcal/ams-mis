<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Project */

$this->title = $model->title;
// $this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-view">

    <div style="color: #fff; border-bottom: solid 2px #fff; text-align: right; padding-top: 13px;">
        <h3>PROJECT</h3>
    </div>
    <p>
        <?= Html::a('Obligate', ['obligate', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Disburse', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Liquidate', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
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
    <div style="background-color: #fff; width: 70%; font-size: 13px; margin-right: auto; margin-left: auto; border-radius: 5px;">
        <div style="width: 100%; border-top-right-radius: 5px; border-bottom-left-radius: 5px; background-color: #e6e6e6; height: 30px; padding: 5px; line-height: 20px; color: #4d4d4d">
            PROJECT
        </div>

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                //'id',
                'date',
                'title',
                'region',
                'sub_office',
                'implementing_agency',
                'focal_person',
                'ors_no',
                'status',
            ],
        ]) ?>
    </div>
</div>
