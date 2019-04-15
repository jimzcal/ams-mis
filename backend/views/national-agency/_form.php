<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use backend\models\NationalAgency;

/* @var $this yii\web\View */
/* @var $model backend\models\NationalAgency */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="national-agency-form">

    <?php $form = ActiveForm::begin(); ?>

    <div style="width: 99%; padding: 5px; font-style: italic;">
        <span class="fa fa-info" style="font-size: 22px;"></span>
        If your Implementing Agency (Department or Agency) cannot be found in the given drop down list, please provide/encode it on the text field and add ";" (semicolon) at the end. Example: (1) For Department Field - Department of Education; (2) For Agency - DEPED Division of Cagayan; (3) For Operating Unit - Malangas National High School.
    </div>
    <br>

    <?= $form->field($model, 'department')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(NationalAgency::find()
                ->all(),'department', 'department'),
        'options' => [
            'prompt' => 'Select Department (e.g., Department of Agriculture)', 
            'multiple' => false,
            'onchange'=>'
                 $.post("agencies?department='.'"+$(this).val(),function(data){

                    $("select#nationalagency-agency").html(data);

                });'],
         'pluginOptions' => [
                'tags' => true,
                'tokenSeparators' => [';'],
            ],
    ]); ?>

    <?= $form->field($model, 'agency')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(NationalAgency::find()
                ->all(),'agency', 'agency'),
        'options' => [
            'prompt' => 'Select Agency (e.g., Office of the Secretary / Regional Field Office)', 
            'multiple' => false],
         'pluginOptions' => [
                'tags' => true,
                'tokenSeparators' => [';'],
            ],
    ]); ?>

    <?= $form->field($model, 'operating_unit')->textInput(['maxlength' => true, 'placeholder' => 'Office of the Municiapl Mayor (For LGU) / Region I']) ?>

    <?= $form->field($model, 'organization_code')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
