<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\Ors */
/* @var $form yii\widgets\ActiveForm */
?>

<style type="text/css">
    #tbl td{
        padding-right: 3px;
    }

    #tb2 td{
        padding-right: 3px;
    }
</style>

<div class="ors-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-3">
            <div style="width: 100%; min-height: 400px; padding: 10px; background-color: #0099cc">
                <div style="background-color: #33ccff; width: 100%; padding: 12px; color: #fff; border: solid 1px #00ace6;">
                    <span class="fa fa-info" style="color: green; text-shadow: 2px 2px 2px #fff; font-size: 20px;"></span> INSTRUCTIONS
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <table style="width: 100%; margin-right: auto; margin-left: auto; display: block;" id="tbl">
                <tr>
                    <td style="width: 50%;">
                        <?= $form->field($model, 'region')->textInput(['maxlength' => true, 'value' => Yii::$app->user->identity->region, 'readOnly' => true]) ?>
                    </td>
                    <td style="width: 30%;">
                        <?= $form->field($model, 'sub_office')->textInput(['maxlength' => true]) ?>
                    </td>
                    <td>
                        <?= $form->field($model, 'date')->widget(DatePicker::classname(), [
                            'options' => [
                                // 'class' => 'new-textfield',
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
                    <td colspan="3">
                        <table style="width: 100%;">
                            <tr>
                                <td>
                                    <?= $form->field($model, 'ors_class')->textInput(['maxlength' => true]) ?>
                                </td>
                                <td>
                                    <?= $form->field($model, 'funding_source')->textInput(['maxlength' => true]) ?>
                                </td>
                                <td>
                                    <?= $form->field($model, 'ors_year')->textInput(['maxlength' => true]) ?>
                                </td>
                                <td>
                                    <?= $form->field($model, 'ors_month')->textInput(['maxlength' => true]) ?>
                                </td>
                                <td>
                                    <?= $form->field($model, 'ors_serial')->textInput(['maxlength' => true]) ?>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <?= $form->field($model, 'particulars')->textarea(['rows' => 10]) ?>
                    </td>
                    <td style="vertical-align: top;">
                        <?= $form->field($model, 'appropriation_class')->dropdownList(['Current' => 'Current', 'Supplemental' => 'Supplemental', 'Continuing' => 'Continuing'])->label('Appropriation Type') ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="text-align: right;">
                        <button style="font-size: 13px; margin: 5px;" class="btn btn-default btn-right" type="button" onclick="myFunction()" >
                            <i class="glyphicon glyphicon-plus"></i> Add Field
                        </button>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <table style="width: 100%;" id="tbl2">
                            <tr id="tbl-tr">
                                <td>
                                    <?= $form->field($model, 'rc[]')->textInput(['maxlength' => true]) ?>
                                </td>
                                <td>
                                    <?= $form->field($model, 'mfo_pap[]')->textInput(['maxlength' => true]) ?>
                                </td>
                                <td>
                                    <?= $form->field($model, 'object_code[]')->textInput(['maxlength' => true]) ?>
                                </td>
                                <td>
                                    <?= $form->field($model, 'obligation[]')->textInput(['maxlength' => true, 'style' => 'text-align: right;', 'value' => 0.00]) ?>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </table>

            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>

<script>
function myFunction() {
    var tr = document.getElementById("tbl-tr");
    var cln = tr.cloneNode(true);
    // document.getElementById("myTable").appendChild(cln);
    cln.id = "tbl2"; // change id or other attributes/contents
    // table.appendChild(clone); // add new row to end of table
    document.getElementById("tbl2").appendChild(cln);
}
</script>
