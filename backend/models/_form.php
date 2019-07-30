<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use backend\models\Accounts

/* @var $this yii\web\View */
/* @var $model backend\models\SubLedgerAccounts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sub-ledger-accounts-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'mother_account')->widget(Select2::classname(), [
          'data' => ArrayHelper::map(Accounts::find()->where(['status' => 'Active'])->all(),'account_code', 
          	function($model){
          		return $model->account_code.' - '.$model->account_name;
          	}
      ),
          //'language' => 'eng',
          'options' => [
                //'value' => $model->account == null ? $model->account : '', 
                'prompt' => 'Select Mother Account',
                'multiple' => false,
                'id' => 'parent',
                ],
      ]); ?>

    <?= $form->field($model, 'account_code')->textInput(['maxlength' => true, 'id' => 'account_code']) ?>

    <?= $form->field($model, 'account_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList(['Active'=>'Active (In Use)', 'Inactive'=>'Inactive (Hide)']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script>
window.onload = function()
{
    $(document).on("change", "select[id='parent']", function () 
    { 
        var parent = $(this).val();
        var account = parent + "-" + <?= date('Ym').$model->getSeq() ?>;
        $("#account_code").val(account);
    });
    // var parent = $("#parent").val();
    
}
</script>
