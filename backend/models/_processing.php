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

    <div class="row">
        <div class="col-md-3">
            <div style="width: 100%; min-height: 500px; padding: 10px; background-color: #0099cc;">
                <div style="background-color: #ccffff; width: 100%; padding: 12px; color: #595959; border: solid 1px #00ace6;">
                    <span class="fa fa-map-signs" style="color: green; text-shadow: 2px 2px 2px #fff; font-size: 20px;"></span> DV FLOW INDICATOR
                </div><br>

                <div class="locator">
                    <table style="width: 100%; color: #fff;">
                        <tr>
                            <td style="width: 7%; opacity: <?= $model->getStatus($model->dv_no, 'Receiving') != null ? 1 : .5 ; ?>">
                                <span class="fa fa-map-marker" style="color: #fff; font-size: 22px; text-shadow: 2px 2px 2px 3px green"></span>
                            </td>
                            <td style="width: 40%; vertical-align: middle; padding-right: 5px; opacity: <?= $model->getStatus($model->dv_no, 'Receiving') != null ? 1 : .5 ; ?>; font-weight: bold;">
                                 RECEIVING
                            </td>
                            <td>
                                <?= $model->getStatus($model->dv_no, 'Receiving') != null ? $model->getStatus($model->dv_no, 'Receiving')->employee : ''; ?>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>
                                <?= $model->getStatus($model->dv_no, 'Receiving') != null ? $model->getStatus($model->dv_no, 'Receiving')->date : ''; ?>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="locator">
                    <table style="width: 100%; color: #fff;">
                        <tr>
                            <td style="width: 7%; opacity: <?= $model->getStatus($model->dv_no, 'Processing') != null ? 1 : .5 ; ?>">
                                <span class="fa fa-map-marker" style="color: #fff; font-size: 22px; text-shadow: 2px 2px 2px 3px green"></span>
                            </td>
                            <td style="width: 40%; vertical-align: middle; padding-right: 5px; opacity: <?= $model->getStatus($model->dv_no, 'Processing') != null ? 1 : .5 ; ?>; font-weight: bold;">
                                 PROCESSING
                            </td>
                            <td>
                                <?= $model->getStatus($model->dv_no, 'Processing') != null ? $model->getStatus($model->dv_no, 'Processing')->employee : ''; ?>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>
                                <?= $model->getStatus($model->dv_no, 'Processing') != null ? $model->getStatus($model->dv_no, 'Processing')->date : ''; ?>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="locator">
                    <table style="width: 100%; color: #fff;">
                        <tr>
                            <td style="width: 7%; opacity: <?= $model->getStatus($model->dv_no, 'Verifying') != null ? 1 : .5 ; ?>">
                                <span class="fa fa-map-marker" style="color: #fff; font-size: 22px; text-shadow: 2px 2px 2px 3px green"></span>
                            </td>
                            <td style="width: 40%; vertical-align: middle; padding-right: 5px; opacity: <?= $model->getStatus($model->dv_no, 'Verifying') != null ? 1 : .5 ; ?>; font-weight: bold;">
                                 VERIFYING
                            </td>
                            <td>
                                <?= $model->getStatus($model->dv_no, 'Verifying') != null ? $model->getStatus($model->dv_no, 'Verifying')->employee : ''; ?>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>
                                <?= $model->getStatus($model->dv_no, 'Verifying') != null ? $model->getStatus($model->dv_no, 'Verifying')->date : ''; ?>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="locator">
                    <table style="width: 100%; color: #fff;">
                        <tr>
                            <td style="width: 7%; opacity: <?= $model->getStatus($model->dv_no, 'NCA Controlling') != null ? 1 : .5 ; ?>">
                                <span class="fa fa-map-marker" style="color: #fff; font-size: 22px; text-shadow: 2px 2px 2px 3px green"></span>
                            </td>
                            <td style="width: 40%; vertical-align: middle; padding-right: 5px; opacity: <?= $model->getStatus($model->dv_no, 'NCA Controlling') != null ? 1 : .5 ; ?>; font-weight: bold;">
                                 NCA Control
                            </td>
                            <td>
                                <?= $model->getStatus($model->dv_no, 'NCA Controlling') != null ? $model->getStatus($model->dv_no, 'NCA Controlling')->employee : ''; ?>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>
                                <?= $model->getStatus($model->dv_no, 'NCA Controlling') != null ? $model->getStatus($model->dv_no, 'NCA Controlling')->date : ''; ?>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="locator">
                    <table style="width: 100%; color: #fff;">
                        <tr>
                            <td style="width: 7%; opacity: <?= $model->getStatus($model->dv_no, 'Indexing') != null ? 1 : .5 ; ?>">
                                <span class="fa fa-map-marker" style="color: #fff; font-size: 22px; text-shadow: 2px 2px 2px 3px green"></span>
                            </td>
                            <td style="width: 40%; vertical-align: middle; padding-right: 5px; opacity: <?= $model->getStatus($model->dv_no, 'Indexing') != null ? 1 : .5 ; ?>; font-weight: bold;">
                                 Indexing
                            </td>
                            <td>
                                <?= $model->getStatus($model->dv_no, 'Indexing') != null ? $model->getStatus($model->dv_no, 'Indexing')->employee : ''; ?>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>
                                <?= $model->getStatus($model->dv_no, 'Indexing') != null ? $model->getStatus($model->dv_no, 'Indexing')->date : ''; ?>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="locator">
                    <table style="width: 100%; color: #fff;">
                        <tr>
                            <td style="width: 7%; opacity: <?= $model->getStatus($model->dv_no, 'Preparing ADA') != null ? 1 : .5 ; ?>">
                                <span class="fa fa-map-marker" style="color: #fff; font-size: 22px; text-shadow: 2px 2px 2px 3px green"></span>
                            </td>
                            <td style="width: 40%; vertical-align: middle; padding-right: 5px; opacity: <?= $model->getStatus($model->dv_no, 'Preparing ADA') != null ? 1 : .5 ; ?>; font-weight: bold;">
                                 ADA Preparation
                            </td>
                            <td>
                                <?= $model->getStatus($model->dv_no, 'Preparing ADA') != null ? $model->getStatus($model->dv_no, 'Preparing ADA')->employee : ''; ?>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>
                                <?= $model->getStatus($model->dv_no, 'Preparing ADA') != null ? $model->getStatus($model->dv_no, 'Preparing ADA')->date : ''; ?>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="locator">
                    <table style="width: 100%; color: #fff;">
                        <tr>
                            <td style="width: 7%; opacity: <?= $model->getStatus($model->dv_no, 'Client') != null ? 1 : .5 ; ?>">
                                <span class="fa fa-map-marker" style="color: #fff; font-size: 22px; text-shadow: 2px 2px 2px 3px green"></span>
                            </td>
                            <td style="width: 40%; vertical-align: middle; padding-right: 5px; opacity: <?= $model->getStatus($model->dv_no, 'Releasing') != null ? 1 : .5 ; ?>; font-weight: bold;">
                                 Releasing
                            </td>
                            <td>
                                <?= $model->getStatus($model->dv_no, 'Releasing') != null ? $model->getStatus($model->dv_no, 'Releasing')->employee : ''; ?>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>
                                <?= $model->getStatus($model->dv_no, 'Releasing') != null ? $model->getStatus($model->dv_no, 'Releasing')->date : ''; ?>
                            </td>
                        </tr>
                    </table>
                </div>

            </div>
        </div>
        <div class="col-md-6">
            <div style="margin-right: auto; margin-left: auto; display: block;">
                <table style="width: 100%;" class="disbursement-table">
                    <tr>
                        <td style="width: 50%;">
                             <?= $form->field($model, 'payee')->textInput(['maxlength' => true, 'style' => 'text-transform: uppercase;']) ?>
                        </td>
                        <td style="width: 20%;">
                            <?= $form->field($model, 'dv_no')->textInput() ?>
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
                            <?= $form->field($model, 'particulars')->textarea(['rows' => 16, 'style' => 'padding: 5px;']) ?>
                        </td>
                        <td>
                           <?= $form->field($model, 'net_amount')->textInput(['maxlength' => true, 'style' => 'text-align: right; font-weight: bold;']) ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?= $form->field($model, 'gross_amount')->textInput(['maxlength' => true, 'style' => 'text-align: right; font-weight: bold;']) ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <?= $form->field($model, 'transaction')->dropDownList(ArrayHelper::map(transaction::find()->all(),'id', 'name'))->label(false) ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <?= $form->field($model, 'status')->dropdownList(['Received' => 'Received', 'Cancelled' => 'Cancelled', 'Processed' => 'Processed', 'Verified' => 'Verified', 'NCA Controlled' => 'NCA Controlled', 'For Release' => 'For Release', 'Return to payee' => 'Return to payee']) ?>
                        </td>
                    </tr>
                </table>
                <table style="width: 100%;">
                    <tr>
                        <td style="font-weight: bold;">REMARKS</td>
                    </tr>
                    <tr>
                        <td style="padding: 5px;">
                            <?php foreach ($remarks as $key => $remark) : ?>
                                <div class="alert alert-success" role="alert" style="padding: 3px;">
                                    <table style="width: 100%;">
                                        <tr>
                                            <td style="width: 30%; text-align: right; border-right: solid 1px; padding: 5px;"><?= $remark->name->fullname.'<br>'.$remark->date ?></td>
                                            <td style="padding-left: 5px; vertical-align: top;">
                                                <?= $remark->remarks ?>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            <?php endforeach ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?= $form->field($model, 'remarks')->textarea(['rows' => 6, 'style' => 'padding: 5px;', 'value' => $check_remark == null ? '' : $check_remark->remarks])->label(false) ?>
                        </td>
                    </tr>
                </table>

                <div class="form-group">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div style="width: 100%; min-height: 500px; padding: 10px; background-color: #0099cc" id="no-print">
                <div style="background-color: #33ccff; width: 100%; padding: 12px; color: #fff; border: solid 1px #00ace6;">
                    <span class="fa fa-paperclip" style="color: green; text-shadow: 2px 2px 2px #fff; font-size: 20px;"></span> ATTACHMENTS
                </div><br>
                <div>
                    <?php foreach ($attachments as $key => $val) : ?>
                        <?php if($val != '') : ?>
                            <input type="checkbox" checked="true" name="requirements[<?= $val ?>]" value="<?= $val ?>">
                            <label style="font-size: 10px;"><?= ($key+1).') '. mb_strimwidth($val, 0, 50, ' ...') ?></label><br>
                        <?php endif ?>
                    <?php endforeach ?>

                    <?php foreach ($lacking as $key => $lack) : ?>
                        <input type="checkbox" name="requirements[<?= $lack ?>]" value="<?= $lack ?>">
                        <label style="font-size: 10px;"><?= ($key + 1).') '. mb_strimwidth($lack, 0, 50, ' ...') ?></label><br>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>
    
    <?php ActiveForm::end(); ?>
</div>