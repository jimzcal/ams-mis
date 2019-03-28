<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\Images */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="images-form">
	<div class="form-wrapper-content">

	    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>

	    <?= $form->field($model2, 'images[]')->widget(FileInput::classname(), [
		    'options' => ['multiple' => true, 'accept' => 'image/*'],
		    'pluginOptions' => ['previewFileType' => 'image', 'showUpload' => false, 'uploadUrl' => Url::to(['/images']), 'maxFileCount' => 5]
		]); ?>

	    <div class="form-group">
	        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
	    </div>

	    <?php ActiveForm::end(); ?>

	</div>
</div>
