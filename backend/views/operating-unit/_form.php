<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\OperatingUnit */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="operating-unit-form">

    <?php $form = ActiveForm::begin(); ?>
    <div style="width: 60%;">
	    <?= $form->field($model, 'abbreviation')->textInput(['maxlength' => true]) ?>

	    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

	    <?= $form->field($model, 'status')->dropdownList(['Active' => 'Active', 'Inactive' => 'Inactive']) ?>

	    <div class="form-group">
	        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
	    </div>
	</div>
    <?php ActiveForm::end(); ?>

</div>
