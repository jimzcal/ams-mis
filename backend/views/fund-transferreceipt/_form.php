<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\FundTransferreceipt */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fund-transferreceipt-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'operating_unit')->textInput(['value' => Yii::$app->user->identity->region, 'readOnly' => true]) ?>

    <?= $form->field($model, 'date_fundreceipt')->widget(DatePicker::classname(), [
        'options' => [
            // 'class' => 'new-textfield',
            'placeholder' => 'Date',
            'value' => date('Y-m-d'),
        ],
        'pluginOptions' => [
        'autoclose' => true,
        'todayHighlight' => true,
        'format' => 'yyyy-mm-dd'
            ]
    ]); ?>

    <?= $form->field($model, 'type')->dropdownList(['Approved Budget' => 'Approved Budget', 'Adjustments' => 'Adjustments (Additions/Reductions/Modifications/Augmentations)']) ?>

    <?= $form->field($model, 'reference')->textInput(['maxlength' => true, 'placeholder' => 'e.g. Check No. or LDDAP/ADA No.']) ?>

    <?= $form->field($model, 'project_id')->hiddenInput(['value' => $project->id])->label(false) ?>

    <?= $form->field($model, 'department')->hiddenInput(['value' => $project->department])->label(false) ?>

    <?= $form->field($model, 'agency')->hiddenInput(['value' => $project->agency])->label(false) ?>

    <?= $form->field($model, 'operating_office')->hiddenInput(['value' => $project->operating_office == null ? '' : $project->operating_office])->label(false) ?>

    <?= $form->field($model, 'amount')->textInput(['maxlength' => true, 'value' => $model->amount == 0.00 ? 0.00 : $model->amount, 'style' => 'width: 250px; font-weight: bold; text-align: right;']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
