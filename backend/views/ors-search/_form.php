<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Ors */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ors-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'date')->textInput() ?>

    <?= $form->field($model, 'region')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sub_office')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'appropriation_class')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ors_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'particulars')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'ors_class')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'funding_source')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ors_year')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ors_month')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ors_serial')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mfo_pap')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'object_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'obligation')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dv_date')->textInput() ?>

    <?= $form->field($model, 'dv_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fund_cluster')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dv_amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'liquidation_date')->textInput() ?>

    <?= $form->field($model, 'liquidation_amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'liquidation_status')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
