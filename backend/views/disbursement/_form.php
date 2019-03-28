<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Disbursement */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="disbursement-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'date')->textInput() ?>

    <?= $form->field($model, 'region')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dv_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'payee')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fund_cluster')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rc_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'transaction')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'particulars')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'attachments')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'gross_amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'net_amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
