<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use backend\models\Obligations;

/* @var $this yii\web\View */
/* @var $model backend\models\Disbursements */
/* @var $form yii\widgets\ActiveForm */
?>
<style type="text/css">
    table td{
        padding-right: 3px;
    }
</style>

<div class="disbursements-form">

    <?php $form = ActiveForm::begin(); ?>

    <table style="width: 100%;">
        <tr>
            <td style="width: 70%;">
                <?= $form->field($model, 'ors_no')->widget(Select2::classname(), [
                    'data' => ArrayHelper::map(Obligations::find()->where(['operating_unit' => Yii::$app->user->identity->region])->andWhere(['project_id' => $project_id])->groupBy(['ors_no'])->all(),'ors_no', 'ors_no'),
                    'options' => [
                        'prompt' => 'Select ORS No.',
                        'multiple' => false,
                        'onchange'=>'
                             $.post("ors?ors_no='.'"+$(this).val(),function(data){

                                $("#disbursements-ors_date").val(data);

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
                <?= $form->field($model, 'ors_date')->widget(DatePicker::classname(), [
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
                        'value' => $model->dv_date == null ? date('Y-m-d') : $model->dv_date,
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
                <?= $form->field($model, 'reference')->textInput(['placeholder' => 'Reference No. (Check / LDDAP-ADA No.)'])->label('Proof of payment'); ?>
            </td>
            <td>
                <?= $form->field($model, 'reference_date')->widget(DatePicker::classname(), [
                    'options' => [
                        // 'class' => 'new-textfield',
                        'placeholder' => 'Reference Date',
                        'value' => $model->reference_date == null ? date('Y-m-d') : $model->reference_date,
                    ],
                    'pluginOptions' => [
                    'autoclose' => true,
                    'todayHighlight' => true,
                    'format' => 'yyyy-mm-dd'
                        ]
                ])->label('Date Disbursed'); ?>
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

</div>
