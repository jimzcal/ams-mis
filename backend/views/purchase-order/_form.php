<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use dosamigos\ckeditor\CKEditor;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model backend\models\PurchaseOrder */
/* @var $form yii\widgets\ActiveForm */
?>
<style type="text/css">
    #tbl-po td{
        padding-right: 3px;
    }

    #attachments{
        display: <?= $model->attachments != null ? 'block;' : 'none'; ?>
    }
</style>
<?php
    $data = ["Inspection & Acceptance Report" => "Inspection & Acceptance Report", "Delivery Receipt" => "Delivery Receipt", "Approved PO" => "Approved PO", "Sales Invoice" => "Sales Invoice"];
?>
<div class="purchase-order-form">

    <?php $form = ActiveForm::begin(); ?>

    <table style="width: 100%;" id="tbl-po">
        <tr>
            <td style="width: 40%">
                <?= $form->field($model, 'supplier')->textInput(['maxlength' => true, 'style' => 'text-transform: uppercase;']) ?>
            </td>
            <td style="width: 30%">
                <?= $form->field($model, 'po_no')->textInput(['maxlength' => true]) ?>
            </td>
            <td>
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
            <td colspan="3">
                <?= $form->field($model, 'description')->widget(CKEditor::className(), [
                    'options' => ['rows' => 30],
                    'preset' => 'basic',
                ]) ?>
            </td>
        </tr>
        <tr>
            <td>
                <?= $form->field($model, 'mode_procurement')->textInput(['maxlength' => true]) ?>
            </td>
            <td>
                <?= $form->field($model, 'tin')->textInput(['maxlength' => true]) ?>
            </td>
            <td>
                <?= $form->field($model, 'payment_term')->textInput() ?>
            </td>
        </tr>
        <tr>
            <td>
                <?= $form->field($model, 'fund_cluster')->dropdownList(['01' => '01 - Regular Agency Fund', '02' => '02 - Foreign Assisted Project Fund', '103' => '103 - Special Account (Locally Funded)', '04' => '04 - Special Account (Foreign Assited)']) ?>
            </td>
            <td>
                <?= $form->field($model, 'date_recived')->widget(DatePicker::classname(), [
                    'options' => [
                        'value' => date('Y-m-d'),
                        'placeholder' => 'Date Receieved',
                        // 'autofocus' => 'autofocus',
                    ],

                    'pluginOptions' => [
                    'autoclose'=>true,
                    'todayHighlight' => true,
                    'format' => 'yyyy-m-d'
                        ]
                ]); ?>
            </td>
            <td>
                <?= $form->field($model, 'total_amount')->textInput(['value' => $model->total_amount == null ? 0.00 : $model->total_amount, 'style' => 'text-align: right; font-weight: bold;']) ?>
            </td>
        </tr>
        <tr id="attachments">
            <td colspan="3">
                <?= $form->field($model, 'attachments[]')->widget(Select2::classname(), [
                        'data' => $data,
                        'options' => [
                            'multiple' => true,
                            'value' => $model->attachments != null ? explode(';', $model->attachments) : '',
                        ],
                            'pluginOptions' => [
                                'tags' => true,
                                'tokenSeparators' => [';'],
                            ],
                    ]);
                ?>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <?= $form->field($model, 'status')->dropdownList(['Received' => 'Received', 'Signed' => 'Signed', 'Return to End-User' => 'Return to End-User', 'Approved' => 'Approved', 'Payable' => 'Payable', 'Disbursed' => 'Disbursed', 'Paid' => 'Paid']) ?>
            </td>
        </tr>
    </table>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

<script>
window.onload = function()
{
    $(document).on("change", "select[id='purchaseorder-status']", function () { 
        // alert($(this).val())
        // $modal = $('#newModal');
        if($(this).val() == 'Approved'){
            // $modal.modal('show');
            $('#attachments').show();
        }
    });
}
</script>