<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use backend\models\Transaction;

/* @var $this yii\web\View */
/* @var $model backend\models\Disbursement */
/* @var $form yii\widgets\ActiveForm */
?>
<style type="text/css">
    .disbursement-table td{
        padding-right: 2px;
    }
</style>
<div class="disbursement-form">

    <?php $form = ActiveForm::begin(); ?>
    <br>
    <div style="margin-right: auto; margin-left: auto; display: block; width: 75%;">
        <table style="width: 100%;" class="disbursement-table">
            <tr>
                <td style="width: 50%;">
                     <?= $form->field($model, 'payee')->textInput(['maxlength' => true, 'style' => 'text-transform: uppercase;']) ?>
                </td>
                <td style="width: 20%;">
                    <?= $form->field($model, 'dv_no')->textInput(['value' => $model->getDvno()]) ?>
                </td>
                <td style="width: 30%;">
                    <?= $form->field($model, 'date')->widget(DatePicker::classname(), [
                            'options' => [
                                'value' => date('Y-m-d'),
                                'placeholder' => 'Date',
                                // 'autofocus' => 'autofocus',
                            ],

                            'pluginOptions' => [
                            'autoclose'=>true,
                            'todayHighlight' => true,
                            'format' => 'yyyy-m-d'
                                ]
                        ]); ?>
                </td>
            </tr>
            <tr>
                <td rowspan="2" colspan="2" style="vertical-align: top;">
                    <?= $form->field($model, 'particulars')->textarea(['rows' => 16]) ?>
                </td>
                <td>
                   <?= $form->field($model, 'fund_cluster')->dropdownList(['01' => '101 - REgular Agency Fund', '102' => '102 - Foreign Assisted Project Fund', '103' => '103 - Special Account (Locally Funded)', '104' => '104 - Special Account (Foreign Assited)']) ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?= $form->field($model, 'gross_amount')->textInput(['maxlength' => true, 'style' => 'text-align: right; font-weight: bold;', 'value' => 0.00]) ?>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <?= $form->field($model, 'transaction')->dropDownList(ArrayHelper::map(transaction::find()->all(),'id', 'name'))->label(false) ?>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <?= $form->field($model, 'status')->dropdownList(['Received' => 'Received', 'Cancelled' => 'Cancelled', 'Return to payee' => 'Return to payee']) ?>
                </td>
            </tr>
        </table>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
