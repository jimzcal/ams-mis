<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Requirements;

/* @var $this yii\web\View */
/* @var $model backend\models\Transaction */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transaction-form">
    <div class="form-wrapper-content">
        <?php $form = ActiveForm::begin(); ?>
        <?= Yii::$app->session->getFlash('error'); ?>
        
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <div style="background-color: #f5f5f0; font-weight: bold; padding: 10px;">
          <label>Select Requirements</label>
        </div>

        <?php foreach($requirements as $requirement) :?>
            <div class="cbox">
                <input type="checkbox" checked="true" name="requirements[<?= $requirement ?>]" value="<?= $requirement ?>">
                <label><?= $requirement ?></label>
            </div>
        <?php endforeach ?>

        <?php foreach($data as $val) :?>
            <div class="cbox">
                <input type="checkbox" name="requirements[<?= $val ?>]" value="<?= $val ?>">
                <label><?= $val ?></label>
            </div>
        <?php endforeach ?>
 
        </br></br>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
