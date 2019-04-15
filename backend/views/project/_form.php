<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use backend\models\Ors;
use backend\models\Project;
use backend\models\OperatingUnit;
use backend\models\SubOu;
use backend\models\NationalAgency;
use backend\models\ImplementingAgency;

/* @var $this yii\web\View */
/* @var $model backend\models\Project */
/* @var $form yii\widgets\ActiveForm */
?>

<style type="text/css">
    #tbl td{
        padding-right: 3px;
    }
</style>

<div class="project-form">

    <?php $form = ActiveForm::begin(); ?>

    <table style="width: 100%;" id="tbl">
        <tr>
            <td style="width: 50%;">
                <?= $form->field($model, 'region')->textInput(['maxlength' => true, 'value' => Yii::$app->user->identity->region, 'readOnly' => true])->label('Region/Operating Unit') ?>
            </td>
            <td style="width: 30%">
                <?= $form->field($model, 'sub_office')->widget(Select2::classname(), [
                    'data' => ArrayHelper::map(SubOu::find()->where(['status' => 'Active'])
                            ->andWhere(['mother_unit' => Yii::$app->user->identity->region])
                            ->all(),'sub_ou', 'description'),
                    'options' => [
                        'prompt' => 'Select Su Operating Unit',
                        'multiple' => false,
                        ],
                    ]);
                ?>
            </td>
            <td>
                <?= $form->field($model, 'date')->widget(DatePicker::classname(), [
                    'options' => [
                        'value' => date('Y-m-d'),
                        'placeholder' => 'Date',
                        // 'autofocus' => 'autofocus',
                    ],

                    'pluginOptions' => [
                    'autoclose'=>true,
                    'todayHighlight' => true,
                    'format' => 'yyyy-m-d'
                        ]
                ]); ?>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <?= $form->field($model, 'national_agency')->widget(Select2::classname(), [
                    'data' => ArrayHelper::map(NationalAgency::find()
                            ->all(),'id', 'agency'),
                    'options' => [
                        'prompt' => 'Select National Agency', 
                        'multiple' => false,
                        'onchange'=>'
                             $.post("agencies?id='.'"+$(this).val(),function(data){

                                $("select#project-implementing_agency").html(data);

                            });'
                    ],
                    ]);
                ?>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <?= $form->field($model, 'implementing_agency')->widget(Select2::classname(), [
                    'data' => ArrayHelper::map(ImplementingAgency::find()
                            ->all(),'id', 'implementing_agency'),
                    'options' => [
                        'prompt' => 'Select or add Implementing Agency', 
                        'multiple' => false,
                        ],
                    'pluginOptions' => [
                        'tags' => true,
                        'tokenSeparators' => [';'],
                    ],
                ]);
                ?>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <?= $form->field($model, 'focal_person')->textInput(['maxlength' => true]) ?>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <?= $form->field($model, 'ors_no[]')->widget(Select2::classname(), [
                    'data' => ArrayHelper::map(Ors::find()->where(['region' => Yii::$app->user->identity->region])->groupBy(['ors_no'])->all(),'ors_no', 'ors_no'),
                    'options' => ['placeholder' => 'Select ORS', 
                    'multiple' => true],
                    'pluginOptions' => [
                        'tags' => true,
                        'tokenSeparators' => [',', ' '],
                    ],
                ]);
                ?>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <?= $form->field($model, 'status')->dropdownList(['Unliquidated' => 'Unliquidated', 'Liquidated', 'Liquidated']) ?>
            </td>
        </tr>
    </table>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
