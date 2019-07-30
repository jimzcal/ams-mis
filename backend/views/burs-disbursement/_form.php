<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use backend\models\RegistryBudgetutilization;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\BursDisbursement */
/* @var $form yii\widgets\ActiveForm */
?>
<style type="text/css">
    table td{
        padding-right: 3px;
    }
</style>

<div class="burs-disbursement-form">

    <?php $form = ActiveForm::begin(); ?>

    <table style="width: 100%;">
        <tr>
            <td style="width: 70%;">
                <?= $form->field($model, 'burs_no')->widget(Select2::classname(), [
                    'data' => ArrayHelper::map(RegistryBudgetutilization::find()->where(['operating_unit' => Yii::$app->user->identity->region])->andWhere(['project_id' => $project_id])->groupBy(['burs_no'])->all(),'burs_no', 'burs_no'),
                    'options' => [
                        'prompt' => 'Select BURS No.',
                        'multiple' => false,
                        'onchange'=>'
                             $.post("burs?burs_no='.'"+$(this).val(),function(data){

                                $("#bursdisbursement-burs_date").val(data);

                            });'
                        ],
                    'pluginOptions' => [
                        'tags' => true,
                        'tokenSeparators' => [';'],
                    ],
                    ]);
                ?>
            </td>
            <td>
                <?= $form->field($model, 'burs_date')->widget(DatePicker::classname(), [
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
                ]); ?>
            </td>
        </tr>
        <tr>
            <td>
                <?= $form->field($model, 'dv_no')->textInput() ?>
            </td>
            <td>
                <?= $form->field($model, 'dv_date')->widget(DatePicker::classname(), [
                    'options' => [
                        // 'class' => 'new-textfield',
                        'placeholder' => 'Date',
                        'value' => $model->dv_no == null ? date('Y-m-d') : $model->dv_no,
                    ],
                    'pluginOptions' => [
                    'autoclose' => true,
                    'todayHighlight' => true,
                    'format' => 'yyyy-mm-dd'
                        ]
                ]); ?>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <?= $form->field($model, 'amount')->textInput(['maxlength' => true, 'style' => 'width: 230px; font-weight: bold; text-align: right;', 'value' => $model->amount == null ? 0.00 : $model->amount]) ?>
            </td>
        </tr>
    </table>
    <?= $form->field($model, 'project_id')->hiddenInput(['value' => $project_id])->label(false) ?>
    
    <?= $form->field($model, 'operating_unit')->hiddenInput(['value' => Yii::$app->user->identity->region])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>