<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\SubOu */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Sub Ous', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sub-ou-view">

    <div style="color: #fff; border-bottom: solid 2px #fff; padding-top: 13px; text-align: right;" id="no-print">
        <h3>SUB - OPERATING UNIT</h3>
    </div>
    <br>
    <div class="row">
        <div class="col-md-3">
            <div style="width: 100%; min-height: 400px; padding: 10px; background-color: #0099cc">
                <div style="background-color: #33ccff; width: 100%; padding: 12px; color: #fff; border: solid 1px #00ace6;">
                    <span class="fa fa-pen" style="color: green; text-shadow: 2px 2px 2px #fff; font-size: 20px;"></span> SELECT ACTION
                </div><br>
                <?= Html::a('UPDATE', ['update', 'id' => $model->id], ['class' => 'btn btn-primary', 'style' => 'width: 100%; display: inline-block; margin-bottom: 5px;']) ?>
                <?= Html::a('DELETE', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'style' => 'width: 100%; display: inline-block; margin-bottom: 5px;',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
            </div>
        </div>
        <div class="col-md-9">
            <div style="width: 90%; margin-right: auto; margin-left: auto; border-radius: 5px; background-color: #fff; opacity: .9; padding: 8px;">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        'mother_unit',
                        'sub_ou',
                        'description',
                        'status',
                    ],
                ]) ?>
            </div>
        </div>
    </div>
</div>
