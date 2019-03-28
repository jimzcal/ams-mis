<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Employees */

$this->title = 'Employee '.$model->name;
// $this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="employees-view">

    <div class="new-title">
        <i class="fa fa-group" aria-hidden="true"></i> <?= 'Client Profile' ?>
    </div>

    <div class="btn-group btn-group-vertical" style="float: left; left: 0; z-index: 300; position: fixed;" id="noprint">
        <?= Html::a('<i class="glyphicon glyphicon-arrow-left"></i>', ["/employees/index"], ['class' => 'btn btn-default']) ?>
        <a href="javascript:window.print()" class="btn btn-default"><i class="glyphicon glyphicon-print" style= "font-size: 14px;"></i></a>
        <?= Html::a('<i class="glyphicon glyphicon-pencil" style= "font-size: 14px;"></i>', ['update', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
        <?= Html::a('<i class="glyphicon glyphicon-trash" style= "font-size: 14px;"></i>', ['delete', 'id' => $model->id], ['class' => 'btn btn-default',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?> 
    </div>
    
    <div style="width: 900px; margin-right: auto; margin-left: auto; border-right: 10px; background-color: #FFFFFF; margin-top: 10px; padding: 10px;">
        <table class="table table-bordered table-condensed">
            <tr style="height: 140px;">
                <td colspan="2" style="text-align: center; padding: 25px; color: #737373;">
                    <h2>EMPLOYEE'S PROFILE FORM</h2>
                </td>
                <td width="200">
                    <img src="<?= $model->photo ?>">
                </td>
            </tr>
            <tr>
                <td style="width: 150px; font-size: 12px; color: #8c8c8c; font-style: italic; text-align: right; vertical-align: middle;;">Name :</td>
                <td style="height: 35px;">
                    <?= $model->name ?>
                </td>
                <td style="height: 35px;">
                    ID:
                    <?= $model->employee_id ?>
                </td>
            </tr>
            <tr>
                <td style="width: 150px; font-size: 12px; color: #8c8c8c; font-style: italic; text-align: right; vertical-align: middle;;">Position :</td>
                <td colspan="2" style="height: 35px;">
                    <?= $model->position ?>
                </td>
            </tr>
            <tr>
                <td style="width: 150px; font-size: 12px; color: #8c8c8c; font-style: italic; text-align: right; vertical-align: middle;;">Office :</td>
                <td colspan="2" style="height: 35px;">
                    <?= $model->office ?>
                </td>
            </tr>
            <tr>
                <td style="width: 150px; font-size: 12px; color: #8c8c8c; font-style: italic; text-align: right; vertical-align: middle;;">Password :</td>
                <td colspan="2" style="height: 35px;">
                    <?= '...Hidden...' ?>
                </td>
            </tr>
            <tr>
                <td style="width: 150px; font-size: 12px; color: #8c8c8c; font-style: italic; text-align: right; vertical-align: middle;;">Biometrix :</td>
                <td colspan="2" style="height: 35px;">
                    <?= '...Hidden...' ?>
                </td>
            </tr>
            <tr>
                <td style="width: 150px; font-size: 12px; color: #8c8c8c; font-style: italic; text-align: right; vertical-align: middle;;">QR Code :</td>
                <td colspan="2" style="height: 35px;">
                    <?= '...Hidden...' ?>
                </td>
            </tr>
        </table>
    </div>
</div>
