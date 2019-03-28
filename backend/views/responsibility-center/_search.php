<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ResponsibilityCenterSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="responsibility-center-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <table class="search-table">
        <tr>
            <td valign="top" align="right">
                <i class="fa fa-search" style="color: green; font-size: 30px;"></i>
            </td>
            <td>
                <?= $form->field($model, 'acronym')->textInput(['placeholder'=>'Acronym'])->label(false) ?>
            </td>
            <td>
                <?= $form->field($model, 'description')->textInput(['placeholder'=>'Description'])->label(false) ?>
            </td>
            <td>
                <?= $form->field($model, 'code')->textInput(['placeholder'=>'Code'])->label(false) ?>
            </td>
            <td>
                <div class="form-group">
                    <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
                </div>
            </td>
        </tr>
    </table>

    <?php ActiveForm::end(); ?>

</div>
