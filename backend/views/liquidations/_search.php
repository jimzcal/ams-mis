<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\LiquidationsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="liquidations-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ors_no') ?>

    <?= $form->field($model, 'ors_date') ?>

    <?php // echo $form->field($model, 'ors_class') ?>

    <?php // echo $form->field($model, 'funding_source') ?>

    <?php // echo $form->field($model, 'ors_year') ?>

    <?php // echo $form->field($model, 'ors_month') ?>

    <?php // echo $form->field($model, 'ors_serial') ?>

    <?php echo $form->field($model, 'dv_no') ?>

    <?php echo $form->field($model, 'dv_date') ?>

    <?php // echo $form->field($model, 'reference') ?>

    <?php // echo $form->field($model, 'amount') ?>

    <?php echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
