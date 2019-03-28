<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">
    <div class="container-fluid form-wrapper">
			<row>
				<div class="col-md-4">
					<div class="info-wrapper">
						<span class="glyphicon info-wrapper-icon glyphicon-info-sign"></span> All Fields on this form are required to be filled-out. At bellow's question, whether or not you allow the new user to manage user accounts, means you give this user the authority should you select "yes" to add, update and delete users aside from content management. Otherwise, the user can only manage website contents such as add, update and delete website features and its contents. 
					</div>
				</div>

				<div class="col-md-8 add-form-wrapper">

				    <?php $form = ActiveForm::begin(); ?>

				   <?= $form->field($model, 'fullname')->textInput(['maxlength' => true]) ?>

				    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

				    <?= $form->field($model, 'password')->passwordInput() ?>

				    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

			          <label>*Will you allow this user to manage User Accounts? </label>
			          <?= $form->field($model, 'role')->radio(array('value' => '20', 'label'=>'Yes')) ?>
			          <?= $form->field($model, 'role')->radio(array('value' => '10', 'label'=>'No')) ?>
			    
			          </br>

				    <div class="form-group">
			        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
			    	</div>

			    	<?php ActiveForm::end(); ?>
				</div>
			</row>
	</div>
</div>
