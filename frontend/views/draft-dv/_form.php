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
                <td style="vertical-align: top; text-align: right;"><span style="color: red">*</span>Payee</td>
                <td><?= $form->field($model, 'payee')->textInput(['maxlength' => true])->label(false) ?></td>
            </tr>
            <tr>
                <td style="vertical-align: top; text-align: right;">TIN No.</td>
                <td><?= $form->field($model, 'tin')->textInput(['maxlength' => true])->label(false) ?></td>
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

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

    </div>

    <?php ActiveForm::end(); ?>

</div>
