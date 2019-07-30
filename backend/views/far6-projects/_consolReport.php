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

$approved_budget = [];
$adjusted_budget = [];
$final_budget = [];
$utilized_1 = [];
$utilized_2 = [];
$utilized_3 = [];
$utilized_4 = [];
$utilized_total = [];

$disbursed_1 = [];
$disbursed_2 = [];
$disbursed_3 = [];
$disbursed_4 = [];
$disbursed_total = [];

$unutilized = [];
$due_demandable = [];
$notdue_demandable = [];

$utilization_ps_1 = [];
$utilization_ps_2 = [];
$utilization_ps_3 = [];
$utilization_ps_4 = [];
$utilization_ps_total = [];

$utilization_co_1 = [];
$utilization_co_2 = [];
$utilization_co_3 = [];
$utilization_co_4 = [];
$utilization_co_total = [];

$utilization_mooe_1 = [];
$utilization_mooe_2 = [];
$utilization_mooe_3 = [];
$utilization_mooe_4 = [];
$utilization_mooe_total = [];

$disbursement_ps_1 = [];
$disbursement_ps_2 = [];
$disbursement_ps_3 = [];
$disbursement_ps_4 = [];
$disbursement_ps_total = [];

$disbursement_co_1 = [];
$disbursement_co_2 = [];
$disbursement_co_3 = [];
$disbursement_co_4 = [];
$disbursement_co_total = [];

$disbursement_mooe_1 = [];
$disbursement_mooe_2 = [];
$disbursement_mooe_3 = [];
$disbursement_mooe_4 = [];
$disbursement_mooe_total = [];

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

    .table-report5 td{
        border-right: solid 1px;
        border-bottom: solid 1px;
        font-size: 8.9px;
        text-align: right;
        padding: 3px;
    }

    .table-report3 td{
        border-right: solid 1px;
        font-size: 8.5px;
        text-align: right;
        color: gray;
        font-style: italic;
    }

    .table-report4 td{
        border-top: solid 1px;
        border-right: solid 1px;
        font-size: 10px;
        text-align: center;
        font-weight: bold;
        border-top-style: double;
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
    <div style="min-width: 100%; padding: 5px; background-color: #fff; min-height: 500px; margin-left: auto;  margin-right: auto; margin-top: 5px; overflow: hide;">
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
                    As at the Quarter Ending <input type="text" name="text" class="textfield" placeholder="Enter Date here" value = <?= date('F-d-Y') ?> style="border: none; width: 20%; padding-left: 1px;">
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
                            <input type="text" name="text" class="textfield" placeholder="Enter Organization Code" value="05 001 01 00000" style="border: none; width: 90%; padding-left: 1px;">
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
                <th>Utilizations</th>
                <th>Disbursements</th>
                <th colspan="3">Balances</th>
            </tr>
            <tr class="table-report">
                <td rowspan="2">Approved Budgeted Revenue/Receipts</td>
                <td rowspan="2">Adjustments (Additions,Reductions, Modifications/ Augmentations)</td>
                <td rowspan="2">Adjusted Budgeted Revenue</td>
                <td rowspan="2">Total</td>
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
                <td style="width: 9.5%;">2</td>
                <td style="width: 9.5%;">3</td>
                <td style="width: 9.5%;">4</td>
                <td style="width: 8%;">5=[3+(-)4]</td>
                <td style="width: 8%;">10=(6+ 7+8+9)</td>
                <td style="width: 8%;">15=(11+ 12+13+14)</td>
                <td>16=(5-10)</td>
                <td>17</td>
                <td>18</td>
            </tr>
            <?php foreach ($dataProvider as $key => $value) : ?>
                <?php if($model->getCheckdata($value->abbreviation) != null) : ?>
                <tr class="table-report2">
                    <td style="font-size: 9.2; text-align: left; padding: 3px;">
                        <?= $value->abbreviation.' - '.$value->description ?>
                    </td>
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
                <?php foreach ($model->getProject($value->abbreviation) as $key => $project) : ?>
                    <tr class="table-report5">
                        <td style="font-size: 9.2; text-align: left; padding: 3px;">
                            
                        </td>
                        <td style="text-align: center;">
                            <?= $project->uacs; ?>
                        </td>
                        <td>
                            <?php 
                                echo number_format($model->getBudget($project->id), 2); 

                                array_push($approved_budget, $model->getBudget($project->id))
                            ?>
                        </td>
                        <td>
                            <?php 
                                echo number_format($model->getBudgetadjustments($project->id), 2);

                                array_push($adjusted_budget, $model->getBudgetadjustments($project->id))
                            ?>
                        </td>
                        <td>
                            <?php 
                                echo number_format(($model->getBudget($project->id) + $model->getBudgetadjustments($project->id)), 2);

                                array_push($final_budget, ($model->getBudget($project->id) + $model->getBudgetadjustments($project->id))) 
                            ?>
                        </td>
                        <td>
                            <?php 
                                echo number_format($model->getUtilization($project->id, 5), 2);

                                array_push($utilized_total, $model->getUtilization($project->id, 5));
                            ?>
                        </td>
                        <td>
                            <?php 
                                echo number_format($model->getDisbursement($project->id, 5), 2);

                                array_push($disbursed_total, $model->getDisbursement($project->id, 5))
                            ?>
                        </td>
                        <td>
                            <?php 
                                echo number_format(($model->getBudget($project->id) + $model->getBudgetadjustments($project->id)) - $model->getUtilization($project->id, 5), 2);

                                array_push($unutilized, ($model->getBudget($project->id) + $model->getBudgetadjustments($project->id)) - $model->getUtilization($project->id, 5))
                            ?>
                        </td>
                        <td>
                            <?php 
                                echo number_format($model->getUtilization($project->id, 5) - $model->getDisbursement($project->id, 5), 2);

                                array_push($due_demandable, $model->getUtilization($project->id, 5) - $model->getDisbursement($project->id, 5));
                            ?>
                        </td>
                        <td>
                            <?php 
                                echo number_format(($model->getBudget($project->id) + $model->getBudgetadjustments($project->id)) - ((($model->getBudget($project->id) + $model->getBudgetadjustments($project->id)) - $model->getUtilization($project->id, 5)) + $model->getUtilization($project->id, 5) - $model->getDisbursement($project->id, 5)), 2);

                                array_push($notdue_demandable, ($model->getBudget($project->id) + $model->getBudgetadjustments($project->id)) - ((($model->getBudget($project->id) + $model->getBudgetadjustments($project->id)) - $model->getUtilization($project->id, 5)) + $model->getUtilization($project->id, 5) - $model->getDisbursement($project->id, 5)))
                            ?>
                        </td>
                    </tr>
                <?php endforeach ?>
                <?php endif ?>
            <?php endforeach ?>
            <tr class="table-report4">
                <td>GRAND TOTAL</td>
                <td></td>
                <td>
                    <?= number_format(array_sum($approved_budget), 2) ?>
                </td>
                <td>
                    <?= number_format(array_sum($adjusted_budget), 2) ?>
                </td>
                <td>
                    <?= number_format(array_sum($final_budget), 2) ?>
                </td>
                <td>
                    <?= number_format(array_sum($utilized_total), 2) ?>
                </td>
                <td>
                    <?= number_format(array_sum($disbursed_total), 2) ?>
                </td>
                <td>
                    <?= number_format(array_sum($unutilized), 2) ?>
                </td>
                <td>
                    <?= number_format(array_sum($due_demandable), 2) ?>
                </td>
                <td>
                    <?= number_format(array_sum($notdue_demandable), 2) ?>
                </td>
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
                <td><input type="text" name="text" value="TELMA C. TOLENTINO" class="textfield" placeholder="Enter name here"></td>
                <td><input type="text" name="text" value="CHARIE SARAH D. SAQUING" class="textfield" placeholder="Enter name here"></td>
                <td><input type="text" name="text" value="MIRIAM C. CORNELIO" class="textfield" placeholder="Enter name here"></td>
                <td><input type="text" name="text" value="ATTY. FRANCISCO M. VILLANO, JR." class="textfield" placeholder="Enter name here"></td>
            </tr>
            <tr>
                <td style="vertical-align: top;">
                    <input type="text" name="text" value="Chief, Budget Division" class="textfield" placeholder="Enter Position here" style="border: none; width: 90%; padding-left: 1px;">
                </td>
                <td style="vertical-align: top;">
                    <input type="text" name="text" value="Chief, Accounting Division" class="textfield" placeholder="Enter Position here" style="border: none; width: 90%; padding-left: 1px;">
                </td>
                <td style="vertical-align: top;">
                    <input type="text" name="text" value="Director, FMS" class="textfield" placeholder="Enter Position here" style="border: none; width: 90%; padding-left: 1px;">            
                </td>
                <td style="vertical-align: top;">
                    <input type="text" name="text" value="Undersecretary - Designate for Finance" class="textfield" placeholder="Enter Position here" style="border: none; width: 90%; padding-left: 1px;">            
                </td>
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