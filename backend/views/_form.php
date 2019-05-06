<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use backend\models\Requirements;

/* @var $this yii\web\View */
/* @var $model backend\models\Transaction */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transaction-form">
 
    <br>
      <?php $form = ActiveForm::begin(); ?>

      <div style="width: 75%; margin-left: 7%;">
        <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'style' => 'width: 40%;']) ?>

        <?= $form->field($model, 'requirements')->widget(Select2::classname(), [
                  'data' => ArrayHelper::map(Requirements::find()->all(), 'requirement', 'requirement'),
                  //'language' => 'eng',
                  'maintainOrder' => true,
                  'options' => [
                    'placeholder' => 'Select Requirements...', 
                    'multiple' => true, 
                    // 'maintainOrder' => true,
                    'value' => $model->requirements != null ? explode('*', $model->requirements) : '',
                  ],
                  'pluginOptions' => [
                      'allowClear' => true,
                      'tags' => true,
                      'tokenSeparators' => [';'],
                  ],
              ])->label('Requirements'); ?>

       

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Save Transaction' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

      </div>

      <?php ActiveForm::end(); ?>

</div>
