<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use backend\models\Project;
use kartik\select2\Select2;
use backend\models\OperatingUnit;

/* @var $this yii\web\View */
/* @var $model backend\models\Ors */

$this->title = 'Generate Report';
// $this->params['breadcrumbs'][] = ['label' => 'Ors', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<style type="text/css">
    .help-block{
        margin: 0px !important;
    }
    .form-group{
        margin: 0px !important;
    }
    .form-control
    {
        height: 34px;
    }
</style>
<div class="ors-view">
    <?php $form = ActiveForm::begin(); ?>

     <div style="color: #fff; border-bottom: solid 2px #fff; text-align: right; padding-top: 13px;">
        <h3>GENERATE FAR - 6 REPORT</h3>
    </div>
    <table style="width: 70%;">
        <tr>
            <td style="padding: 1px;">
                <?php if(Yii::$app->user->identity->region == 'Central Office') : ?>
                   <?= $form->field($model, 'operating_unit')->widget(Select2::classname(), [
                            'data' => ArrayHelper::map(OperatingUnit::find()
                                    ->all(),'abbreviation', 'abbreviation') + ['All' => 'All'],
                            'options' => [
                                'prompt' => 'Select Operating Unit', 
                                'multiple' => false],
                            'pluginOptions' => [
                                'tags' => true,
                                'tokenSeparators' => [';'],
                            ],
                            ])->label(false);
                        ?>
                <?php else : ?>
                    <?= $form->field($model, 'operating_unit')->textInput(['value' => Yii::$app->user->identity->region, 'readOnly' => true])->label(false) ?>
                <?php endif ?>
            </td>
            <td style="padding: 1px;">
                <?= $form->field($model, 'type')->dropdownList(['Inter Agency' => 'Inter Agency Fund Transfer', 'Grants' => 'Grants and Donations (Less than 12 months)'])->label(false) ?>
            </td>
            <td style="padding: 1px;">
                <?= $form->field($model, 'fund_cluster')->dropdownList(['01' => '01 - Regular Agency Fund', '02' => '02 - Foreign Assisted Project Fund', '03' => '03 - Special Fund (Loacally Funded)', '04' => '04 - Special Account (Foreign Assisted)', '07' => '07 - Trust Receipts'])->label(false) ?>
            </td>
            <!-- <td style="padding: 1px; width: 30%;">
                <?= $form->field($model, 'appropriation_type')->dropdownList(['Current' => 'Current', 'Prior Year' => 'Prior Year Obligation', 'Supplemental' => 'Supplemental', 'Continuing' => 'Continuing'])->label(false) ?>
            </td> -->
            <td>
                <?= Html::submitButton('Generate', ['class' => 'btn btn-success']) ?>
            </td>
        </tr>
    </table>                  
    <?php ActiveForm::end(); ?>
</div>
