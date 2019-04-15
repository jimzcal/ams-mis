<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use backend\models\NationalAgency;

/* @var $this yii\web\View */
/* @var $model backend\models\ProjectsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="projects-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

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

    <?= $form->field($model, 'project_title')->textInput(['maxlength' => true]) ?>

    <?php // echo $form->field($model, 'implementing_office') ?>

    <?php // echo $form->field($model, 'focal_person') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
