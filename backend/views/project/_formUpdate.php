<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use backend\models\Ors;
use backend\models\Project;

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

    <div style="width: 80%; margin-left: auto; margin-right: auto;">
        <table style="width: 100%;" id="tbl">
            <tr>
                <td style="width: 50%;">
                    <?= $form->field($model, 'region')->textInput(['maxlength' => true, 'value' => Yii::$app->user->identity->region, 'readOnly' => true]) ?>
                </td>
                <td style="width: 30%">
                    <?= $form->field($model, 'sub_office')->textInput(['maxlength' => true]) ?>
                </td>
                <td>
                    <?= $form->field($model, 'date')->widget(DatePicker::classname(), [
                                'options' => [
                                    // 'class' => 'new-textfield',
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
                    <?= $form->field($model, 'implementing_agency')->widget(Select2::classname(), [
                        'data' => ArrayHelper::map(Project::find()->groupBy(['implementing_agency'])
                                ->all(),'implementing_agency', 'implementing_agency'),
                        'options' => ['placeholder' => 'Select or add Implementing Agency', 
                        'multiple' => false],
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
                        'multiple' => true,
                        'value' => explode('*', $model->ors_no)],
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

    </div>

    <?php ActiveForm::end(); ?>

</div>
