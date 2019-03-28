<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TransactionStatusSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transaction-status-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'region') ?>

    <?= $form->field($model, 'dv_no') ?>

    <?= $form->field($model, 'date') ?>

    <?= $form->field($model, 'process') ?>

    <?php // echo $form->field($model, 'employee') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
