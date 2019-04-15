<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use backend\models\NationalAgency;

/* @var $this yii\web\View */
/* @var $model backend\models\ImplementingAgencySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="implementing-agency-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

     <?= $form->field($model, 'national_agency')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(NationalAgency::find()
                ->all(),'id', 'agency'),
        'options' => ['placeholder' => 'Select National Agency', 
        'multiple' => false],
        ]);
    ?>
    <?= $form->field($model, 'uacs') ?>

    <?= $form->field($model, 'implementing_agency') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
