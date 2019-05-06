<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\FundCluster;
use backend\models\Transaction;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\DraftDv */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="draft-dv-form">

    <?php $form = ActiveForm::begin(); ?>

    <div style="width: 85%; margin-left: 10%;">

        <table style="font-size: 90%;">
            <tr>
                <td style="width: 110px; vertical-align: top; text-align: right;">Date</td>
                <td style="width: 500px;"><?= $form->field($model, 'date')->textInput(['readOnly' => true, 'value' => date('Y-m-d')])->label(false) ?></td>
            </tr>
            <tr>
                <td style="vertical-align: top; text-align: right;"><span style="color: red">*</span>Reference No.</td>
                <td><?= $form->field($model, 'reference_no')->textInput(['maxlength' => true, 'readOnly' => true, 'value' => 'ams-'.date('d-ism')])->label(false) ?></td>
            </tr>
            <tr>
                <td style="vertical-align: top; text-align: right;"><span style="color: red">*</span>Payee</td>
                <td><?= $form->field($model, 'payee')->textInput(['maxlength' => true, 'value' => Yii::$app->user->identity->fullname])->label(false) ?></td>
            </tr>
            <tr>
                <td style="vertical-align: top; text-align: right;">TIN No.</td>
                <td><?= $form->field($model, 'tin')->textInput(['maxlength' => true])->label(false) ?></td>
            </tr>
            <tr>
                <td style="vertical-align: top; text-align: right;"><span style="color: red">*</span>Fund Cluster</td>
                <td><?= $form->field($model, 'fund_cluster')->dropDownList(ArrayHelper::map(FundCluster::find()->all(),'fund_cluster','fund_cluster'),
                      [
                          'prompt'=>'Select Fund Cluster',
                      ])->label(false); 
                  ?></td>
            </tr>
            <tr>
                <td style="vertical-align: top; text-align: right;"><span style="color: red">*</span>Transaction Type</td>
                <td><?= $form->field($model, 'transaction_type')->dropDownList(ArrayHelper::map(transaction::find()->all(),'id', 'name'))->label(false) ?></td>
            </tr>
            <tr>
                <td style="vertical-align: top; text-align: right;"><span style="color: red">*</span>Particulars</td>
                <td><?= $form->field($model, 'particulars')->textarea(['rows' => 6])->label(false) ?></td>
            </tr>
            <tr>
                <td style="vertical-align: top; text-align: right;"><span style="color: red">*</span>Gross Amount</td>
                <td><?= $form->field($model, 'gross_amount')->textInput(['maxlength' => true, 'style' => 'width: 250px; text-align: right'])->label(false) ?></td>
            </tr>
        </table>

        <?= $form->field($model, 'created_by')->hiddenInput(['maxlength' => true, 'value' => Yii::$app->user->identity->id])->label(false) ?>

        <?= $form->field($model, 'status')->hiddenInput(['maxlength' => true, 'value' => 'Drafted'])->label(false) ?>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

    </div>

    <?php ActiveForm::end(); ?>

</div>
