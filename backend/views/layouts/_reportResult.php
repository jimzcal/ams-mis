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
                            <tr class="table-report2" style="height: 10px;">
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

                            <tr class="table-report2">
                                <td style="font-size: 9.2; text-align: center;">
                                    <?= $project->project_title ?>
                                </td>
                                <td style="text-align: center;">
                                    <?= $project->uacs ?>
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
                                        echo $model->getUtilization($project->id, 1) != 0.00 ? number_format($model->getUtilization($project->id, 1), 2) : '';

                                        array_push($utilized_1, $model->getUtilization($project->id, 1));
                                    ?>
                                </td>
                                <td>
                                    <?php 
                                        echo $model->getUtilization($project->id, 2) != 0.00 ? number_format($model->getUtilization($project->id, 2), 2) : '';

                                        array_push($utilized_2, $model->getUtilization($project->id, 2));
                                    ?>
                                </td>
                                <td>
                                    <?php 
                                        echo $model->getUtilization($project->id, 3) != 0.00 ?number_format($model->getUtilization($project->id, 3), 2) : '';

                                        array_push($utilized_3, $model->getUtilization($project->id, 3));
                                    ?>
                                </td>
                                <td>
                                    <?php 
                                        echo $model->getUtilization($project->id, 4) != 0.00 ? number_format($model->getUtilization($project->id, 4), 2) : '';

                                        array_push($utilized_4, $model->getUtilization($project->id, 4));
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
                                        echo $model->getDisbursement($project->id, 1) != 0.00 ?number_format($model->getDisbursement($project->id, 1), 2) : '';

                                        array_push($disbursed_1, $model->getDisbursement($project->id, 1));
                                    ?>
                                </td>
                                <td>
                                    <?php 
                                        echo $model->getDisbursement($project->id, 2) != 0.00 ? number_format($model->getDisbursement($project->id, 2), 2) : '';

                                        array_push($disbursed_2, $model->getDisbursement($project->id, 2));
                                    ?>
                                </td>
                                <td>
                                    <?php 
                                        echo $model->getDisbursement($project->id, 3) != 0.00 ? number_format($model->getDisbursement($project->id, 3), 2) : '';

                                        array_push($disbursed_3, $model->getDisbursement($project->id, 3));
                                    ?>
                                </td>
                                <td>
                                    <?php 
                                        echo $model->getDisbursement($project->id, 4) != 0.00 ?number_format($model->getDisbursement($project->id, 4), 2) : '';

                                        array_push($disbursed_4, $model->getDisbursement($project->id, 4));
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
                            <tr class="table-report3">
                                <td style="text-align: center;">PS</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <?php 
                                        echo $model->getUtilization2($project->id, '01', 1) != 0.00 ? number_format($model->getUtilization2($project->id, '01', 1), 2) : '';  

                                        array_push($utilization_ps_1, $model->getUtilization2($project->id, '01', 1));
                                    ?>
                                </td>
                                <td>
                                    <?php echo $model->getUtilization2($project->id, '01', 2) != 0.00 ? number_format($model->getUtilization2($project->id, '01', 2), 2) : '';

                                        array_push($utilization_ps_2, $model->getUtilization2($project->id, '01', 2))
                                    ?>
                                </td>
                                <td>
                                    <?php echo $model->getUtilization2($project->id, '01', 3) != 0.00 ? number_format($model->getUtilization2($project->id, '01', 3), 2) : '';

                                        array_push($utilization_ps_3, $model->getUtilization2($project->id, '01', 3));
                                    ?>
                                </td>
                                <td>
                                    <?php echo $model->getUtilization2($project->id, '01', 4) != 0.00 ? number_format($model->getUtilization2($project->id, '01', 4), 2) : '';

                                        array_push($utilization_ps_4, $model->getUtilization2($project->id, '01', 4));
                                    ?>
                                </td>
                                <td>
                                    <?php echo $model->getUtilization2($project->id, '01', 5) != 0.00 ? number_format($model->getUtilization2($project->id, '01', 5), 2) : '';

                                        array_push($utilization_ps_total, $model->getUtilization2($project->id, '01', 5));
                                    ?>
                                </td>

                                <td>
                                    <?php echo $model->getDisbursement2($project->id, '01', 1) != 0.00 ? number_format($model->getDisbursement2($project->id, '01', 1), 2) : '';

                                        array_push($disbursement_ps_1, $model->getDisbursement2($project->id, '01', 1));
                                    ?>
                                </td>
                                <td>
                                    <?php echo $model->getDisbursement2($project->id, '01', 2) != 0.00 ? number_format($model->getDisbursement2($project->id, '01', 2), 2) : '';

                                        array_push($disbursement_ps_2, $model->getDisbursement2($project->id, '01', 2));
                                    ?>
                                </td>
                                <td>
                                    <?php echo $model->getDisbursement2($project->id, '01', 3) != 0.00 ? number_format($model->getDisbursement2($project->id, '01', 3), 2) : '';

                                        array_push($disbursement_ps_3, $model->getDisbursement2($project->id, '01', 3));
                                    ?>
                                </td>
                                <td>
                                    <?php echo $model->getDisbursement2($project->id, '01', 4) != 0.00 ? number_format($model->getDisbursement2($project->id, '01', 4), 2) : '';

                                        array_push($disbursement_ps_4, $model->getDisbursement2($project->id, '01', 4));
                                    ?>
                                </td>
                                <td>
                                    <?php echo $model->getDisbursement2($project->id, '01', 5) != 0.00 ? number_format($model->getDisbursement2($project->id, '01', 5), 2) : '';

                                        array_push($disbursement_ps_total, $model->getDisbursement2($project->id, '01', 5));
                                    ?>
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr class="table-report3">
                                <td style="text-align: center;">MOOE</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <?php echo $model->getUtilization2($project->id, '02', 1) != 0.00 ? number_format($model->getUtilization2($project->id, '01', 1), 2) : '';

                                        array_push($utilization_mooe_1, $model->getUtilization2($project->id, '02', 1));
                                    ?>
                                </td>
                                <td>
                                    <?php echo $model->getUtilization2($project->id, '02', 2) != 0.00 ? number_format($model->getUtilization2($project->id, '01', 2), 2) : '';

                                        array_push($utilization_mooe_2, $model->getUtilization2($project->id, '02', 2))
                                    ?>
                                </td>
                                <td>
                                    <?php echo $model->getUtilization2($project->id, '02', 3) != 0.00 ? number_format($model->getUtilization2($project->id, '01', 3), 2) : '';

                                        array_push($utilization_mooe_3, $model->getUtilization2($project->id, '02', 3));
                                    ?>
                                </td>
                                <td>
                                    <?php echo $model->getUtilization2($project->id, '02', 4) != 0.00 ? number_format($model->getUtilization2($project->id, '01', 4), 2) : '';

                                        array_push($utilization_mooe_4, $model->getUtilization2($project->id, '02', 4));
                                    ?>
                                </td>
                                <td>
                                    <?php echo $model->getUtilization2($project->id, '02', 5) != 0.00 ? number_format($model->getUtilization2($project->id, '01', 5), 2) : '';

                                        array_push($utilization_mooe_total, $model->getUtilization2($project->id, '02', 5));
                                    ?>
                                </td>

                                <td>
                                    <?php echo $model->getDisbursement2($project->id, '02', 1) != 0.00 ? number_format($model->getDisbursement2($project->id, '01', 1), 2) : '';

                                        array_push($disbursement_mooe_1, $model->getDisbursement2($project->id, '02', 1))
                                    ?>
                                </td>
                                <td>
                                    <?php echo $model->getDisbursement2($project->id, '02', 2) != 0.00 ? number_format($model->getDisbursement2($project->id, '01', 2), 2) : '';

                                        array_push($disbursement_mooe_2, $model->getDisbursement2($project->id, '02', 2));
                                    ?>
                                </td>
                                <td>
                                    <?php echo $model->getDisbursement2($project->id, '02', 3) != 0.00 ? number_format($model->getDisbursement2($project->id, '01', 3), 2) : '';

                                        array_push($disbursement_mooe_3, $model->getDisbursement2($project->id, '02', 3));
                                    ?>
                                </td>
                                <td>
                                    <?php echo $model->getDisbursement2($project->id, '02', 4) != 0.00 ? number_format($model->getDisbursement2($project->id, '01', 4), 2) : '';

                                        array_push($disbursement_mooe_4, $model->getDisbursement2($project->id, '02', 4))
                                    ?>
                                </td>
                                <td>
                                    <?php echo $model->getDisbursement2($project->id, '02', 5) != 0.00 ? number_format($model->getDisbursement2($project->id, '01', 5), 2) : '';

                                        array_push($disbursement_mooe_total, $model->getDisbursement2($project->id, '02', 5));
                                    ?>
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr class="table-report3">
                                <td style="text-align: center;">CO</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <?php echo $model->getUtilization2($project->id, '06', 1) != 0.00 ? number_format($model->getUtilization2($project->id, '01', 1), 2) : '';

                                        array_push($utilization_co_1, $model->getUtilization2($project->id, '06', 1));
                                    ?>
                                </td>
                                <td>
                                    <?php echo $model->getUtilization2($project->id, '06', 2) != 0.00 ? number_format($model->getUtilization2($project->id, '01', 2), 2) : '';

                                        array_push($utilization_co_2, $model->getUtilization2($project->id, '06', 2));
                                    ?>
                                </td>
                                <td>
                                    <?php echo $model->getUtilization2($project->id, '06', 3) != 0.00 ? number_format($model->getUtilization2($project->id, '01', 3), 2) : '';

                                        array_push($utilization_co_3, $model->getUtilization2($project->id, '06', 3));
                                    ?>
                                </td>
                                <td>
                                    <?php echo $model->getUtilization2($project->id, '06', 4) != 0.00 ? number_format($model->getUtilization2($project->id, '01', 4), 2) : '';

                                        array_push($utilization_co_4, $model->getUtilization2($project->id, '06', 4));
                                    ?>
                                </td>
                                <td>
                                    <?php echo $model->getUtilization2($project->id, '06', 5) != 0.00 ? number_format($model->getUtilization2($project->id, '01', 5), 2) : '';

                                        array_push($utilization_co_total, $model->getUtilization2($project->id, '06', 5));
                                    ?>
                                </td>

                                <td>
                                    <?php echo $model->getDisbursement2($project->id, '06', 1) != 0.00 ? number_format($model->getDisbursement2($project->id, '01', 1), 2) : '';

                                        array_push($disbursement_co_1, $model->getDisbursement2($project->id, '06', 1));
                                    ?>
                                </td>
                                <td>
                                    <?php echo $model->getDisbursement2($project->id, '06', 2) != 0.00 ? number_format($model->getDisbursement2($project->id, '01', 2), 2) : '';

                                        array_push($disbursement_co_2, $model->getDisbursement2($project->id, '06', 2));
                                    ?>
                                </td>
                                <td>
                                    <?php echo $model->getDisbursement2($project->id, '06', 3) != 0.00 ? number_format($model->getDisbursement2($project->id, '01', 3), 2) : '';

                                        array_push($disbursement_co_3, $model->getDisbursement2($project->id, '06', 3));
                                    ?>
                                </td>
                                <td>
                                    <?php echo $model->getDisbursement2($project->id, '06', 4) != 0.00 ? number_format($model->getDisbursement2($project->id, '01', 4), 2) : '';

                                        array_push($disbursement_co_4, $model->getDisbursement2($project->id, '06', 4));
                                    ?>
                                </td>
                                <td>
                                    <?php echo $model->getDisbursement2($project->id, '06', 5) != 0.00 ? number_format($model->getDisbursement2($project->id, '01', 5), 2) : '';

                                        array_push($disbursement_co_total, $model->getDisbursement2($project->id, '06', 5));
                                    ?>
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        <?php endforeach ?>
                    <?php endforeach ?>
                <?php endforeach ?>
            <?php endforeach ?>

            <?php if($data == null) : ?>
                <tr class="table-report2" style="border: solid 1px;">
                    <td colspan="18" style="font-style: italic; font-size: 14px; font-weight: bold; text-align: center;">
                        NO TRANSACTION
                    </td>
                </tr>
            <?php endif ?>
            
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
                    <?= number_format(array_sum($utilized_1), 2) ?>
                </td>
                <td>
                    <?= number_format(array_sum($utilized_2), 2) ?>
                </td>
                <td>
                    <?= number_format(array_sum($utilized_3), 2) ?>
                </td>
                <td>
                    <?= number_format(array_sum($utilized_4), 2) ?>
                </td>
                <td>
                    <?= number_format(array_sum($utilized_total), 2) ?>
                </td>
                <td>
                    <?= number_format(array_sum($disbursed_1), 2) ?>
                </td>
                <td>
                    <?= number_format(array_sum($disbursed_2), 2) ?>
                </td>
                <td>
                    <?= number_format(array_sum($disbursed_3), 2) ?>
                </td>
                <td>
                    <?= number_format(array_sum($disbursed_4), 2) ?>
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
            <tr class="table-report3">
                <td style="text-align: center;">PS</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <?= number_format(array_sum($utilization_ps_1), 2) ?>
                </td>
                <td>
                    <?= number_format(array_sum($utilization_ps_2), 2) ?>
                </td>
                <td>
                    <?= number_format(array_sum($utilization_ps_3), 2) ?>
                </td>
                <td>
                    <?= number_format(array_sum($utilization_ps_4), 2) ?>
                </td>
                <td>
                    <?= number_format(array_sum($utilization_ps_total), 2) ?>
                </td>
                <td>
                    <?= number_format(array_sum($disbursement_ps_1), 2) ?>
                </td>
                <td>
                    <?= number_format(array_sum($disbursement_ps_2), 2) ?>
                </td>
                <td>
                    <?= number_format(array_sum($disbursement_ps_3), 2) ?>
                </td>
                <td>
                    <?= number_format(array_sum($disbursement_ps_4), 2) ?>
                </td>
                <td>
                    <?= number_format(array_sum($disbursement_ps_total), 2) ?>
                </td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr class="table-report3">
                <td style="text-align: center;">MOOE</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <?= number_format(array_sum($utilization_mooe_1), 2) ?>
                </td>
                <td>
                    <?= number_format(array_sum($utilization_mooe_2), 2) ?>
                </td>
                <td>
                    <?= number_format(array_sum($utilization_mooe_3), 2) ?>
                </td>
                <td>
                    <?= number_format(array_sum($utilization_mooe_4), 2) ?>
                </td>
                <td>
                    <?= number_format(array_sum($utilization_mooe_total), 2) ?>
                </td>
                <td>
                    <?= number_format(array_sum($disbursement_mooe_1), 2) ?>
                </td>
                <td>
                    <?= number_format(array_sum($disbursement_mooe_2), 2) ?>
                </td>
                <td>
                    <?= number_format(array_sum($disbursement_mooe_3), 2) ?>
                </td>
                <td>
                    <?= number_format(array_sum($disbursement_mooe_4), 2) ?>
                </td>
                <td>
                    <?= number_format(array_sum($disbursement_mooe_total), 2) ?>
                </td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr class="table-report3">
                <td style="text-align: center;">CO</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <?= number_format(array_sum($utilization_co_1), 2) ?>
                </td>
                <td>
                    <?= number_format(array_sum($utilization_co_2), 2) ?>
                </td>
                <td>
                    <?= number_format(array_sum($utilization_co_3), 2) ?>
                </td>
                <td>
                    <?= number_format(array_sum($utilization_co_4), 2) ?>
                </td>
                <td>
                    <?= number_format(array_sum($utilization_co_total), 2) ?>
                </td>
                <td>
                    <?= number_format(array_sum($disbursement_co_1), 2) ?>
                </td>
                <td>
                    <?= number_format(array_sum($disbursement_co_2), 2) ?>
                </td>
                <td>
                    <?= number_format(array_sum($disbursement_co_3), 2) ?>
                </td>
                <td>
                    <?= number_format(array_sum($disbursement_co_4), 2) ?>
                </td>
                <td>
                    <?= number_format(array_sum($disbursement_co_total), 2) ?>
                </td>
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
                <td style="vertical-align: top;">
                    <input type="text" name="text" class="textfield" placeholder="Enter Position here" style="border: none; width: 90%; padding-left: 1px;">
                </td>
                <td style="vertical-align: top;">
                    <input type="text" name="text" class="textfield" placeholder="Enter Position here" style="border: none; width: 90%; padding-left: 1px;">
                </td>
                <td style="vertical-align: top;">
                    <input type="text" name="text" class="textfield" placeholder="Enter Position here" style="border: none; width: 90%; padding-left: 1px;">            
                </td>
                <td style="vertical-align: top;">
                    <input type="text" name="text" class="textfield" placeholder="Enter Position here" style="border: none; width: 90%; padding-left: 1px;">            
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