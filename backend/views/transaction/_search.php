<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TransactionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transaction-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <table class="search-table" style="width: 70%;">
        <tr>
            <td valign="top" align="right" style="padding-right: 2px;">
                <i class="fa fa-search" style="color: green; font-size: 30px;"></i>
            </td>
            <td style="padding-right: 2px;">
                 <?= $form->field($model, 'name')->textInput(['placeholder'=>'Transaction'])->label(false) ?>
            </td>
            <td style="padding-right: 2px;">
                <?= $form->field($model, 'requirements')->textInput(['placeholder'=>'Requirements'])->label(false) ?>
            </td>
            <td>
                <div class="form-group">
                    <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
                </div>
            </td>
        </tr>
    </table>

    <?php ActiveForm::end(); ?>

</div>
