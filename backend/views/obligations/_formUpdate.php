<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\Obligations */
/* @var $form yii\widgets\ActiveForm */
?>
<style type="text/css">
    td{
        padding-right: 3px;
    }
</style>
<div class="obligations-form">

    <?php $form = ActiveForm::begin(); ?>
    <table style="width: 100%;">
        <tr>
            <td style="width: 40%;">
                <?= $form->field($model, 'ors_no')->textInput(['maxlength' => true, 'placeholder' => 'e.g, 01-1010110-2019-01-001']) ?>
            </td>
            <td>
                <?= $form->field($model, 'appropriation_class')->dropdownList(['1' => '', 'Supplemental' => 'Supplemental Appropriation', 'Continuing' => 'Continuing Appropriation']) ?>
            </td>
            <td>
                <?= $form->field($model, 'ors_date')->widget(DatePicker::classname(), [
                    'options' => [
                        // 'class' => 'new-textfield',
                        'placeholder' => 'ORS Date',
                        'value' => $model->ors_date == null ? date('Y-m-d') : $model->ors_date,
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
                <?php echo $form->field($model, 'payee')->textInput(['maxlength' => true]) ?>
            </td>
            <td>
                <?php  echo $form->field($model, 'fund_cluster')->dropdownList(['01' => '01 - Regular Agency Fund', '02' => '02 - Foreign Assisted Project Fund', '03' => '03 - Special Account (Locally Assisted)', '04' => '04 - Special Account (Foreign Assisted)', '07' => 'Trust Receipts']) ?>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <?= $form->field($model, 'particulars')->textarea(['rows' => 10]) ?>
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
            <th>RC</th>
            <th>MFO-PAP</th>
            <th>UACS</th>
            <th>Amount</th>
        </tr>
        <?php foreach ($data as $key => $value) : ?>
            <?= $form->field($model, 'ids[]')->hiddenInput(['value' => $value->id])->label(false) ?>
        <tr id="tbl-tr">
            <td>
                <?= $form->field($model, 'rc[]')->textInput(['maxlength' => true, 'value' => $value->rc])->label(false) ?>
            </td>
            <td>
                <?= $form->field($model, 'mfo_pap[]')->textInput(['maxlength' => true, 'value' => $value->mfo_pap])->label(false) ?>
            </td>
            <td>
                <?= $form->field($model, 'object_code[]')->textInput(['maxlength' => true, 'value' => $value->object_code])->label(false) ?>
            </td>
            <td>
                <?= $form->field($model, 'amount[]')->textInput(['maxlength' => true, 'value' => $value->amount, 'style' => 'text-align: right; font-weight: bold;'])->label(false) ?>
            </td>
        </tr>
        <?php endforeach ?>
    </table>

    <?= $form->field($model, 'operating_unit')->hiddenInput(['maxlength' => true, 'value' => Yii::$app->user->identity->region])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
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