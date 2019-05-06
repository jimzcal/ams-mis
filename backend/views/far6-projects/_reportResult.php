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

// $this->title = 'Generate Report';
// $this->params['breadcrumbs'][] = ['label' => 'Ors', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<style type="text/css">
    .textfield{
        padding: 3px;
        line-height: 10px;
        border: none;
        background-color: transparent;
        width: 90%;
        border-bottom: solid .8px;
    }
</style>
<?php

$obligate_first = [];
$obligate_second = [];
$obligate_third = [];
$obligate_fourth = [];
$obligate_total = [];

$disbursed_first = [];
$disbursed_second = [];
$disbursed_third = [];
$disbursed_fourth = [];
$disbursed_total = [];

$liquidate_first = [];
$liquidate_second = [];
$liquidate_third = [];
$liquidate_fourth = [];
$liquidate_total = [];

$unpaid_total = [];
$unliquidated_total = [];

?>
<style type="text/css">
    .table-report th{
        border: solid 1px;
        text-align: center;
        font-size: 9px;
    }

    .table-report td{
        border: solid 1px;
        text-align: center;
        font-size: 8px;
    }

    .table-report2 td{
        border-right: solid 1px;
        font-size: 8.9px;
        text-align: right;
    }

    @media print{
        .report-table{
            border: solid 1px;
        }
    }

    @page { 
      size: 13in 8.5in landscape; 
      margin: .5cm;
    }
</style>
<div class="ors-view">
    <div style="min-width: 100%; padding: 5px; background-color: #fff; min-height: 500px; margin-left: auto;  margin-right: auto; margin-top: 5px; overflow: auto;">
        <table style="width: 100%;">
            <tr>
                <td style="height: 20px;"></td>
            </tr>
            <tr>
                <td style="font-weight: bold; text-align: right; padding-right: 20px;">
                    FAR No. 6
                </td>
            </tr>
        </table>

        <table style="width: 100%;">
            <tr>
                <td style="font-weight: bold; text-align: center;">
                    STATEMENT OF APPROVED BUDGET, UTILIZATIONS, DISBURSEMENTS AND BALANCES FOR TRUST RECEIPTS<br>
                    As at the Quarter Ending 
                </td>
            </tr>
            <tr>
                <td style="height: 20px;"></td>
            </tr>
        </table>

        <div class="row">
            <div class="col-lg-6">
                <table style="font-size: 10px; width: 40%">
                    <tr>
                        <td>Department</td>
                        <td style="border-bottom: solid .8px; font-weight: bold;">: Department of Agriculture</td>
                    </tr>
                    <tr>
                        <td>Agency/Entity</td>
                        <td style="border-bottom: solid .8px; font-weight: bold;">: Office of the Secretary</td>
                    </tr>
                    <tr>
                        <td>Operating Unit</td>
                        <td style="border-bottom: solid .8px; font-weight: bold;">: <?= $model->operating_unit  ?></td>
                    </tr>
                    <tr>
                        <td>Organization Code</td>
                        <td style="border-bottom: solid .8px; font-weight: bold;">: 
                            <input type="text" name="text" class="textfield" placeholder="Enter Organization Code" style="border: none; width: 90%; padding-left: 1px;">
                        </td>
                    </tr>
                    <tr>
                        <td>Fund Cluster</td>
                        <td style="border-bottom: solid .8px; font-weight: bold;">: <?= $model->fund_cluster ?></td>
                    </tr>
                </table>
            </div>
            <div class="col-lg-6">
                <table style="font-size: 11px; margin-right: 5px; float: right;">
                    <tr>
                        <td style="padding-right: 5px; font-size: 20px;">
                            <?= $model->type == 'Inter Agency' ? '<span class = "fa fa-check-square"></span>' : '<span class = "fa fa-square"></span>' ?>  
                        </td>
                        <td>Inter Agency Fund Transfer</td>
                    </tr>
                    <tr>
                        <td style="padding-right: 5px; font-size: 20px;">
                            <?= $model->type == 'Grants' ? '<span class = "fa fa-check-square"></span>' : '<span class = "fa fa-square"></span>' ?> 
                        </td>
                        <td>Grants and Donations (Less than 12 months)</td>
                    </tr>
                </table>
            </div>
        </div>
        <br>
        <table style="width: 100%; border: solid 1px;">
            <tr class="table-report">
                <th rowspan="3">Source Agencies and Projects</th>
                <th rowspan="3">UACS Code</th>
                <th colspan="3">Approved Budget</th>
                <th colspan="5">Utilizations</th>
                <th colspan="5">Disbursements</th>
                <th colspan="3">Balances</th>
            </tr>
            <tr class="table-report">
                <td rowspan="2">Approved Budgeted Revenue/Receipts</td>
                <td rowspan="2">Adjustments (Additions,Reductions, Modifications/ Augmentations)</td>
                <td rowspan="2">Adjusted Budgeted Revenue</td>
                <td rowspan="2">1st Quarter</td>
                <td rowspan="2">2nd Quarter</td>
                <td rowspan="2">3rd Quarter</td>
                <td rowspan="2">4th Quarter</td>
                <td rowspan="2">Total</td>
                <td rowspan="2">1st Quarter</td>
                <td rowspan="2">2nd Quarter</td>
                <td rowspan="2">3rd Quarter</td>
                <td rowspan="2">4th Quarter</td>
                <td rowspan="2">Total</td>
                <td rowspan="2">Unutilized Budget</td>
                <td colspan="2">Unpaid Utilizations</td>
            </tr>
            <tr class="table-report">
                <td>Due and Demandables</td>
                <td>Not yet Due & Demandables</td>
            </tr>
            <tr class="table-report">
                <td style="width: 25%">1</td>
                <td style="width: 8%;">2</td>
                <td style="width: 6%;">3</td>
                <td style="width: 6%;">4</td>
                <td>5=[3+(-)4]</td>
                <td>6</td>
                <td>7</td>
                <td>8</td>
                <td>9</td>
                <td>10=(6+ 7+8+9)</td>
                <td>11</td>
                <td>12</td>
                <td>13</td>
                <td>14</td>
                <td>15=(11+ 12+13+14)</td>
                <td>16=(5-10)</td>
                <td>17</td>
                <td>18</td>
            </tr>
            <?php foreach ($data as $key => $value) : ?>
                <tr class="table-report2">
                    <td style="font-size: 9.2; text-align: left; padding: 3px;">
                        <?= $value->department ?>
                    </td>
                    <td style="text-align: center;"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <?php foreach($model->getAgency($value->department, $model->operating_unit) as $key => $agency) : ?>
                    <tr class="table-report2">
                        <td style="font-size: 9.2; text-align: left; text-indent: 15px;">
                            <?= $agency->agency ?>
                        </td>
                        <td style="text-align: left; padding-left: 6px;"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <?php foreach($model->getOu($value->department, $agency->agency, $model->operating_unit) as $key => $ou) : ?>
                        <tr class="table-report2">
                            <td style="font-size: 9.2; text-align: left; text-indent: 25px;">
                                <?= $ou->operating_office ?>
                            </td>
                            <td style="text-align: left; padding-left: 6px;"></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <?php foreach($model->getProjects($value->department, $agency->agency, $model->operating_unit, $ou->operating_office) as $key => $project) : ?>
                            <tr class="table-report2">
                                <td style="font-size: 9.2; text-align: center; padding-top: 10px;">
                                    <?= $project->project_title ?>
                                </td>
                                <td style="text-align: center;">
                                    <?= $project->uacs ?>
                                </td>
                                <td>
                                    <?= number_format($model->getBudget($project->id), 2) ?>
                                </td>
                                <td>
                                    <?= number_format($model->getBudgetadjustments($project->id), 2) ?>
                                </td>
                                <td>
                                    <?= number_format(($model->getBudget($project->id) + $model->getBudgetadjustments($project->id)), 2) ?>
                                </td>
                                <td>
                                    <?= $model->getUtilization($project->id, 1) != 0.00 ? number_format($model->getUtilization($project->id, 1), 2) : '' ?>
                                </td>
                                <td>
                                    <?= $model->getUtilization($project->id, 2) != 0.00 ? number_format($model->getUtilization($project->id, 2), 2) : '' ?>
                                </td>
                                <td>
                                    <?= $model->getUtilization($project->id, 3) != 0.00 ?number_format($model->getUtilization($project->id, 3), 2) : '' ?>
                                </td>
                                <td>
                                    <?= $model->getUtilization($project->id, 4) != 0.00 ? number_format($model->getUtilization($project->id, 4), 2) : '' ?>
                                </td>
                                <td>
                                    <?= number_format($model->getUtilization($project->id, 5), 2) ?>
                                </td>
                                <td>
                                    <?= $model->getDisbursement($project->id, 1) != 0.00 ?number_format($model->getDisbursement($project->id, 1), 2) : '' ?>
                                </td>
                                <td>
                                    <?= $model->getDisbursement($project->id, 2) != 0.00 ? number_format($model->getDisbursement($project->id, 2), 2) : '' ?>
                                </td>
                                <td>
                                    <?= $model->getDisbursement($project->id, 3) != 0.00 ? number_format($model->getDisbursement($project->id, 3), 2) : '' ?>
                                </td>
                                <td>
                                    <?= $model->getDisbursement($project->id, 4) != 0.00 ?number_format($model->getDisbursement($project->id, 4), 2) : '' ?>
                                </td>
                                <td>
                                    <?= number_format($model->getDisbursement($project->id, 5), 2) ?>
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr class="table-report2" style="height: 5px;">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        <?php endforeach ?>
                    <?php endforeach ?>
                <?php endforeach ?>
            <?php endforeach ?>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </table>
        
        <br><br>
        <table style="width: 100%; font-size: 11px;">
            <tr>
                <th style="width: 25%; height: 25px; vertical-align: top;">Certified Correct:</th>
                <th style="width: 25%; height: 25px; vertical-align: top;">Certified Correct:</th>
                <th style="width: 25%; height: 25px; vertical-align: top;">Recommending Approval:</th>
                <th style="width: 25%; height: 25px; vertical-align: top;">Approved By:</th>
            </tr>
            <tr>
                <td><input type="text" name="text" class="textfield" placeholder="Enter name here"></td>
                <td><input type="text" name="text" class="textfield" placeholder="Enter name here"></td>
                <td><input type="text" name="text" class="textfield" placeholder="Enter name here"></td>
                <td><input type="text" name="text" class="textfield" placeholder="Enter name here"></td>
            </tr>
            <tr>
                <td style="vertical-align: top;">Budget Officer</td>
                <td style="vertical-align: top;">Chief Accountant</td>
                <td style="vertical-align: top;">Director of Financial Management (FMS)</td>
                <td style="vertical-align: top;">Agency/Entity Head or Authorized Representative</td>
            </tr>
            <tr>
                <td>Date:_____________</td>
                <td>Date:_____________</td>
                <td>Date:_____________</td>
                <td>Date:_____________</td>
            </tr>
        </table>
    </div>
</div>