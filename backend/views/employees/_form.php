<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use johnson\webcam\JayWebcam;

/* @var $this yii\web\View */
/* @var $model backend\models\Employees */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="employees-form" id="capture">
    <script src="adapter.js"></script>

    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>

    <table class="table table-bordered table-condensed">
        <tr style="height: 140px;">
            <td colspan="2" style="text-align: center; padding: 25px; color: #737373;">
                <h2>New Employee's Registration Form</h2>
            </td>
            <td style="width: 200px;">
                <video id="video" style="background-image: url('<?= $model->photo ?>'); background-size: 98% 98%; background-repeat: no-repeat;">
                    
                </video>
                <canvas id="canvas" style="display:none;">
                    
                </canvas>
                <div id="buttoncontent">

                </div>
                <i class="glyphicon glyphicon-camera camera" id="startbutton"></i>
            </td>
        </tr>
        <tr>
            <td style="width: 150px; font-size: 12px; color: #8c8c8c; font-style: italic; text-align: right; vertical-align: middle;;">Name :</td>
            <td style="height: 35px;">
                <?= $form->field($model, 'name', ['options' => ['tag' => false]])->textInput(['class' => 'textfield', 'maxlength' => true, 'style' => 'text-transform: uppercase', 'autofocus' => true])->label(false) ?>
                <?=  $form->field($model, 'photo', ['options' => ['tag' => false]])->hiddenInput(['class' => 'textfield', 'id' => 'photo'])->label(false) ?>
            </td>
            <td style="height: 35px;">
                <?= $form->field($model, 'employee_id', ['options' => ['tag' => false]])->textInput(['class' => 'textfield', 'maxlength' => true, 'placeholder' => 'Employee\'s Id'])->label(false) ?>
            </td>
        </tr>
        <tr>
            <td style="width: 150px; font-size: 12px; color: #8c8c8c; font-style: italic; text-align: right; vertical-align: middle;;">Position :</td>
            <td colspan="2" style="height: 35px;">
                <?= $form->field($model, 'position', ['options' => ['tag' => false]])->textInput(['class' => 'textfield', 'maxlength' => true])->label(false) ?>
            </td>
        </tr>
        <tr>
            <td style="width: 150px; font-size: 12px; color: #8c8c8c; font-style: italic; text-align: right; vertical-align: middle;;">Office :</td>
            <td colspan="2" style="height: 35px;">
                <?= $form->field($model, 'office', ['options' => ['tag' => false]])->textInput(['class' => 'textfield', 'maxlength' => true])->label(false) ?>
            </td>
        </tr>
        <tr>
            <td style="width: 150px; font-size: 12px; color: #8c8c8c; font-style: italic; text-align: right; vertical-align: middle;;">Password :</td>
            <td colspan="2" style="height: 35px;">
                <?= $form->field($model, 'password', ['options' => ['tag' => false]])->passwordInput(['class' => 'textfield', 'maxlength' => true])->label(false) ?>
            </td>
        </tr>
        <tr>
            <td style="width: 150px; font-size: 12px; color: #8c8c8c; font-style: italic; text-align: right; vertical-align: middle;;">Biometrix :</td>
            <td colspan="2" style="height: 35px;">
                <?= $form->field($model, 'biometrix', ['options' => ['tag' => false]])->textInput(['class' => 'textfield', 'maxlength' => true])->label(false) ?>
            </td>
        </tr>
        <tr>
            <td style="width: 150px; font-size: 12px; color: #8c8c8c; font-style: italic; text-align: right; vertical-align: middle;;">QR Code :</td>
            <td colspan="2" style="height: 35px;">
                <?= $form->field($model, 'qr_code', ['options' => ['tag' => false]])->textInput(['class' => 'textfield', 'maxlength' => true])->label(false) ?>
            </td>
        </tr>
    </table>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
