<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use backend\models\NationalAgency;

/* @var $this yii\web\View */
/* @var $model backend\models\ImplementingAgency */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="implementing-agency-form">

    <?php $form = ActiveForm::begin(); ?>
    <div style="color: #fff; border-bottom: solid 2px #fff; text-align: right; padding-top: 13px;" id="no-print">
        <h3>IMPLEMENTING AGENCY</h3>
    </div>
    <br>
    <br>
    
    <div style="width: 60%; margin-right: auto; margin-left: auto; border-radius: 5px; background-color: #fff; opacity: .9; padding: 8px;">

	    <?= $form->field($model, 'national_agency')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(NationalAgency::find()
                    ->all(),'id', 'agency'),
            'options' => ['placeholder' => 'Select National Agency', 
            'multiple' => false],
            ]);
        ?>

	    <?= $form->field($model, 'uacs')->textInput(['maxlength' => true]) ?>

	    <?= $form->field($model, 'implementing_agency')->textInput(['maxlength' => true]) ?>

	    <div class="form-group">
	        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
	    </div>
	</div>

    <?php ActiveForm::end(); ?>

</div>
