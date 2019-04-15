<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\OperatingUnit */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="operating-unit-form">

	<div style="color: #fff; border-bottom: solid 2px #fff; text-align: right; padding-top: 13px;" id="no-print">
        <h3>OPERATING UNIT</h3>
    </div>
    <br>
    <br>
    <?php $form = ActiveForm::begin(); ?>
    <div style="width: 60%; margin-right: auto; margin-left: auto; border-radius: 5px; background-color: #fff; opacity: .9; padding: 8px;">
	    <?php $form = ActiveForm::begin(); ?>

	    <?= $form->field($model, 'abbreviation')->textInput(['maxlength' => true])->label('Operating Unit / Abbreviation') ?>

	    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

	    <?= $form->field($model, 'status')->dropdownList(['Active' => 'Active', 'Inactive' => 'Inactive']) ?>

	    <div class="form-group">
	        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
	    </div>
	</div>
    <?php ActiveForm::end(); ?>

</div>
