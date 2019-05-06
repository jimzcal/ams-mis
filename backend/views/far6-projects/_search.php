<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Far6ProjectsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="far6-projects-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'department') ?>

    <?= $form->field($model, 'agency') ?>

    <?php // echo $form->field($model, 'operating_office') ?>

    <?php  echo $form->field($model, 'project_title') ?>

    <?php // echo $form->field($model, 'date_approved') ?>

    <?php // echo $form->field($model, 'approved_budget') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
