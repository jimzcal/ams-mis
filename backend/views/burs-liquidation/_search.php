<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\BursLiquidationSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="burs-liquidation-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'burs_no') ?>

    <?= $form->field($model, 'burs_date') ?>

    <?php // echo $form->field($model, 'operating_unit') ?>

    <?php  echo $form->field($model, 'liquidation_date') ?>

    <?php // echo $form->field($model, 'amount') ?>

    <?php  echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
