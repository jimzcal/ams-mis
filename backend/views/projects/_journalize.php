<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use backend\models\NationalAgency;
use backend\models\ImplementingAgency;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Projects */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="projects-form">

    <?php $form = ActiveForm::begin(); ?>

    <div style="color: #fff; border-bottom: solid 2px #fff; text-align: right; padding-top: 13px;">
        <h3>PROJECTS</h3>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <div style="width: 85%; min-height: 400px; padding: 10px; background-color: #0099cc; opacity: .95; margin-right: auto; margin-left: auto; display: block;">
                <div style="background-color: #33ccff; width: 100%; padding: 12px; color: #fff; border: solid 1px #00ace6;">
                    <span class="fa fa-pen" style="color: green; text-shadow: 2px 2px 2px #fff; font-size: 20px;"></span> <?= $model->project_title ?> | 
                    <?= $model->department ?> | <?= $model->agency ?> | <?= $model->operating_office ?>
                </div><br>

                <table style="width: 30%; opacity: .9;">
                    <tr>
                        <td style="width: 40%; color: #fff; vertical-align: middle;">Fiscal Year</td>
                        <td>
                            <?= $form->field($new_model, 'year')->textInput(['value' => date('Y')])->label(false) ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="color: #fff; vertical-align: middle;">Quarter</td>
                        <td>
                            <?= $form->field($new_model, 'quarter')->dropdownList(['1' => 'First', '2' => 'Second', '3' => 'Third', '4' => 'Fourth'])->label(false) ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="color: #fff; vertical-align: middle;">
                            Fund Cluster
                        </td>
                        <td>
                            <?= $form->field($new_model, 'fund_cluster')->dropdownList(['01' => '01 - Regular Agency Fund', '02' => '02 - Foreign Assisted Project Fund', '03' => '03 - Special Fund (Loacally Funded)', '04' => '04 - Special Account (Foreign Assisted)'])->label(false) ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="color: #fff; vertical-align: middle;">
                            Appropriation Type
                        </td>
                        <td>
                            <?= $form->field($new_model, 'appropriation_type')->dropdownList(['Current' => 'Current Year Appropriation', 'Supplemental' => 'Supplemental', 'Supplemental Appropriation', 'Continuing' => 'Continuing Appropriation'])->label(false) ?>
                        </td>
                    </tr>
                </table>
                
                <table style="width: 100%" id="tbl2">
                    <tr>
                        <td colspan="4" style="text-align: right;">
                            <button style="font-size: 13px; margin: 5px;" class="btn btn-default btn-right" type="button" onclick="myFunction()" >
                            <i class="glyphicon glyphicon-plus"></i> Add Field
                        </button>
                        </td>
                    </tr>
                    <tr>
                        <th>ORS No.</th>
                        <th>ORS Date.</th>
                        <th>Obligation</th>
                        <th>Disbursement</th>
                        <th>Liquidation</th>
                    </tr>
                    <tr id="tbl-tr">
                        <td style="padding-right: 3px;">
                            <?= $form->field($new_model, 'ors_no[]')->textInput(['maxlength' => true])->label(false) ?>
                        </td>
                        <td style="padding-right: 3px;">
                            <?= $form->field($new_model, 'ors_date[]')->widget(DatePicker::classname(), [
                                'options' => [
                                    // 'class' => 'new-textfield',
                                    'placeholder' => 'Date',
                                    'value' => date('Y-m-d'),
                                ],

                                'pluginOptions' => [
                                'autoclose' => true,
                                'todayHighlight' => true,
                                'format' => 'yyyy-mm-dd'
                                    ]
                            ])->label(false); ?>
                        </td>
                        <td style="padding-right: 3px;">
                            <?= $form->field($new_model, 'obligation[]')->textInput(['maxlength' => true, 'style' => 'text-align: right', 'value' => 0.00])->label(false) ?>
                        </td>
                        <td style="padding-right: 3px;">
                            <?= $form->field($new_model, 'disbursement[]')->textInput(['maxlength' => true, 'style' => 'text-align: right', 'value' => 0.00])->label(false) ?>
                        </td>
                        <td style="padding-right: 3px;">
                            <?= $form->field($new_model, 'liquidation[]')->textInput(['maxlength' => true, 'style' => 'text-align: right', 'value' => 0.00])->label(false) ?>
                        </td>
                    </tr>
                </table>

                <div class="form-group">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                </div>
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