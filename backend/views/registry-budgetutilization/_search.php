<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\RegistryBudgetutilizationSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="registry-budgetutilization-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'burs_date') ?>

    <?= $form->field($model, 'burs_no') ?>

    <?php // echo $form->field($model, 'burs_year') ?>

    <?php // echo $form->field($model, 'burs_month') ?>

    <?php // echo $form->field($model, 'burs_serial') ?>

    <?php // echo $form->field($model, 'payee') ?>

    <?php // echo $form->field($model, 'operating_unit') ?>

    <?php // echo $form->field($model, 'fund_cluster') ?>

    <?php // echo $form->field($model, 'responsibility_center') ?>

    <?php  echo $form->field($model, 'particulars') ?>

    <?php // echo $form->field($model, 'mfo_pap') ?>

    <?php // echo $form->field($model, 'uacs') ?>

    <?php // echo $form->field($model, 'amount') ?>

    <?php // echo $form->field($model, 'project_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
