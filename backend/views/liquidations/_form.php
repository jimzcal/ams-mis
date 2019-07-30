<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\date\DatePicker;
use backend\models\Obligations;
use backend\models\Disbursements;

/* @var $this yii\web\View */
/* @var $model backend\models\Liquidations */
/* @var $form yii\widgets\ActiveForm */
?>
<style type="text/css">
    td{
        padding-right: 3px;
    }
</style>
<div class="liquidations-form">

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

                                $("#liquidations-ors_date").val(data);

                            });
                            $.post("dv?ors_no='.'"+$(this).val(),function(data){

                                $("select#liquidations-dv_no").html(data);

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
            <td colspan="2">
                <?= $form->field($model, 'dv_no')->widget(Select2::classname(), [
                    'data' => ArrayHelper::map(Disbursements::find()->where(['operating_unit' => Yii::$app->user->identity->region])->andWhere(['project_id' => $project_id])->all(),'dv_no', 'dv_no'),
                    'options' => [
                        'prompt' => 'Select DV No.',
                        'multiple' => false,
                        ],
                    ]);
                ?>
            </td>
        </tr>
        <tr>
            <td>
                <?= $form->field($model, 'liquidation_date')->widget(DatePicker::classname(), [
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
            <td>
                <?= $form->field($model, 'amount')->textInput(['maxlength' => true, 'style' => 'text-align: right; font-weight: bold;', 'value' => $model->amount != 0.00 ? $model->amount : 0.00]) ?>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <?= $form->field($model, 'status')->dropdownList(['Confirmed' => 'Confirmed', 'Returned' => 'Returned']) ?>
            </td>
        </tr>
    </table>

    <?= $form->field($model, 'project_id')->hiddenInput(['value' => $project_id])->label(false) ?>

    <?= $form->field($model, 'operating_unit')->hiddenInput(['maxlength' => true, 'value' => Yii::$app->user->identity->region])->label(false) ?>

   <!--  <div style="width: 100%; border-top: solid 1px #ccc; padding-top: 5px">
        <p>
            Note: 
        </p>

        <p>
           
        </p>
    </div> -->

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
