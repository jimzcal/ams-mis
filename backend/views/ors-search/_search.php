<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\OrsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ors-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'date') ?>

    <?= $form->field($model, 'region') ?>

    <?= $form->field($model, 'sub_office') ?>

    <?= $form->field($model, 'appropriation_class') ?>

    <?php // echo $form->field($model, 'ors_no') ?>

    <?php // echo $form->field($model, 'particulars') ?>

    <?php // echo $form->field($model, 'ors_class') ?>

    <?php // echo $form->field($model, 'funding_source') ?>

    <?php // echo $form->field($model, 'ors_year') ?>

    <?php // echo $form->field($model, 'ors_month') ?>

    <?php // echo $form->field($model, 'ors_serial') ?>

    <?php // echo $form->field($model, 'mfo_pap') ?>

    <?php // echo $form->field($model, 'rc') ?>

    <?php // echo $form->field($model, 'object_code') ?>

    <?php // echo $form->field($model, 'obligation') ?>

    <?php // echo $form->field($model, 'dv_date') ?>

    <?php // echo $form->field($model, 'dv_no') ?>

    <?php // echo $form->field($model, 'fund_cluster') ?>

    <?php // echo $form->field($model, 'dv_amount') ?>

    <?php // echo $form->field($model, 'liquidation_date') ?>

    <?php // echo $form->field($model, 'liquidation_amount') ?>

    <?php // echo $form->field($model, 'liquidation_status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
