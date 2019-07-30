<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\date\DatePicker;
use backend\models\RegistryBudgetutilization;

/* @var $this yii\web\View */
/* @var $model backend\models\DueDemandables */
/* @var $form yii\widgets\ActiveForm */
?>

<style type="text/css">
    table td{
        padding-right: 3px;
    }
</style>

<div class="due-demandables-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'project_id')->hiddenInput(['value' => $project_id])->label(false) ?>

    <?= $form->field($model, 'operating_unit')->textInput(['maxlength' => true, 'value' => Yii::$app->user->identity->region, 'readOnly' => true]) ?>

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

                                $("#duedemandables-burs_date").val(data);

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
                <?= $form->field($model, 'reference')->textInput(['maxlength' => true]) ?>
            </td>
            <td>
                <?= $form->field($model, 'reference_date')->widget(DatePicker::classname(), [
                    'options' => [
                        // 'class' => 'new-textfield',
                        'placeholder' => 'Reference Date',
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
            <td colspan="2">
                <?= $form->field($model, 'amount')->textInput(['maxlength' => true, 'style' => 'width: 200px; text-align: right;']) ?>
            </td>
        </tr>
        <tr>
            <td colspan="">
                <div class="form-group">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                </div>
            </td>
        </tr>
    </table>

    <?php ActiveForm::end(); ?>

</div>
