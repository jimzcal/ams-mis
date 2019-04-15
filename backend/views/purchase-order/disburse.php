<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use dosamigos\ckeditor\CKEditor;
use yii\widgets\DetailView;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use backend\models\Disbursement;

/* @var $this yii\web\View */
/* @var $model backend\models\PurchaseOrder */
/* @var $form yii\widgets\ActiveForm */
$this->title = $model->po_no;
?>
<style type="text/css">
    #tbl-po td{
        padding-right: 3px;
    }
</style>

<div class="purchase-order-form">

    <?php $form = ActiveForm::begin(); ?>

    <div style="color: #fff; border-bottom: solid 2px #fff; text-align: right; padding-top: 13px;" id="no-print">
        <h3>DISBURSE PURCHASE ORDER</h3>
    </div>
    <br>
    <div class="row">
        <div class="col-md-3">
            <div style="width: 100%; min-height: 420px; padding: 10px; background-color: #0099cc">
                <div style="background-color: #33ccff; width: 100%; padding: 12px; color: #fff; border: solid 1px #00ace6;">
                    <span class="fa fa-pen" style="color: green; text-shadow: 2px 2px 2px #fff; font-size: 20px;"></span> DISBURSEMENT OF PO
                </div><br>
            <table style="width: 100%;">
                <tr>
                    <td>
                        <?= $form->field($new_model, 'dv_date')->widget(DatePicker::classname(), [
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
                    <td>
                        <?= $form->field($model, 'dv_no')->widget(Select2::classname(), [
                            'data' => ArrayHelper::map(Disbursement::find()->all(),'dv_no', 'dv_no'),
                            'options' => ['placeholder' => 'Select DV No.', 
                            'multiple' => false],
                            // 'pluginOptions' => [
                            //     'tags' => false,
                            //     'tokenSeparators' => [';'],
                            // ],
                        ]);
                        ?>

                        <?= $form->field($new_model, 'po_no')->hiddenInput(['value' => $model->po_no])->label(false) ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?= $form->field($new_model, 'amount')->textInput(['value' => 0.00, 'style' => 'text-align: right;']) ?>
                    </td>
                </tr>
            </table>
                <div class="form-group">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div style="background-color: #fff; width: 100%; font-size: 13px; margin-right: auto; margin-left: auto; border-radius: 5px;">
                <div style="width: 100%; border-top-right-radius: 5px; border-top-left-radius: 5px; background-color: #e6e6e6; height: 30px; padding: 5px; line-height: 20px; color: #4d4d4d">
                    PURCHASE ORDER
                </div>

                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        //'id',
                        'date',
                        'po_no',
                        'supplier',
                        'tin',
                        'mode_procurement',
                        //'payment_term',
                        //'description:ntext',
                        [
                            'attribute' => 'description',
                            'format' => 'Html',
                            'options' => ['class' => 'content'],
                            'value' => function($data)
                            {
                                return $data->description;
                            }
                        ],
                        [
                            'attribute' => 'total_amount',
                            'value' => function($val)
                            {
                                return number_format($val->total_amount, 2);
                            }
                        ], 
                    ],
                ]) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
