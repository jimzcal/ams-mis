<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\FundRemittanceSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fund-remittance-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'project_id') ?>

    <?= $form->field($model, 'operating_unit') ?>

    <?= $form->field($model, 'btr_date') ?>

    <?php  echo $form->field($model, 'btr_amount') ?>

    <?php // echo $form->field($model, 'ncarequest_date') ?>

    <?php // echo $form->field($model, 'ncarequest_amount') ?>

    <?php // echo $form->field($model, 'nca_date') ?>

    <?php // echo $form->field($model, 'nca_amount') ?>

    <?php // echo $form->field($model, 'nca_reference') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
