<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ProjectSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php if(Yii::$app->user->identity->region == 'Central Office') : ?>

        <?= $form->field($model, 'region') ?>

        <?= $form->field($model, 'sub_office') ?>

    <?php endif ?>

    <?= $form->field($model, 'date') ?>

    <?= $form->field($model, 'title') ?>

    <?php // echo $form->field($model, 'implementing_agency') ?>

    <?php // echo $form->field($model, 'focal_person') ?>

    <?php // echo $form->field($model, 'ors_no') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
