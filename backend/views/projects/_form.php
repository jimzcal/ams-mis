<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use backend\models\NationalAgency;
use backend\models\ImplementingAgency;

/* @var $this yii\web\View */
/* @var $model backend\models\Projects */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="projects-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'operating_unit')->textInput(['value' => Yii::$app->user->identity->region, 'readOnly' => true])->label('Oprating Unit/Source of Fund Agency') ?>

    <?= $form->field($model, 'project_title')->textInput(['maxlength' => true]) ?>

    <label>Implementing Agency</label>
    <div style="border: solid 1px gray; padding: 7px; border-radius: 5px;">

        <?= $form->field($model, 'department')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(NationalAgency::find()
                    ->all(),'department', 'department'),
            'options' => [
                'prompt' => 'Select Department', 
                'multiple' => false,
                'onchange'=>'
                     $.post("agencies?department='.'"+$(this).val(),function(data){

                        $("select#projects-agency").html(data);

                    });'
                ],
            'pluginOptions' => [
                'tags' => true,
                'tokenSeparators' => [';'],
            ],
            ]);
        ?>

        <?= $form->field($model, 'agency')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(NationalAgency::find()
                    ->all(),'agency', 'agency'),
            'options' => [
                'prompt' => 'Select Agency', 
                'multiple' => false,
                ],
            'pluginOptions' => [
                'tags' => true,
                'tokenSeparators' => [';'],
            ],
        ]);
        ?>

        <?= $form->field($model, 'operating_office')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(NationalAgency::find()
                        ->all(),'operating_unit', 'operating_unit'),
                'options' => [
                    'prompt' => 'Select Operating Unit', 
                    'multiple' => false,
                    ],
                'pluginOptions' => [
                    'tags' => true,
                    'tokenSeparators' => [';'],
                ],
            ]);
        ?>

    </div>
    <br>

    <?= $form->field($model, 'focal_person')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropdownList(['Active' => 'Active', 'Cancelled' => 'Cancelled']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
