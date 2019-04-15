<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use backend\models\OperatingUnit;

/* @var $this yii\web\View */
/* @var $model backend\models\SubOu */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sub-ou-form">
	<div style="width: 60%; margin-right: auto; margin-left: auto; border-radius: 5px; background-color: #fff; opacity: .9; padding: 8px;">
	    <?php $form = ActiveForm::begin(); ?>

	    <?= $form->field($model, 'mother_unit')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(OperatingUnit::find()->where(['status' => 'Active'])
                    ->all(),'abbreviation', 'description'),
            'options' => ['placeholder' => 'Select Operating Unit', 
            'multiple' => false],
            ]);
        ?>

	    <?= $form->field($model, 'sub_ou')->textInput(['maxlength' => true]) ?>

	    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

	    <?= $form->field($model, 'status')->dropdownList(['Active' => 'Active', 'Inactive' => 'Inactive']) ?>

	    <div class="form-group">
	        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
	    </div>

	    <?php ActiveForm::end(); ?>
	</div>

</div>
