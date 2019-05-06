<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use backend\models\Far6Projects;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\Far6Projects */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="far6-projects-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'operating_unit')->textInput(['maxlength' => true, 'value' => Yii::$app->user->identity->region, 'readOnly' => true]) ?>

    <label>Source of Fund</label>
    <div style="padding: 10px; border: solid 1px #e0e0d1; border-radius: 5px;">
    <?= $form->field($model, 'department')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Far6Projects::find()->groupBy(['department'])
                ->all(),'department', 'department'),
        'options' => [
            'prompt' => 'Select Department', 
            'multiple' => false,
            'onchange'=>'
                 $.post("agencies?department='.'"+$(this).val(),function(data){

                    $("select#projects-agency").html(data);

                });'
            ],
        'pluginOptions' => [
            'tags' => true,
            'tokenSeparators' => [';'],
        ],
        ]);
    ?>

    <?= $form->field($model, 'agency')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(Far6Projects::find()->groupBy(['agency'])
                    ->all(),'agency', 'agency'),
            'options' => [
                'prompt' => 'Select Agency', 
                'multiple' => false,
                ],
            'pluginOptions' => [
                'tags' => true,
                'tokenSeparators' => [';'],
            ],
        ]);
        ?>

    <?= $form->field($model, 'operating_office')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(Far6Projects::find()
                    ->all(),'operating_unit', 'operating_unit'),
            'options' => [
                'prompt' => 'Select Operating Unit', 
                'multiple' => false,
                ],
            'pluginOptions' => [
                'tags' => true,
                'tokenSeparators' => [';'],
            ],
        ]);
    ?>

    </div>

    <?= $form->field($model, 'project_title')->textInput(['maxlength' => true, 'placeholder' => 'Project Title base on approved MOA']) ?>

    <?= $form->field($model, 'type')->dropdownList(['Inter Agency' => 'Inter Agency Fund Transfer', 'Grants' => 'Grants and Donations (Less than 12 months)']) ?>

    <?= $form->field($model, 'uacs')->textInput(['maxlength' => true, 'placeholder' => 'UACS (MFO/PAP) from Source Agency']) ?>

    <?= $form->field($model, 'date_approved')->widget(DatePicker::classname(), [
        'options' => [
            // 'class' => 'new-textfield',
            'placeholder' => 'Date',
            'value' => $model->date_approved == null ? date('Y-m-d') : $model->date_approved,
        ],
        'pluginOptions' => [
        'autoclose' => true,
        'todayHighlight' => true,
        'format' => 'yyyy-mm-dd'
            ]
    ]); ?>

    <?= $form->field($model, 'approved_budget')->textInput(['maxlength' => true, 'style' => 'width: 250px; text-align: right; font-weight: bold;', 'value' => $model->approved_budget == 0.00 ? 0.00 : $model->approved_budget]) ?>

    <?= $form->field($model, 'status')->dropdownList(['Active' => 'Active', 'Inactive' => 'Inactive']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
