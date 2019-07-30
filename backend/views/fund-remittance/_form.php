<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\FundRemittance */
/* @var $form yii\widgets\ActiveForm */
?>

<style type="text/css">
    td{
        padding-right: 3px;
    }
</style>

<div class="fund-remittance-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'project_id')->hiddenInput(['value' => $project_id])->label(false) ?>

    <?= $form->field($model, 'operating_unit')->textInput(['maxlength' => true, 'readOnly' => true, 'value' => Yii::$app->user->identity->region]) ?>

    <label>1. FUND REMITTANCE TO BTr</label>
    <div style="padding: 10px; border: solid 1px #ccc; border-radius: 5px; margin-bottom: 5px;">
        <table style="width: 100%;">
            <tr>
                <td style="width: 70%;">
                    <?= $form->field($model, 'btr_date')->widget(DatePicker::classname(), [
                        'options' => [
                            // 'class' => 'new-textfield',
                            'placeholder' => 'Date',
                            // 'value' => $model->burs_date == null ? date('Y-m-d') : $model->burs_date,
                        ],
                        'pluginOptions' => [
                        'autoclose' => true,
                        'todayHighlight' => true,
                        'format' => 'yyyy-mm-dd'
                            ]
                    ])->label('Date of Remittance'); ?>

                </td>
                <td>
                    <?= $form->field($model, 'btr_amount')->textInput(['maxlength' => true, 'value' => $model->btr_amount == null ? 0.0 : $model->btr_amount, 'style' => 'text-align: right;'])->label('Amount') ?>
                </td>
            </tr>
        </table>
    </div>
    <br>

    <label>2. REQUEST OF NOTICE OF CASH ALLOCATION (NCA)</label>
    <div style="padding: 10px; border: solid 1px #ccc; border-radius: 5px; margin-bottom: 5px;">
        <table style="width: 100%;">
            <tr>
                <td style="width: 70%;">
                    <?= $form->field($model, 'ncarequest_date')->widget(DatePicker::classname(), [
                        'options' => [
                            // 'class' => 'new-textfield',
                            'placeholder' => 'Date',
                            // 'value' => $model->burs_date == null ? date('Y-m-d') : $model->burs_date,
                        ],
                        'pluginOptions' => [
                        'autoclose' => true,
                        'todayHighlight' => true,
                        'format' => 'yyyy-mm-dd'
                            ]
                    ])->label('Date of Request'); ?>
                </td>
                <td>
                    <?= $form->field($model, 'ncarequest_amount')->textInput(['maxlength' => true, 'value' => $model->ncarequest_amount == null ? 0.0 : $model->ncarequest_amount, 'style' => 'text-align: right;'])->label('Amount') ?>
                </td>
            </tr>
        </table>
    </div>
    <br>

    <label>3. RECEIPT OF NOTICE OF CASH ALLOCATION (NCA)</label>
    <div style="padding: 10px; border: solid 1px #ccc; border-radius: 5px; margin-bottom: 5px;">
        <table style="width: 100%;">
            <tr>
                <td style="width: 70%;">
                    <?= $form->field($model, 'nca_date')->widget(DatePicker::classname(), [
                        'options' => [
                            // 'class' => 'new-textfield',
                            'placeholder' => 'Date',
                            // 'value' => $model->burs_date == null ? date('Y-m-d') : $model->burs_date,
                        ],
                        'pluginOptions' => [
                        'autoclose' => true,
                        'todayHighlight' => true,
                        'format' => 'yyyy-mm-dd'
                            ]
                    ])->label('Date of Receipt'); ?>
                </td>
                <td>
                    <?= $form->field($model, 'nca_amount')->textInput(['maxlength' => true, 'value' => $model->nca_amount == null ? 0.0 : $model->nca_amount, 'style' => 'text-align: right;'])->label('Amount') ?>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <?= $form->field($model, 'nca_reference')->textInput(['maxlength' => true, 'placeholder' => 'Any receipt (e.g. NCA No.)']) ?>
                </td>
            </tr>
        </table>
    </div>
    <br>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
