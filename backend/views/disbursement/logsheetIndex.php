<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\PurchaseOrder */

$this->title = 'Generate DV Logsheet';
// $this->params['breadcrumbs'][] = ['label' => 'Purchase Orders', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<style type="text/css">
    .content{
      font-size: 12px;
      text-align: justify;
      white-space: pre;
    }
    #tbl-report td{
        padding-top: 2px;
        padding-right: 1px;
    }
</style>
<div class="purchase-order-view">
    <?php $form = ActiveForm::begin(); ?>
    <div style="color: #fff; border-bottom: solid 2px #fff; text-align: right; padding-top: 13px;" id="no-print">
        <h3>GENERATE DV LOG-SHEET</h3>
    </div>
    <table style="width: 75%;" id="tbl-report">
        <tr>
            <td>
                <?= $form->field($model, 'date_from')->widget(DatePicker::classname(), [
                    'options' => [
                        'value' => date('2019-01-01'),
                        // 'placeholder' => 'Date Receieved',
                        // 'autofocus' => 'autofocus',
                    ],

                    'pluginOptions' => [
                    'autoclose'=>true,
                    'todayHighlight' => true,
                    'format' => 'yyyy-m-d'
                        ]
                ])->label(false); ?>
            </td>
            <td>
                <?= $form->field($model, 'date_to')->widget(DatePicker::classname(), [
                    'options' => [
                        'value' => date('Y-m-d'),
                        // 'placeholder' => 'Date Receieved',
                        // 'autofocus' => 'autofocus',
                    ],

                    'pluginOptions' => [
                    'autoclose'=>true,
                    'todayHighlight' => true,
                    'format' => 'yyyy-m-d'
                        ]
                ])->label(false); ?>
            </td>
            <td>
                <?= $form->field($model, 'fund_cluster')->dropdownList(['01' => '01 - Regular Agency Fund', '02' => '02 - Foreign Assisted Project Fund', '103' => '103 - Special Account (Locally Funded)', '04' => '04 - Special Account (Foreign Assited)'])->label(false) ?>
            </td>
            <td>
                <div class="form-group">
                    <?= Html::submitButton('Generate', ['class' => 'btn btn-success']) ?>
                </div>
            </td>
        </tr>
    </table>
    
    <?php ActiveForm::end(); ?>
</div>
