<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\Ors */

$this->title = 'ORS - '.$model->title;
// $this->params['breadcrumbs'][] = ['label' => 'Ors', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<style type="text/css">
    .help-block{
        margin: 0px !important;
    }
    .form-group{
        margin: 0px !important;
    }
</style>
<div class="ors-view">
    <?php $form = ActiveForm::begin(); ?>

     <div style="color: #fff; border-bottom: solid 2px #fff; text-align: right; padding-top: 13px;">
        <h3>LIQUIDATION OF PROJECT</h3>
    </div>
    <br>
    <div class="row">
        <div class="col-md-3">
            <div style="width: 100%; min-height: 400px; padding: 10px; background-color: #0099cc">
                <div style="background-color: #33ccff; width: 100%; padding: 12px; color: #fff; border: solid 1px #00ace6;">
                    <span class="fa fa-pen" style="color: green; text-shadow: 2px 2px 2px #fff; font-size: 20px;"></span> SELECT ACTION
                </div><br>
                <?= Html::a('OBLIGATE', ['obligate', 'id' => $model->id], ['class' => 'btn btn-primary', 'style' => 'width: 100%; display: inline-block; margin-bottom: 5px;']) ?>
                <br>
                <?= Html::a('DISBURSE', ['update', 'id' => $model->id], ['class' => 'btn btn-primary', 'style' => 'width: 100%; display: inline-block; margin-bottom: 5px;']) ?>
                <br>
                <?= Html::a('LIQUIDATE', ['update', 'id' => $model->id], ['class' => 'btn btn-primary', 'style' => 'width: 100%; display: inline-block; margin-bottom: 5px;']) ?>
            </div>
        </div>
        <div class="col-md-9">
            <div style="background-color: #fff; width: 100%; font-size: 12px; margin-right: auto; margin-left: auto; border-radius: 5px;">
            <div style="width: 100%; border-top-right-radius: 5px; border-top-left-radius: 5px; background-color: #e6e6e6; height: 30px; padding: 5px; line-height: 20px; color: #4d4d4d">
                DISBURSE PROJECT
            </div>
            <table style="width: 100%;" class="table table-bordered table-striped">
                <tr>
                    <td style="width: 25%;">
                        <strong>PROJECT TITLE:</strong>
                    </td>
                    <td colspan="4">
                        <?= $model->title ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <strong>DATE:</strong>
                    </td>
                    <td colspan="4">
                        <?= $model->date ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <strong>IMPLEMENTING AGENCY:</strong>
                    </td>
                    <td colspan="4">
                        <?= $model->implementing_agency ?>
                    </td>
                </tr>
            </table>

            <table style="width: 100%">
                <tr>
                    <td style="padding: 5px;">
                    <?= $form->field($new_model, 'date')->widget(DatePicker::classname(), [
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
                    <td style="padding: 5px;">
                        <?= $form->field($new_model, 'status')->dropdownList(['Liquidated' => 'Liquidated', 'For Liquidation' => 'For Liquidation']) ?>
                    </td>
                </tr>
            </table>
            <table style="width: 100%" class="table">
                <tr>
                    <th style="text-align: center; width: 25%;">ORS No.</th>
                    <th>Responsibility Center</th>
                    <th style="text-align: center;">MFO/PA</th>
                    <th style="text-align: center;">Expenditure</th>
                    <th style="text-align: center; width: 30%">Amount</th>
                </tr>
                <?php foreach (explode('*', $model->ors_no) as $key => $value) : ?>
                    <?php foreach ($model->getOrsdetails($value, Yii::$app->user->identity->region) as $key => $ors) : ?>
                    <tr>
                        <td style="text-align: center;">
                            <?= $ors->ors_no ?>
                            <?= $form->field($new_model, 'ors_no[]')->hiddenInput(['value' => $ors->ors_no])->label(false) ?>
                        </td>
                        <td style="text-align: center;">
                            <?= $ors->rc ?>
                            <?= $form->field($new_model, 'rc[]')->hiddenInput(['value' => $ors->rc])->label(false) ?>
                        </td>
                        <td style="text-align: center;">
                            <?= $ors->mfo_pap ?>
                            <?= $form->field($new_model, 'mfo_pap[]')->hiddenInput(['value' => $ors->mfo_pap])->label(false) ?>
                        </td>
                        <td style="text-align: center;">
                            <?= $ors->object_code ?>
                            <?= $form->field($new_model, 'object_code[]')->hiddenInput(['value' => $ors->object_code])->label(false) ?>
                        </td>
                        <td style="text-align: right; font-weight: bold;">
                            <?= $form->field($new_model, 'amount[]')->textInput(['value' => 0.00, 'style' => 'text-align: right'])->label(false) ?>
                        </td>
                    </tr>
                    <?php endforeach ?>
                <?php endforeach ?>
                <tr>
                    <td colspan="5" style="padding: 10px;">
                        <div class="form-group">
                            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                        </div>
                    </td>
                </tr>
            </table>
            <?php ActiveForm::end(); ?>
        </div>
        </div>
    </div>
</div>
