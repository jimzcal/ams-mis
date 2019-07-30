<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use backend\models\Projects;
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
    .report-table{
        border: solid 1px;
        /*page-break-inside: auto;*/
        border-collapse: collapse;
    }

    .report-th2{
        font-size: 8px;
        text-align: center;
        vertical-align: middle;
        border: solid 1px;
    }

    .report-table td{
        font-size: 8px;
        text-align: center;
    }

    .report-table th{
        border: solid 1px;
    }

    .report-td1{
        border: solid 1px;
        border-top: solid 1px;
        vertical-align: middle;
        font-size: 13px;
        font-weight: bold;
    }

    .report-td2{
        border-right: solid 1px;
    }

    .report-td4{
        font-size: 8px;
        font-style: italic;
        border-right: solid 1px;
    }

    .report-td{
        border-right: solid 1px;
        padding-bottom: 5px;
        font-size: 9px;
    }

    .report-th{
        font-size: 9px;
        text-align: center;
        vertical-align: middle;
        border: solid 1px;
    }

    @media print{
        .report-table{
            border: solid 1px;
            width: 100%;
        }

        #project_title{
            width: 20px
        }
    }

    @page { 
      size: 13in 8.5in landscape; 
      margin: .5cm;
    }
</style>
<div class="ors-view">
    <div style="min-width: 100%; padding: 5px; background-color: #fff; min-height: 500px; margin-left: auto;  margin-right: auto; margin-top: 5px; overflow: hidden;">
        <table style="width: 100%;">
            <tr>
                <td style="height: 20px;"></td>
            </tr>
            <tr>
                <td style="font-weight: bold; text-align: right; padding-right: 20px;">
                    FAR No. 1-C
                </td>
            </tr>
        </table>

        <table style="width: 100%;">
            <tr>
                <td style="font-weight: bold; text-align: center;">
                    STATEMENT OF OBLIGATIONS, DISBURSEMENTS, LIQUIDATIONS AND BALANCES for INTER-AGENCY FUND TRANSFERS<br>
                    As at the Quarter Ending <input type="text" name="text" class="textfield" placeholder="Enter Date here" value="June 30, 2019" style="border: none; width: 20%; padding-left: 1px;">
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
                        <td style="border-bottom: solid .8px; font-weight: bold;">: 
                            <input type="text" name="text" class="textfield" placeholder="Enter Organization Code" value="Office of the Secretary" style="border: none; width: 75%; padding-left: 0px;">
                        </td>
                    </tr>
                    <tr>
                        <td>Operating Unit</td>
                        <td style="border-bottom: solid .8px; font-weight: bold;">: <?= $model->operatingunit->description  ?></td>
                    </tr>
                    <tr>
                        <td>Organization Code</td>
                        <td style="border-bottom: solid .8px; font-weight: bold;">: 
                            <input type="text" name="text" class="textfield" placeholder="Enter Organization Code" style="border: none; width: 90%; padding-left: 0px;">
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
                     <!-- <tr>
                        <td style="padding-right: 3px; font-size: 16px;">
                            <?= $model->appropriation_type == 'Prior Year' ? '<span class = "fa fa-check-square"></span>' : '<span class = "fa fa-square"></span>' ?>  
                        </td>
                        <td>Prior Year Obligation</td>
                    </tr> -->
                    <tr>
                        <td style="padding-right: 3px; font-size: 16px;">
                            <?= $model->appropriation_type == 'Current' ? '<span class = "fa fa-check-square"></span>' : '<span class = "fa fa-square"></span>' ?>  
                        </td>
                        <td>Current Year Appropriation</td>
                    </tr>
                    <tr>
                        <td style="padding-right: 3px; font-size: 16px;">
                            <?= $model->appropriation_type == 'Supplemental' ? '<span class = "fa fa-check-square"></span>' : '<span class = "fa fa-square"></span>' ?> 
                        </td>
                        <td>Supplemental Appropriation</td>
                    </tr>
                    <tr>
                        <td style="padding-right: 3px; font-size: 16px;">
                            <?= $model->appropriation_type == 'Continuing' ? '<span class = "fa fa-check-square"></span>' : '<span class = "fa fa-square"></span>' ?>   
                        </td>
                        <td>Continuing Appropriation</td>
                    </tr>
                </table>
            </div>
        </div>
        <br>

        <table style="width: 100%; border: solid 1px;" class="report-table">
            <tr>
                <th rowspan="3" class="report-th" id="project_title" style="vertical-align: middle; border: solid 1px;">Implementing Agencies and Projects</th>
                <th colspan="7" class="report-th" style="border: solid 1px;">Obligations</th>
                <th colspan="5" class="report-th" style="border: solid 1px;">Disbursements</th>
                <th colspan="5" class="report-th" style="border: solid 1px;">Liquidations</th>
                <th rowspan="3" class="report-th" style="border: solid 1px;">Unpaid Obligations</th>
                <th rowspan="3" class="report-th" style="border: solid 1px;">Unliquidated<br>Fund Transfers</th>
            </tr>
            <tr>
                <th colspan="2" class="report-th2" style="width: 15%; border: solid 1px;">
                    Obligation Request and Status
                </th>
                <th rowspan="2" class="report-th2">1st Quarter</th>
                <th rowspan="2" class="report-th2">2nd Quarter</th>
                <th rowspan="2" class="report-th2">3rd Quarter</th>
                <th rowspan="2" class="report-th2">4th Quarter</th>
                <th rowspan="2" class="report-th2">Total</th>
                <th rowspan="2" class="report-th2">1st Quarter</th>
                <th rowspan="2" class="report-th2">2nd Quarter</th>
                <th rowspan="2" class="report-th2">3rd Quarter</th>
                <th rowspan="2" class="report-th2">4th Quarter</th>
                <th rowspan="2" class="report-th2">Total</th>
                <th rowspan="2" class="report-th2">1st Quarter</th>
                <th rowspan="2" class="report-th2">2nd Quarter</th>
                <th rowspan="2" class="report-th2">3rd Quarter</th>
                <th rowspan="2" class="report-th2">4th Quarter</th>
                <th rowspan="2" class="report-th2">Total</th>
            </tr>
            <tr>
                <th class="report-th2">Number</th>
                <th class="report-th2">Date</th>
            </tr>
            <tr style="text-align: center;">
                <td class="report-td1" style="width: 20%;">1</td>
                <td class="report-td1">2</td>
                <td class="report-td1">3</td>
                <td class="report-td1">4</td>
                <td class="report-td1">5</td>
                <td class="report-td1">6</td>
                <td class="report-td1">7</td>
                <td class="report-td1" style="font-size: 7px;">8=(4+5+6+7)</td>
                <td class="report-td1">9</td>
                <td class="report-td1">10</td>
                <td class="report-td1">11</td>
                <td class="report-td1">12</td>
                <td class="report-td1" style="font-size: 7px;">13=(9+10+11+12)</td>
                <td class="report-td1">14</td>
                <td class="report-td1">15</td>
                <td class="report-td1">16</td>
                <td class="report-td1">17</td>
                <td class="report-td1" style="font-size: 7px;">18=(14+15+16+17)</td>
                <td class="report-td1">19=(8+13)</td>
                <td class="report-td1" style="font-size: 7px;">20=(13-18)</td>
            </tr>

            <?php foreach ($data as $key => $value): ?>
               <?php if($model->getCheckdepartment($value->department, $model->ors_year, $model->appropriation_type, $model->fund_cluster) != 0) : ?>
                <tr>
                    <td class="report-td2" style="text-align: left; padding-left: 3px;"><?= $value->department ?></td>
                    <td class="report-td2"></td>
                    <td class="report-td2"></td>
                    <td class="report-td2"></td>
                    <td class="report-td2"></td>
                    <td class="report-td2"></td>
                    <td class="report-td2"></td>
                    <td class="report-td2"></td>
                    <td class="report-td2"></td>
                    <td class="report-td2"></td>
                    <td class="report-td2"></td>
                    <td class="report-td2"></td>
                    <td class="report-td2"></td>
                    <td class="report-td2"></td>
                    <td class="report-td2"></td>
                    <td class="report-td2"></td>
                    <td class="report-td2"></td>
                    <td class="report-td2"></td>
                    <td class="report-td2"></td>
                    <td class="report-td2"></td>
                </tr>
                <?php foreach ($value->getAgency($value->department, $model->operating_unit) as $key => $val) : ?>
                     <?php if($model->getCheckagency($val->agency, $model->ors_year, $model->appropriation_type, $model->fund_cluster) != 0) : ?>
                    <tr>
                        <td class="report-td2" style = "text-indent: 10px; text-align: left;"><?= $val->agency; ?></td>
                        <td class="report-td2"></td>
                        <td class="report-td2"></td>
                        <td class="report-td2"></td>
                        <td class="report-td2"></td>
                        <td class="report-td2"></td>
                        <td class="report-td2"></td>
                        <td class="report-td2"></td>
                        <td class="report-td2"></td>
                        <td class="report-td2"></td>
                        <td class="report-td2"></td>
                        <td class="report-td2"></td>
                        <td class="report-td2"></td>
                        <td class="report-td2"></td>
                        <td class="report-td2"></td>
                        <td class="report-td2"></td>
                        <td class="report-td2"></td>
                        <td class="report-td2"></td>
                        <td class="report-td2"></td>
                        <td class="report-td2"></td>
                    </tr>
                    <?php foreach ($value->getOu($value->department, $val->agency) as $key => $data) : ?>
                        <tr>
                            <td class="report-td2" style = "text-indent: 20px; text-align: left;"><?= $data->operating_office; ?></td>
                            <td class="report-td2"></td>
                            <td class="report-td2"></td>
                            <td class="report-td2"></td>
                            <td class="report-td2"></td>
                            <td class="report-td2"></td>
                            <td class="report-td2"></td>
                            <td class="report-td2"></td>
                            <td class="report-td2"></td>
                            <td class="report-td2"></td>
                            <td class="report-td2"></td>
                            <td class="report-td2"></td>
                            <td class="report-td2"></td>
                            <td class="report-td2"></td>
                            <td class="report-td2"></td>
                            <td class="report-td2"></td>
                            <td class="report-td2"></td>
                            <td class="report-td2"></td>
                            <td class="report-td2"></td>
                            <td class="report-td2"></td>
                        </tr>
                        <tr style="height: 6px;">
                            <td class="report-td2"></td>
                            <td class="report-td2"></td>
                            <td class="report-td2"></td>
                            <td class="report-td2"></td>
                            <td class="report-td2"></td>
                            <td class="report-td2"></td>
                            <td class="report-td2"></td>
                            <td class="report-td2"></td>
                            <td class="report-td2"></td>
                            <td class="report-td2"></td>
                            <td class="report-td2"></td>
                            <td class="report-td2"></td>
                            <td class="report-td2"></td>
                            <td class="report-td2"></td>
                            <td class="report-td2"></td>
                            <td class="report-td2"></td>
                            <td class="report-td2"></td>
                            <td class="report-td2"></td>
                            <td class="report-td2"></td>
                            <td class="report-td2"></td>
                        </tr>
                        <?php foreach ($value->getProjects($value->department, $val->agency, $data->operating_office) as $key => $project) : ?>

                            <?php if($model->getCheckproject($project->id, $model->appropriation_type, $model->fund_cluster) != null) : ?>
                            <tr>
                                <td class="report-td2" style = "text-align: center;"><?= $project->project_title; ?></td>
                                <td class="report-td2">
                                    <?php 
                                        foreach ($value->getOrs($project->id, $model->appropriation_type, $model->ors_year) as $key => $ors) 
                                        {
                                            echo $ors->ors_no.'<br>';
                                        }
                                    ?>
                                </td>
                                <td class="report-td2">
                                    <?php 
                                        foreach ($value->getOrs($project->id, $model->appropriation_type, $model->ors_year) as $key => $ors) 
                                        {
                                            echo $ors->ors_date.'<br>';
                                        }
                                    ?>
                                </td>
                                <td class="report-td2">
                                    <?php 
                                        foreach ($value->getOrs($project->id, $model->appropriation_type, $model->ors_year) as $key => $ors) 
                                        {
                                            echo $value->getObligation($ors->ors_no, $project->id, 1, $model->appropriation_type, $value->operating_unit, $model->fund_cluster) != 0.00 ? '<div style="text-align: center;">'.number_format($value->getObligation($ors->ors_no, $project->id, 1, $model->appropriation_type, $value->operating_unit, $model->fund_cluster), 2).'</div>' : '-';

                                            array_push($obligate_first, $value->getObligation($ors->ors_no, $project->id, 1, $model->appropriation_type, $value->operating_unit, $model->fund_cluster));
                                        }
                                    ?>  
                                </td>
                                <td class="report-td2">
                                    <?php 
                                        foreach ($value->getOrs($project->id, $model->appropriation_type, $model->ors_year) as $key => $ors) 
                                        {
                                            echo $value->getObligation($ors->ors_no, $project->id, 2, $model->appropriation_type, $value->operating_unit, $model->fund_cluster) != 0.00 ? '<div style="text-align: center;">'.number_format($value->getObligation($ors->ors_no, $project->id, 2, $model->appropriation_type, $value->operating_unit, $model->fund_cluster), 2).'</div>' : '-';

                                            array_push($obligate_second, $value->getObligation($ors->ors_no, $project->id, 2, $model->appropriation_type, $value->operating_unit, $model->fund_cluster));
                                        }
                                    ?>
                                </td>
                                <td class="report-td2">
                                    <?php 
                                        foreach ($value->getOrs($project->id, $model->appropriation_type, $model->ors_year) as $key => $ors) 
                                        {
                                            echo $value->getObligation($ors->ors_no, $project->id, 3, $model->appropriation_type, $value->operating_unit, $model->fund_cluster) != 0.00 ? '<div style="text-align: center;">'.number_format($value->getObligation($ors->ors_no, $project->id, 3, $model->appropriation_type, $value->operating_unit, $model->fund_cluster), 2).'</div>' : '-';

                                            array_push($obligate_third, $value->getObligation($ors->ors_no, $project->id, 3, $model->appropriation_type, $value->operating_unit, $model->fund_cluster));
                                        }
                                    ?> 
                                </td>
                                <td class="report-td2">
                                    <?php 
                                        foreach ($value->getOrs($project->id, $model->appropriation_type, $model->ors_year) as $key => $ors) 
                                        {
                                            echo $value->getObligation($ors->ors_no, $project->id, 4, $model->appropriation_type, $value->operating_unit, $model->fund_cluster) != 0.00 ? '<div style="text-align: center;">'.number_format($value->getObligation($ors->ors_no, $project->id, 4, $model->appropriation_type, $value->operating_unit, $model->fund_cluster), 2).'</div>' : '-';

                                            array_push($obligate_fourth, $value->getObligation($ors->ors_no, $project->id, 4, $model->appropriation_type, $value->operating_unit, $model->fund_cluster));
                                        }
                                    ?>              
                                </td>
                                <td class="report-td2" style="text-align: right;">
                                    <?php 
                                        foreach ($value->getOrs($project->id, $model->appropriation_type, $model->ors_year) as $key => $ors) 
                                        {
                                            echo $value->getTotalobligation($ors->ors_no, $project->id, $model->appropriation_type, $value->operating_unit, $model->fund_cluster) != 0.00 ? '<div style="text-align: center;">'.number_format($value->getTotalobligation($ors->ors_no, $project->id, $model->appropriation_type, $value->operating_unit, $model->fund_cluster), 2).'</div>' : '-';

                                            array_push($obligate_total, $value->getTotalobligation($ors->ors_no, $project->id, $model->appropriation_type, $value->operating_unit, $model->fund_cluster));
                                        }
                                    ?>                
                                </td>
                                <td class="report-td2">
                                    <?php 
                                        foreach ($value->getOrs($project->id, $model->appropriation_type, $model->ors_year) as $key => $ors) 
                                        {
                                            echo $value->getDisbursement($ors->ors_no, $project->id, 1, $value->operating_unit, $model->ors_year) != 0.00 ? '<div style="text-align: center;">'.number_format($value->getDisbursement($ors->ors_no, $project->id, 1, $value->operating_unit, $model->ors_year), 2).'</div>' : '-';

                                            array_push($disbursed_first, $value->getDisbursement($ors->ors_no, $project->id, 1, $value->operating_unit, $model->ors_year));
                                        }
                                    ?>         
                                </td>
                                <td class="report-td2">
                                    <?php 
                                        foreach ($value->getOrs($project->id, $model->appropriation_type, $model->ors_year) as $key => $ors) 
                                        {
                                            echo $value->getDisbursement($ors->ors_no, $project->id, 2, $value->operating_unit, $model->ors_year) != 0.00 ? '<div style="text-align: center;">'.number_format($value->getDisbursement($ors->ors_no, $project->id, 2, $value->operating_unit, $model->ors_year), 2).'</div>' : '-';

                                            array_push($disbursed_second, $value->getDisbursement($ors->ors_no, $project->id, 2, $value->operating_unit, $model->ors_year));
                                        }
                                    ?>               
                                </td>
                                <td class="report-td2">
                                    <?php 
                                        foreach ($value->getOrs($project->id, $model->appropriation_type, $model->ors_year) as $key => $ors) 
                                        {
                                            echo $value->getDisbursement($ors->ors_no, $project->id, 3, $value->operating_unit, $model->ors_year) != 0.00 ? '<div style="text-align: center;">'.number_format($value->getDisbursement($ors->ors_no, $project->id, 3, $value->operating_unit, $model->ors_year), 2).'</div>' : '-';

                                            array_push($disbursed_third, $value->getDisbursement($ors->ors_no, $project->id, 3, $value->operating_unit, $model->ors_year));
                                        }
                                    ?> 
                                </td>
                                <td class="report-td2">
                                    <?php 
                                        foreach ($value->getOrs($project->id, $model->appropriation_type, $model->ors_year) as $key => $ors) 
                                        {
                                            echo $value->getDisbursement($ors->ors_no, $project->id, 4, $value->operating_unit, $model->ors_year) != 0.00 ? '<div style="text-align: center;">'.number_format($value->getDisbursement($ors->ors_no, $project->id, 4, $value->operating_unit, $model->ors_year), 2).'</div>' : '-';

                                            array_push($disbursed_fourth, $value->getDisbursement($ors->ors_no, $project->id, 4, $value->operating_unit, $model->ors_year));
                                        }
                                    ?> 
                                </td>
                                <td class="report-td2">
                                    <?php 
                                        foreach ($value->getOrs($project->id, $model->appropriation_type, $model->ors_year) as $key => $ors) 
                                        {
                                            echo $value->getDisbursement($ors->ors_no, $project->id, 5, $value->operating_unit, $model->ors_year) != 0.00 ? '<div style="text-align: center;">'.number_format($value->getDisbursement($ors->ors_no, $project->id, 5, $value->operating_unit, $model->ors_year), 2).'</div>' : '-';

                                            array_push($disbursed_total, $value->getDisbursement($ors->ors_no, $project->id, 5, $value->operating_unit, $model->ors_year));
                                        }
                                    ?>  
                                </td>
                                <td class="report-td2">
                                    <?php 
                                        foreach ($value->getOrs($project->id, $model->appropriation_type, $model->ors_year) as $key => $ors) 
                                        {
                                            echo $value->getLiquidation($ors->ors_no, $project->id, 1, $value->operating_unit, $model->ors_year) != 0.00 ? '<div style="text-align: center;">'.number_format($value->getLiquidation($ors->ors_no, $project->id, 1, $value->operating_unit, $model->ors_year), 2).'</div>' : '-';

                                            array_push($liquidate_first, $value->getLiquidation($ors->ors_no, $project->id, 1, $value->operating_unit, $model->ors_year));
                                        }
                                    ?>                
                                </td>
                                <td class="report-td2">
                                    <?php 
                                        foreach ($value->getOrs($project->id, $model->appropriation_type, $model->ors_year) as $key => $ors) 
                                        {
                                            echo $value->getLiquidation($ors->ors_no, $project->id, 2, $value->operating_unit, $model->ors_year) != 0.00 ? '<div style="text-align: center;">'.number_format($value->getLiquidation($ors->ors_no, $project->id, 2, $value->operating_unit, $model->ors_year), 2).'</div>' : '-';

                                            array_push($liquidate_second, $value->getLiquidation($ors->ors_no, $project->id, 2, $value->operating_unit, $model->ors_year));
                                        }
                                    ?>           
                                </td>
                                <td class="report-td2">
                                    <?php 
                                        foreach ($value->getOrs($project->id, $model->appropriation_type, $model->ors_year) as $key => $ors) 
                                        {
                                            echo $value->getLiquidation($ors->ors_no, $project->id, 3, $value->operating_unit, $model->ors_year) != 0.00 ? '<div style="text-align: center;">'.number_format($value->getLiquidation($ors->ors_no, $project->id, 3, $value->operating_unit, $model->ors_year), 2).'</div>' : '-';

                                            array_push($liquidate_third, $value->getLiquidation($ors->ors_no, $project->id, 3, $value->operating_unit, $model->ors_year));
                                        }
                                    ?>         
                                </td>
                                <td class="report-td2">
                                    <?php 
                                        foreach ($value->getOrs($project->id, $model->appropriation_type, $model->ors_year) as $key => $ors) 
                                        {
                                            echo $value->getLiquidation($ors->ors_no, $project->id, 4, $value->operating_unit, $model->ors_year) != 0.00 ? '<div style="text-align: center;">'.number_format($value->getLiquidation($ors->ors_no, $project->id, 4, $value->operating_unit, $model->ors_year), 2).'</div>' : '-';

                                            array_push($liquidate_fourth, $value->getLiquidation($ors->ors_no, $project->id, 4, $value->operating_unit, $model->ors_year));
                                        }
                                    ?>              
                                </td>
                                <td class="report-td2" style="text-align: right;">
                                    <?php 
                                        foreach ($value->getOrs($project->id, $model->appropriation_type, $model->ors_year) as $key => $ors) 
                                        {
                                            echo $value->getLiquidation($ors->ors_no, $project->id, 5, $value->operating_unit, $model->ors_year) != 0.00 ? '<div style="text-align: center;">'.number_format($value->getLiquidation($ors->ors_no, $project->id, 5, $value->operating_unit, $model->ors_year), 2).'</div>' : '-';

                                            array_push($liquidate_total, $value->getLiquidation($ors->ors_no, $project->id, 5, $value->operating_unit, $model->ors_year));
                                        }
                                    ?>
                                </td>
                                <td class="report-td2" style="text-align: right;">
                                    <?php 
                                        foreach ($value->getOrs($project->id, $model->appropriation_type, $model->ors_year) as $key => $ors) 
                                        {
                                            echo number_format($value->getTotalobligation($ors->ors_no, $project->id, $model->appropriation_type, $value->operating_unit, $model->fund_cluster) - $value->getDisbursement($ors->ors_no, $project->id, 5, $value->operating_unit, $model->ors_year), 2);
                                            echo '<br>';

                                            array_push($unpaid_total, ($value->getTotalobligation($ors->ors_no, $project->id, $model->appropriation_type, $value->operating_unit, $model->fund_cluster) - $value->getDisbursement($ors->ors_no, $project->id, 5, $value->operating_unit, $model->ors_year)));
                                        }
                                    ?>        
                                </td>
                                <td class="report-td2" style="text-align: right;">
                                    <?php 
                                        foreach ($value->getOrs($project->id, $model->appropriation_type, $model->ors_year) as $key => $ors) 
                                        {
                                            echo number_format($value->getDisbursement($ors->ors_no, $project->id, 5, $value->operating_unit, $model->ors_year) - $value->getLiquidation($ors->ors_no, $project->id, 5, $value->operating_unit, $model->ors_year), 2);

                                            array_push($unliquidated_total, ($value->getDisbursement($ors->ors_no, $project->id, 5, $value->operating_unit, $model->ors_year) - $value->getLiquidation($ors->ors_no, $project->id, 5, $value->operating_unit, $model->ors_year)));
                                        }
                                    ?>               
                                </td>
                            </tr>

                            <tr>
                                <td class="report-td4" style="text-align: center; font-style: italic;">PS</td>
                                <td class="report-td4"></td>
                                <td class="report-td4"></td>
                                <td class="report-td4">
                                    <?= $model->getExpenceob($value->operating_unit, $project->id, '01', $model->appropriation_type, 1, $model->ors_year) != 0 ? number_format($model->getExpenceob($value->operating_unit, $project->id, '01', $model->appropriation_type, 1, $model->ors_year), 2) : ''; ?>
                                </td>
                            
                                <td class="report-td4">
                                    <?= $model->getExpenceob($value->operating_unit, $project->id, '01', $model->appropriation_type, 2, $model->ors_year) != 0 ? number_format($model->getExpenceob($value->operating_unit, $project->id, '01', $model->appropriation_type, 2, $model->ors_year), 2) : ''; ?>
                                </td>
                                <td class="report-td4">
                                    <?= $model->getExpenceob($value->operating_unit, $project->id, '01', $model->appropriation_type, 3, $model->ors_year) != 0 ? number_format($model->getExpenceob($value->operating_unit, $project->id, '01', $model->appropriation_type, 3, $model->ors_year), 2) : ''; ?>
                                </td>
                                <td class="report-td4">
                                    <?= $model->getExpenceob($value->operating_unit, $project->id, '01', $model->appropriation_type, 4, $model->ors_year) != 0 ? number_format($model->getExpenceob($value->operating_unit, $project->id, '01', $model->appropriation_type, 4, $model->ors_year), 2) : ''; ?>
                                </td>
                                <td class="report-td4">
                                    <?= $model->getExpenceobtotal($value->operating_unit, $project->id, '01', $model->appropriation_type, $model->ors_year) != 0 ? number_format($model->getExpenceobtotal($value->operating_unit, $project->id, '01', $model->appropriation_type, $model->ors_year), 2) : ''; ?>
                                </td>
                            
                                <td class="report-td4">
                                    <?= $model->getExpenceDis($value->operating_unit, $project->id, '01', 1, $model->year) != 0 ? number_format($model->getExpenceDis($value->operating_unit, $project->id, '01', 1, $model->year) ,2) : ''; ?>
                                </td>
                                <td class="report-td4">
                                    <?= $model->getExpenceDis($value->operating_unit, $project->id, '01', 2, $model->year) != 0 ? number_format($model->getExpenceDis($value->operating_unit, $project->id, '01', 2, $model->year) ,2) : ''; ?>
                                </td>
                                <td class="report-td4">
                                    <?= $model->getExpenceDis($value->operating_unit, $project->id, '01', 3, $model->year) != 0 ? number_format($model->getExpenceDis($value->operating_unit, $project->id, '01', 3, $model->year) ,2) : ''; ?>
                                </td>
                                <td class="report-td4">
                                    <?= $model->getExpenceDis($value->operating_unit, $project->id, '01', 4, $model->year) != 0 ? number_format($model->getExpenceDis($value->operating_unit, $project->id, '01', 4, $model->year) ,2) : ''; ?>
                                </td>
                                <td class="report-td4">
                                    <?= $model->getExpenceDistotal($value->operating_unit, $project->id, '01', $model->year) != 0 ? number_format($model->getExpenceDistotal($value->operating_unit, $project->id, '01', $model->year) ,2) : ''; ?>
                                </td>
                                <td class="report-td4">
                                    <?= $model->getExpenceliq($value->operating_unit, $project->id, '01', 1, $model->ors_year) != 0 ? number_format($model->getExpenceliq($value->operating_unit, $project->id, '01', 1, $model->ors_year) ,2) : ''; ?>
                                </td>
                                <td class="report-td4">
                                    <?= $model->getExpenceliq($value->operating_unit, $project->id, '01', 2, $model->ors_year) != 0 ? number_format($model->getExpenceliq($value->operating_unit, $project->id, '01', 2, $model->ors_year) ,2) : ''; ?>
                                </td>
                                <td class="report-td2">
                                    <?= $model->getExpenceliq($value->operating_unit, $project->id, '01', 3, $model->ors_year) != 0 ? number_format($model->getExpenceliq($value->operating_unit, $project->id, '01', 3, $model->ors_year) ,2) : ''; ?>
                                </td>
                                <td class="report-td4">
                                    <?= $model->getExpenceliq($value->operating_unit, $project->id, '01', 4, $model->ors_year) != 0 ? number_format($model->getExpenceliq($value->operating_unit, $project->id, '01', 4, $model->ors_year) ,2) : ''; ?>
                                </td>
                                <td class="report-td4">
                                    <?= $model->getExpenceliqtotal($value->operating_unit, $project->id, '01', $model->ors_year) != 0 ? number_format($model->getExpenceliqtotal($value->operating_unit, $project->id, '01', $model->ors_year) ,2) : ''; ?>
                                </td>
                                <td class="report-td2"></td>
                                <td class="report-td2"></td>
                            </tr>

                            <tr>
                                <td class="report-td2" style="text-align: center; font-style: italic;">MOOE</td>
                                <td class="report-td2"></td>
                                <td class="report-td2"></td>
                                <td class="report-td4">
                                    <?= $model->getExpenceob($value->operating_unit, $project->id, '02', $model->appropriation_type, 1, $model->ors_year) != 0 ? number_format($model->getExpenceob($value->operating_unit, $project->id, '02', $model->appropriation_type, 1, $model->ors_year), 2) : ''; ?>
                                </td>
                            
                                <td class="report-td4">
                                    <?= $model->getExpenceob($value->operating_unit, $project->id, '02', $model->appropriation_type, 2, $model->ors_year) != 0 ? number_format($model->getExpenceob($value->operating_unit, $project->id, '02', $model->appropriation_type, 2, $model->ors_year), 2) : ''; ?>
                                </td>
                                <td class="report-td4">
                                    <?= $model->getExpenceob($value->operating_unit, $project->id, '02', $model->appropriation_type, 3, $model->ors_year) != 0 ? number_format($model->getExpenceob($value->operating_unit, $project->id, '02', $model->appropriation_type, 3, $model->ors_year), 2) : ''; ?>
                                </td>
                                <td class="report-td4">
                                    <?= $model->getExpenceob($value->operating_unit, $project->id, '02', $model->appropriation_type, 4, $model->ors_year) != 0 ? number_format($model->getExpenceob($value->operating_unit, $project->id, '02', $model->appropriation_type, 4, $model->ors_year), 2) : ''; ?>
                                </td>
                                <td class="report-td4">
                                    <?= $model->getExpenceobtotal($value->operating_unit, $project->id, '02', $model->appropriation_type, $model->ors_year) != 0 ? number_format($model->getExpenceobtotal($value->operating_unit, $project->id, '02', $model->appropriation_type, $model->ors_year), 2) : ''; ?>
                                </td>
                            
                                <td class="report-td4">
                                    <?= $model->getExpenceDis($value->operating_unit, $project->id, '02', 1, $model->year) != 0 ? number_format($model->getExpenceDis($value->operating_unit, $project->id, '02', 1, $model->year) ,2) : ''; ?>
                                </td>
                                <td class="report-td4">
                                    <?= $model->getExpenceDis($value->operating_unit, $project->id, '02', 2, $model->year) != 0 ? number_format($model->getExpenceDis($value->operating_unit, $project->id, '01', 2, $model->year) ,2) : ''; ?>
                                </td>
                                <td class="report-td4">
                                    <?= $model->getExpenceDis($value->operating_unit, $project->id, '02', 3, $model->year) != 0 ? number_format($model->getExpenceDis($value->operating_unit, $project->id, '02', 3, $model->year) ,2) : ''; ?>
                                </td>
                                <td class="report-td4">
                                    <?= $model->getExpenceDis($value->operating_unit, $project->id, '02', 4, $model->year) != 0 ? number_format($model->getExpenceDis($value->operating_unit, $project->id, '02', 4, $model->year) ,2) : ''; ?>
                                </td>
                                <td class="report-td4">
                                    <?= $model->getExpenceDistotal($value->operating_unit, $project->id, '02', $model->year) != 0 ? number_format($model->getExpenceDistotal($value->operating_unit, $project->id, '02', $model->year) ,2) : ''; ?>
                                </td>
                                <td class="report-td4">
                                    <?= $model->getExpenceliq($value->operating_unit, $project->id, '02', 1, $model->ors_year) != 0 ? number_format($model->getExpenceliq($value->operating_unit, $project->id, '02', 1, $model->ors_year) ,2) : ''; ?>
                                </td>
                                <td class="report-td4">
                                    <?= $model->getExpenceliq($value->operating_unit, $project->id, '02', 2, $model->ors_year) != 0 ? number_format($model->getExpenceliq($value->operating_unit, $project->id, '02', 2, $model->ors_year) ,2) : ''; ?>
                                </td>
                                <td class="report-td4">
                                    <?= $model->getExpenceliq($value->operating_unit, $project->id, '02', 3, $model->ors_year) != 0 ? number_format($model->getExpenceliq($value->operating_unit, $project->id, '02', 3, $model->ors_year) ,2) : ''; ?>
                                </td>
                                <td class="report-td4">
                                    <?= $model->getExpenceliq($value->operating_unit, $project->id, '02', 4, $model->ors_year) != 0 ? number_format($model->getExpenceliq($value->operating_unit, $project->id, '02', 4, $model->ors_year) ,2) : ''; ?>
                                </td>
                                <td class="report-td4">
                                    <?= $model->getExpenceliqtotal($value->operating_unit, $project->id, '02', $model->ors_year) != 0 ? number_format($model->getExpenceliqtotal($value->operating_unit, $project->id, '02', $model->ors_year) ,2) : ''; ?>
                                </td>
                                <td class="report-td2"></td>
                                <td class="report-td2"></td>
                            </tr>
                             
                            <tr>
                                <td class="report-td4" style="text-align: center; font-style: italic;">CO</td>
                                <td class="report-td4"></td>
                                <td class="report-td4"></td>
                                <td class="report-td4">
                                    <?= $model->getExpenceob($value->operating_unit, $project->id, '06', $model->appropriation_type, 1, $model->ors_year) != 0 ? number_format($model->getExpenceob($value->operating_unit, $project->id, '01', $model->appropriation_type, 1, $model->ors_year), 2) : ''; ?>
                                </td>
                            
                                <td class="report-td4">
                                    <?= $model->getExpenceob($value->operating_unit, $project->id, '06', $model->appropriation_type, 2, $model->ors_year) != 0 ? number_format($model->getExpenceob($value->operating_unit, $project->id, '06', $model->appropriation_type, 2, $model->ors_year), 2) : ''; ?>
                                </td>
                                <td class="report-td4">
                                    <?= $model->getExpenceob($value->operating_unit, $project->id, '06', $model->appropriation_type, 3, $model->ors_year) != 0 ? number_format($model->getExpenceob($value->operating_unit, $project->id, '06', $model->appropriation_type, 3, $model->ors_year), 2) : ''; ?>
                                </td>
                                <td class="report-td4">
                                    <?= $model->getExpenceob($value->operating_unit, $project->id, '06', $model->appropriation_type, 4, $model->ors_year) != 0 ? number_format($model->getExpenceob($value->operating_unit, $project->id, '06', $model->appropriation_type, 4, $model->ors_year), 2) : ''; ?>
                                </td>
                                <td class="report-td4">
                                    <?= $model->getExpenceobtotal($value->operating_unit, $project->id, '06', $model->appropriation_type, $model->ors_year) != 0 ? number_format($model->getExpenceobtotal($value->operating_unit, $project->id, '06', $model->appropriation_type, $model->ors_year), 2) : ''; ?>
                                </td>
                            
                                <td class="report-td4">
                                    <?= $model->getExpenceDis($value->operating_unit, $project->id, '06', 1, $model->year) != 0 ? number_format($model->getExpenceDis($value->operating_unit, $project->id, '06', 1, $model->year) ,2) : ''; ?>
                                </td>
                                <td class="report-td4">
                                    <?= $model->getExpenceDis($value->operating_unit, $project->id, '06', 2, $model->year) != 0 ? number_format($model->getExpenceDis($value->operating_unit, $project->id, '06', 2, $model->year) ,2) : ''; ?>
                                </td>
                                <td class="report-td4">
                                    <?= $model->getExpenceDis($value->operating_unit, $project->id, '06', 3, $model->year) != 0 ? number_format($model->getExpenceDis($value->operating_unit, $project->id, '06', 3, $model->year) ,2) : ''; ?>
                                </td>
                                <td class="report-td4">
                                    <?= $model->getExpenceDis($value->operating_unit, $project->id, '06', 4, $model->year) != 0 ? number_format($model->getExpenceDis($value->operating_unit, $project->id, '06', 4, $model->year) ,2) : ''; ?>
                                </td>
                                <td class="report-td4">
                                    <?= $model->getExpenceDistotal($value->operating_unit, $project->id, '06', $model->year) != 0 ? number_format($model->getExpenceDistotal($value->operating_unit, $project->id, '06', $model->year) ,2) : ''; ?>
                                </td>
                                <td class="report-td4">
                                    <?= $model->getExpenceliq($value->operating_unit, $project->id, '06', 1, $model->ors_year) != 0 ? number_format($model->getExpenceliq($value->operating_unit, $project->id, '06', 1, $model->ors_year) ,2) : ''; ?>
                                </td>
                                <td class="report-td4">
                                    <?= $model->getExpenceliq($value->operating_unit, $project->id, '06', 2, $model->ors_year) != 0 ? number_format($model->getExpenceliq($value->operating_unit, $project->id, '06', 2, $model->ors_year) ,2) : ''; ?>
                                </td>
                                <td class="report-td2">
                                    <?= $model->getExpenceliq($value->operating_unit, $project->id, '06', 3, $model->ors_year) != 0 ? number_format($model->getExpenceliq($value->operating_unit, $project->id, '06', 3, $model->ors_year) ,2) : ''; ?>
                                </td>
                                <td class="report-td4">
                                    <?= $model->getExpenceliq($value->operating_unit, $project->id, '06', 4, $model->ors_year) != 0 ? number_format($model->getExpenceliq($value->operating_unit, $project->id, '06', 4, $model->ors_year) ,2) : ''; ?>
                                </td>
                                <td class="report-td4">
                                    <?= $model->getExpenceliqtotal($value->operating_unit, $project->id, '06', $model->ors_year) != 0 ? number_format($model->getExpenceliqtotal($value->operating_unit, $project->id, '06', $model->ors_year) ,2) : ''; ?>
                                </td>
                                <td class="report-td2"></td>
                                <td class="report-td2"></td>
                            </tr>
                                
                            <?php endif ?>
                            <tr style="height: 5px;">
                                <td class="report-td2"></td>
                                <td class="report-td2"></td>
                                <td class="report-td2"></td>
                                <td class="report-td2"></td>
                                <td class="report-td2"></td>
                                <td class="report-td2"></td>
                                <td class="report-td2"></td>
                                <td class="report-td2"></td>
                                <td class="report-td2"></td>
                                <td class="report-td2"></td>
                                <td class="report-td2"></td>
                                <td class="report-td2"></td>
                                <td class="report-td2"></td>
                                <td class="report-td2"></td>
                                <td class="report-td2"></td>
                                <td class="report-td2"></td>
                                <td class="report-td2"></td>
                                <td class="report-td2"></td>
                                <td class="report-td2"></td>
                                <td class="report-td2"></td>
                            </tr>
                        <?php endforeach ?>
                        <tr style="height: 10px;">
                            <td class="report-td2"></td>
                            <td class="report-td2"></td>
                            <td class="report-td2"></td>
                            <td class="report-td2"></td>
                            <td class="report-td2"></td>
                            <td class="report-td2"></td>
                            <td class="report-td2"></td>
                            <td class="report-td2"></td>
                            <td class="report-td2"></td>
                            <td class="report-td2"></td>
                            <td class="report-td2"></td>
                            <td class="report-td2"></td>
                            <td class="report-td2"></td>
                            <td class="report-td2"></td>
                            <td class="report-td2"></td>
                            <td class="report-td2"></td>
                            <td class="report-td2"></td>
                            <td class="report-td2"></td>
                            <td class="report-td2"></td>
                            <td class="report-td2"></td>
                        </tr>
                    <?php endforeach ?>
                <?php endif ?>
                <?php endforeach ?>
            <?php endif ?>
            <?php endforeach ?>
            <tr style="text-align: center;">
                <td class="report-td1">GRAND TOTAL</td>
                <td class="report-td1"></td>
                <td class="report-td1"></td>
                <td class="report-td1">
                    <?= number_format(array_sum($obligate_first), 2) ?>
                </td>
                <td class="report-td1">
                    <?= number_format(array_sum($obligate_second), 2) ?>
                </td>
                <td class="report-td1">
                    <?= number_format(array_sum($obligate_third), 2) ?>
                </td>
                <td class="report-td1">
                    <?= number_format(array_sum($obligate_fourth), 2) ?>
                </td>
                <td class="report-td1">
                    <?= number_format(array_sum($obligate_total), 2) ?>
                </td>
                <td class="report-td1">
                    <?= number_format(array_sum($disbursed_first), 2) ?>
                </td>
                <td class="report-td1">
                    <?= number_format(array_sum($disbursed_second), 2) ?>
                </td>
                <td class="report-td1">
                    <?= number_format(array_sum($disbursed_third), 2) ?>
                </td>
                <td class="report-td1">
                    <?= number_format(array_sum($disbursed_fourth), 2) ?>
                </td>
                <td class="report-td1">
                    <?= number_format(array_sum($disbursed_total), 2) ?>
                </td>
                <td class="report-td1">
                    <?= number_format(array_sum($liquidate_first), 2) ?>
                </td>
                <td class="report-td1">
                    <?= number_format(array_sum($liquidate_second), 2) ?>
                </td>
                <td class="report-td1">
                    <?= number_format(array_sum($liquidate_third), 2) ?>
                </td>
                <td class="report-td1">
                    <?= number_format(array_sum($liquidate_fourth), 2) ?>
                </td>
                <td class="report-td1">
                    <?= number_format(array_sum($liquidate_total), 2) ?>
                </td>
                <td class="report-td1">
                    <?= number_format(array_sum($unpaid_total), 2) ?>
                </td>
                <td class="report-td1">
                    <?= number_format(array_sum($unliquidated_total), 2) ?>
                </td>
            </tr>
        </table>
        <br><br>
        <table style="width: 100%; font-size: 11px;">
            <tr>
                <th style="width: 25%; height: 25px; vertical-align: top;">Certified Correct:</th>
                <th style="width: 25%; height: 25px; vertical-align: top;">Certified Correct:</th>
                <th style="width: 25%; height: 25px; vertical-align: top;">Approved By:</th>
                <!-- <th style="width: 25%; height: 25px; vertical-align: top;">Approved By:</th> -->
            </tr>
            <tr>
                <td><input type="text" name="text" class="textfield" placeholder="Enter name here"></td>
                <td><input type="text" name="text" class="textfield" placeholder="Enter name here"></td>
                <td><input type="text" name="text" class="textfield" placeholder="Enter name here"></td>
                <!-- <td><input type="text" name="text" class="textfield" placeholder="Enter name here"></td> -->
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
                <!-- <td style="vertical-align: top;">
                    <input type="text" name="text" class="textfield" placeholder="Enter Position here" style="border: none; width: 90%; padding-left: 1px;">            
                </td> -->
            </tr>
            <tr>
                <td>Date:_____________</td>
                <td>Date:_____________</td>
                <td>Date:_____________</td>
                <!-- <td>Date:_____________</td> -->
            </tr>
        </table>
    </div>
</div>