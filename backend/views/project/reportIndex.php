<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use backend\models\Project;
use kartik\select2\Select2;

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
        <h3>GENERATE INTER-AGENCY FUND TRANSFER REPORT</h3>
    </div>
    <table style="width: 60%;">
        <tr>
            <td style="padding: 2px;">
                <?= $form->field($model, 'region')->dropDownList(
                    [
                        'Central Office' => 'Central Office',
                        'NCR' => 'NCR - National Capital Region',
                        'Region I' => 'Region I - Ilocos Region',
                        'CAR' => 'CAR - Cordillera Administrative Region',
                        'Region II' => 'Region II - Cagayan Valley Region',
                        'Region III' => 'Region III - Central Luzon',
                        'Region IV-A' => 'Region IV-A : CALABARZON',
                        'MIMAROPA Region' => 'MIMAROPA Region - Southwestern Tagalog Region',
                        'Region V' => 'Region V - Bicol Region',
                        'Region VI' => 'Region VI - Western Visayas',
                        'Region VII' => 'Region VII - Central Visayas',
                        'Region VIII' => 'Region VIII - Estern Visayas',
                        'Region IX' => 'Region IX - Zamboanga Peninsula',
                        'Region X' => 'Region X - Northern Mindanoa',
                        'Region XI' => 'Region XI - Davao Region',
                        'Region XII' => 'Region XII - SOCCSKSARGEN Region',
                        'Region XIII' => 'Region XIII - CARAGA Region',
                        'ARMM' => 'ARMM - Autonomous Region of Muslim Mindanao',
                    ],
                      [
                          'prompt'=>'Select Region',
                          'style' => 'height: 34px',
                      ])->label(false); 
                  ?>
            </td>
            <td style="padding: 2px; width: 30%;">
                <?= $form->field($model, 'appropriation_class')->dropdownList(['Current' => 'Current', 'Supplemental' => 'Supplemental', 'Continuing' => 'Continuing'])->label(false) ?>
            </td>
            <td>
                <?= Html::submitButton('Generate', ['class' => 'btn btn-success']) ?>
            </td>
        </tr>
    </table>         
    <?php ActiveForm::end(); ?>
</div>
