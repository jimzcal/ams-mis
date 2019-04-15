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
	.report-table{
		border: solid 1px;
	}

	.report-th2{
		font-size: 8px;
		text-align: center;
		vertical-align: middle;
		border: solid 1px;
	}

	.report-table td{
		font-size: 9px;
		text-align: center;
	}

	.report-td1{
		border: solid 1px;
		border-top: solid 1px;
		vertical-align: middle;
		font-size: 13px;
		font-weight: bold;
	}

	.report-td{
		border-right: solid 1px;
		padding-bottom: 5px;
		font-size: 9px;
	}

	.report-th{
		font-size: 10px;
		text-align: center;
		vertical-align: middle;
		border: solid 1px;
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
    			<td style="font-weight: bold; text-align: center;">
    				STATEMENT OF OBLIGATIONS, DISBURSEMENTS, LIQUIDATIONS AND BALANCES for INTER-AGENCY FUND TRANSFERS
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
    					<td style="border-bottom: solid .8px; font-weight: bold;">: </td>
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
    						<?= $model->appropriation_type == 'Current' ? '<span class = "fa fa-check-square"></span>' : '<span class = "fa fa-square"></span>' ?>	
    					</td>
    					<td>Current Year Appropriation</td>
    				</tr>
    				<tr>
    					<td style="padding-right: 5px; font-size: 20px;">
    						<?= $model->appropriation_type == 'Supplemental' ? '<span class = "fa fa-check-square"></span>' : '<span class = "fa fa-square"></span>' ?>	
    					</td>
    					<td>Supplementant Appropriation</td>
    				</tr>
    				<tr>
    					<td style="padding-right: 5px; font-size: 20px;">
    						<?= $model->appropriation_type == 'Continuing' ? '<span class = "fa fa-check-square"></span>' : '<span class = "fa fa-square"></span>' ?>	
    					</td>
    					<td>Continuing Appropriation</td>
    				</tr>
    			</table>
    		</div>
    	</div>
    	<br>

    	<table style="width: 100%;" class="table table-condensed report-table">
    		<tr>
    			<th rowspan="3" class="report-th" style="vertical-align: middle;">Implementing Agencies and Projects</th>
    			<th colspan="7" class="report-th">Obligations</th>
    			<th colspan="5" class="report-th">Disbursements (Funds Transfered to)</th>
    			<th colspan="5" class="report-th">Liquidations</th>
    			<th rowspan="3" class="report-th">Unpaid Obligations</th>
    			<th rowspan="3" class="report-th">Unliquidated<br>Fund Transfers</th>
    		</tr>
    		<tr>
    			<th colspan="2" class="report-th2" style="width: 15%;">
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
    			<tr>
	    			<td class="report-td" style="text-align: left;">
	    				<?= $value->department ?>
	    				<br>
	    				<?php foreach ($value->getAgency($value->department) as $key => $val) 
	    				{
	    					echo '<div style = "text-indent: 10px;">'.$val->agency.'</div>';

	    					foreach ($value->getOu($value->department, $val->agency) as $key => $data) 
	    					{
	    						echo '<div style = "text-indent: 20px;">'.$data->operating_office.'</div>';
	    						echo "<br>";

	    						foreach ($value->getProjects($value->department, $val->agency, $data->operating_office) as $key => $project) 
	    						{
	    							echo '<div style="text-align: center;">'.$project->project_title.'</div><br><br>';
	    						}
	    					}
	    				} ?>
	    			</td>
	    			<td class="report-td">
	    				<br><br><br><br>
	    				<?php foreach ($value->getAgency($value->department) as $key => $val) 
	    				{
	    					foreach ($value->getOu($value->department, $val->agency) as $key => $data) 
	    					{
	    						foreach ($value->getProjects($value->department, $val->agency, $data->operating_office) as $key => $project) 
	    						{
	    							foreach ($value->getOrs($project->id, $model->year) as $key => $ors) 
			    					{
			    						echo $ors->ors_no.'<br>';
			    					}
			    					echo "<br><br>";
	    						}
	    						echo "<br><br><br>";
	    					}
	    				} ?>
	    			</td>
	    			<td class="report-td">
	    				<br><br><br><br>
	    				<?php foreach ($value->getAgency($value->department) as $key => $val) 
	    				{
	    					foreach ($value->getOu($value->department, $val->agency) as $key => $data) 
	    					{
	    						foreach ($value->getProjects($value->department, $val->agency, $data->operating_office) as $key => $project) 
	    						{
	    							foreach ($value->getOrs($project->id, $model->year) as $key => $ors) 
			    					{
			    						echo $ors->ors_date.'<br>';
			    					}
			    					echo "<br><br>";
	    						}
	    						echo "<br><br><br>";
	    					}
	    				} ?>
	    			</td>
	    			<td class="report-td">
	    				<br><br><br><br>
	    				<?php foreach ($value->getAgency($value->department) as $key => $val) 
	    				{
	    					foreach ($value->getOu($value->department, $val->agency) as $key => $data) 
	    					{
	    						foreach ($value->getProjects($value->department, $val->agency, $data->operating_office) as $key => $project) 
	    						{
	    							foreach ($value->getOrs($project->id, $model->year) as $key => $ors) 
			    					{
			    						echo '<div style="text-align: center;">'.number_format($value->getObligation($ors->ors_no, $project->id, 1, $model->appropriation_type, $value->operating_unit, $model->year, $model->fund_cluster), 2).'</div>';

			    						array_push($obligate_first, $value->getObligation($ors->ors_no, $project->id, 1, $model->appropriation_type, $value->operating_unit, $model->year, $model->fund_cluster));
			    					}
			    					echo "<br><br>";
	    						}
	    						echo "<br><br><br>";
	    					}
	    				} ?>
	    			</td>
	    			<td class="report-td">
	    				<br><br><br><br>
	    				<?php foreach ($value->getAgency($value->department) as $key => $val) 
	    				{
	    					foreach ($value->getOu($value->department, $val->agency) as $key => $data) 
	    					{
	    						foreach ($value->getProjects($value->department, $val->agency, $data->operating_office) as $key => $project) 
	    						{
	    							foreach ($value->getOrs($project->id, $model->year) as $key => $ors) 
			    					{
			    						echo '<div style="text-align: center;">'.number_format($value->getObligation($ors->ors_no, $project->id, 2, $model->appropriation_type, $value->operating_unit, $model->year, $model->fund_cluster), 2).'</div>';

			    						array_push($obligate_second, $project->getObligation($ors->ors_no, $value->id, 2, $model->appropriation_type, $value->operating_unit, $model->year, $model->fund_cluster));
			    					}
			    					echo "<br><br>";
	    						}
	    						echo "<br><br><br>";
	    					}
	    				} ?>
	    			</td>
	    			<td class="report-td">
	    				<br><br><br><br>
	    				<?php foreach ($value->getAgency($value->department) as $key => $val) 
	    				{
	    					foreach ($value->getOu($value->department, $val->agency) as $key => $data) 
	    					{
	    						foreach ($value->getProjects($value->department, $val->agency, $data->operating_office) as $key => $project) 
	    						{
	    							foreach ($value->getOrs($project->id, $model->year) as $key => $ors) 
			    					{
			    						echo '<div style="text-align: center;">'.number_format($value->getObligation($ors->ors_no, $project->id, 3, 'Current', $value->operating_unit, $model->year, $model->fund_cluster), 2).'</div>';

			    						array_push($obligate_third, $value->getObligation($ors->ors_no, $project->id, 3, $model->appropriation_type, $value->operating_unit, $model->year, $model->fund_cluster));
			    					}
			    					echo "<br><br>";
	    						}
	    						echo "<br><br><br>";
	    					}
	    				} ?>
	    			</td>
	    			<td class="report-td">
	    				<br><br><br><br>
	    				<?php foreach ($value->getAgency($value->department) as $key => $val) 
	    				{
	    					foreach ($value->getOu($value->department, $val->agency) as $key => $data) 
	    					{
	    						foreach ($value->getProjects($value->department, $val->agency, $data->operating_office) as $key => $project) 
	    						{
	    							foreach ($value->getOrs($project->id, $model->year) as $key => $ors) 
			    					{
			    						echo '<div style="text-align: center;">'.number_format($value->getObligation($ors->ors_no, $project->id, 4, $model->appropriation_type, $value->operating_unit, $model->year, $model->fund_cluster), 2).'</div>';

			    						array_push($obligate_fourth, $value->getObligation($ors->ors_no, $project->id, 4, $model->appropriation_type, $value->operating_unit, $model->year, $model->fund_cluster));
			    					}
			    					echo "<br><br>";
	    						}
	    						echo "<br><br><br>";
	    					}
	    				} ?>
	    			</td>
	    			<td class="report-td">
	    				<br><br><br><br>
	    				<?php foreach ($value->getAgency($value->department) as $key => $val) 
	    				{
	    					foreach ($value->getOu($value->department, $val->agency) as $key => $data) 
	    					{
	    						foreach ($value->getProjects($value->department, $val->agency, $data->operating_office) as $key => $project) 
	    						{
	    							foreach ($value->getOrs($project->id, $model->year) as $key => $ors) 
			    					{
			    						echo '<div style="text-align: center;">'.number_format($value->getTotalobligation($ors->ors_no, $project->id, $model->appropriation_type, $value->operating_unit, $model->year, $model->fund_cluster), 2).'</div>';

			    						array_push($obligate_total, $value->getTotalobligation($ors->ors_no, $project->id, $model->appropriation_type, $value->operating_unit, $model->year, $model->fund_cluster));
			    					}
			    					echo "<br><br>";
	    						}
	    						echo "<br><br><br>";
	    					}
	    				} ?>
	    			</td>
	    			<td class="report-td">
	    				<br><br><br><br>
	    				<?php foreach ($value->getAgency($value->department) as $key => $val) 
	    				{
	    					foreach ($value->getOu($value->department, $val->agency) as $key => $data) 
	    					{
	    						foreach ($value->getProjects($value->department, $val->agency, $data->operating_office) as $key => $project) 
	    						{
	    							foreach ($value->getOrs($project->id, $model->year) as $key => $ors) 
			    					{
			    						echo '<div style="text-align: center;">'.number_format($value->getDisbursement($ors->ors_no, $project->id, 1, $model->appropriation_type, $value->operating_unit, $model->year, $model->fund_cluster), 2).'</div>';

			    						array_push($disbursed_first, $value->getDisbursement($ors->ors_no, $project->id, 1, $model->appropriation_type, $value->operating_unit, $model->year, $model->fund_cluster));
			    					}
			    					echo "<br><br>";
	    						}
	    						echo "<br><br><br>";
	    					}
	    				} ?>
	    			</td>
	    			<td class="report-td">
	    				<br><br><br><br>
	    				<?php foreach ($value->getAgency($value->department) as $key => $val) 
	    				{
	    					foreach ($value->getOu($value->department, $val->agency) as $key => $data) 
	    					{
	    						foreach ($value->getProjects($value->department, $val->agency, $data->operating_office) as $key => $project) 
	    						{
	    							foreach ($value->getOrs($project->id, $model->year) as $key => $ors) 
			    					{
			    						echo '<div style="text-align: center;">'.number_format($value->getDisbursement($ors->ors_no, $project->id, 2, $model->appropriation_type, $value->operating_unit, $model->year, $model->fund_cluster), 2).'</div>';

			    						array_push($disbursed_second, $value->getDisbursement($ors->ors_no, $project->id, 2, $model->appropriation_type, $value->operating_unit, $model->year, $model->fund_cluster));
			    					}
			    					echo "<br><br>";
	    						}
	    						echo "<br><br><br>";
	    					}
	    				} ?>
	    			</td>
	    			<td class="report-td">
	    				<br><br><br><br>
	    				<?php foreach ($value->getAgency($value->department) as $key => $val) 
	    				{
	    					foreach ($value->getOu($value->department, $val->agency) as $key => $data) 
	    					{
	    						foreach ($value->getProjects($value->department, $val->agency, $data->operating_office) as $key => $project) 
	    						{
	    							foreach ($value->getOrs($project->id, $model->year) as $key => $ors) 
			    					{
			    						echo '<div style="text-align: center;">'.number_format($value->getDisbursement($ors->ors_no, $project->id, 3, $model->appropriation_type, $value->operating_unit, $model->year, $model->fund_cluster), 2).'</div>';

			    						array_push($disbursed_third, $value->getDisbursement($ors->ors_no, $project->id, 3, $model->appropriation_type, $value->operating_unit, $model->year, $model->fund_cluster));
			    					}
			    					echo "<br><br>";
	    						}
	    						echo "<br><br><br>";
	    					}
	    				} ?>
	    			</td>
	    			<td class="report-td">
	    				<br><br><br><br>
	    				<?php foreach ($value->getAgency($value->department) as $key => $val) 
	    				{
	    					foreach ($value->getOu($value->department, $val->agency) as $key => $data) 
	    					{
	    						foreach ($value->getProjects($value->department, $val->agency, $data->operating_office) as $key => $project) 
	    						{
	    							foreach ($value->getOrs($project->id, $model->year) as $key => $ors) 
			    					{
			    						echo '<div style="text-align: center;">'.number_format($value->getDisbursement($ors->ors_no, $project->id, 4, $model->appropriation_type, $value->operating_unit, $model->year, $model->fund_cluster), 2).'</div>';

			    						array_push($disbursed_fourth, $value->getDisbursement($ors->ors_no, $project->id, 4, $model->appropriation_type, $value->operating_unit, $model->year, $model->fund_cluster));
			    					}
			    					echo "<br><br>";
	    						}
	    						echo "<br><br><br>";
	    					}
	    				} ?>
	    			</td>
	    			<td class="report-td">
	    				<br><br><br><br>
	    				<?php foreach ($value->getAgency($value->department) as $key => $val) 
	    				{
	    					foreach ($value->getOu($value->department, $val->agency) as $key => $data) 
	    					{
	    						foreach ($value->getProjects($value->department, $val->agency, $data->operating_office) as $key => $project) 
	    						{
	    							foreach ($value->getOrs($project->id, $model->year) as $key => $ors) 
			    					{
			    						echo '<div style="text-align: center;">'.number_format($value->getTotaldisbursement($ors->ors_no, $project->id, $model->appropriation_type, $value->operating_unit, $model->year, $model->fund_cluster), 2).'</div>';

			    						array_push($disbursed_total, $value->getTotaldisbursement($ors->ors_no, $project->id, $model->appropriation_type, $value->operating_unit, $model->year, $model->fund_cluster));
			    					}
			    					echo "<br><br>";
	    						}
	    						echo "<br><br><br>";
	    					}
	    				} ?>
	    			</td>
	    			<td class="report-td">
	    				<br><br><br><br>
	    				<?php foreach ($value->getAgency($value->department) as $key => $val) 
	    				{
	    					foreach ($value->getOu($value->department, $val->agency) as $key => $data) 
	    					{
	    						foreach ($value->getProjects($value->department, $val->agency, $data->operating_office) as $key => $project) 
	    						{
	    							foreach ($value->getOrs($project->id, $model->year) as $key => $ors) 
			    					{
			    						echo '<div style="text-align: center;">'.number_format($value->getLiquidation($ors->ors_no, $project->id, 1, $model->appropriation_type, $value->operating_unit, $model->year, $model->fund_cluster), 2).'</div>';

			    						array_push($liquidate_first, $value->getLiquidation($ors->ors_no, $project->id, 1, $model->appropriation_type, $value->operating_unit, $model->year, $model->fund_cluster));
			    					}
			    					echo "<br><br>";
	    						}
	    						echo "<br><br><br>";
	    					}
	    				} ?>
	    			</td>
	    			<td class="report-td">
	    				<br><br><br><br>
	    				<?php foreach ($value->getAgency($value->department) as $key => $val) 
	    				{
	    					foreach ($value->getOu($value->department, $val->agency) as $key => $data) 
	    					{
	    						foreach ($value->getProjects($value->department, $val->agency, $data->operating_office) as $key => $project) 
	    						{
	    							foreach ($value->getOrs($project->id, $model->year) as $key => $ors) 
			    					{
			    						echo '<div style="text-align: center;">'.number_format($value->getLiquidation($ors->ors_no, $project->id, 2, $model->appropriation_type, $value->operating_unit, $model->year, $model->fund_cluster), 2).'</div>';

			    						array_push($liquidate_second, $value->getLiquidation($ors->ors_no, $project->id, 2, $model->appropriation_type, $value->operating_unit, $model->year, $model->fund_cluster));
			    					}
			    					echo "<br><br>";
	    						}
	    						echo "<br><br><br>";
	    					}
	    				} ?>
	    			</td>
	    			<td class="report-td">
	    				<br><br><br><br>
	    				<?php foreach ($value->getAgency($value->department) as $key => $val) 
	    				{
	    					foreach ($value->getOu($value->department, $val->agency) as $key => $data) 
	    					{
	    						foreach ($value->getProjects($value->department, $val->agency, $data->operating_office) as $key => $project) 
	    						{
	    							foreach ($value->getOrs($project->id, $model->year) as $key => $ors) 
			    					{
			    						echo '<div style="text-align: center;">'.number_format($value->getLiquidation($ors->ors_no, $project->id, 3, $model->appropriation_type, $value->operating_unit, $model->year, $model->fund_cluster), 2).'</div>';

			    						array_push($liquidate_third, $value->getLiquidation($ors->ors_no, $project->id, 3, $model->appropriation_type, $value->operating_unit, $model->year, $model->fund_cluster));
			    					}
			    					echo "<br><br>";
	    						}
	    						echo "<br><br><br>";
	    					}
	    				} ?>
	    			</td>
	    			<td class="report-td">
	    				<br><br><br><br>
	    				<?php foreach ($value->getAgency($value->department) as $key => $val) 
	    				{
	    					foreach ($value->getOu($value->department, $val->agency) as $key => $data) 
	    					{
	    						foreach ($value->getProjects($value->department, $val->agency, $data->operating_office) as $key => $project) 
	    						{
	    							foreach ($value->getOrs($project->id, $model->year) as $key => $ors) 
			    					{
			    						echo '<div style="text-align: center;">'.number_format($value->getLiquidation($ors->ors_no, $project->id, 4, $model->appropriation_type, $value->operating_unit, $model->year, $model->fund_cluster), 2).'</div>';

			    						array_push($liquidate_fourth, $value->getLiquidation($ors->ors_no, $project->id, 4, $model->appropriation_type, $value->operating_unit, $model->year, $model->fund_cluster));
			    					}
			    					echo "<br><br>";
	    						}
	    						echo "<br><br><br>";
	    					}
	    				} ?>
	    			</td>
	    			<td class="report-td">
	    				<br><br><br><br>
	    				<?php foreach ($value->getAgency($value->department) as $key => $val) 
	    				{
	    					foreach ($value->getOu($value->department, $val->agency) as $key => $data) 
	    					{
	    						foreach ($value->getProjects($value->department, $val->agency, $data->operating_office) as $key => $project) 
	    						{
	    							foreach ($value->getOrs($project->id, $model->year) as $key => $ors) 
			    					{
			    						echo '<div style="text-align: center;">'.number_format($value->getTotalliquidation($ors->ors_no, $project->id, $model->appropriation_type, $value->operating_unit, $model->year, $model->fund_cluster), 2).'</div>';

			    						array_push($liquidate_total, $value->getTotalliquidation($ors->ors_no, $project->id, $model->appropriation_type, $value->operating_unit, $model->year, $model->fund_cluster));
			    					}
			    					echo "<br><br>";
	    						}
	    						echo "<br><br><br>";
	    					}
	    				} ?>
	    			</td>
	    			<td class="report-td">
	    				<br><br><br><br>
	    				<?php foreach ($value->getAgency($value->department) as $key => $val) 
	    				{
	    					foreach ($value->getOu($value->department, $val->agency) as $key => $data) 
	    					{
	    						foreach ($value->getProjects($value->department, $val->agency, $data->operating_office) as $key => $project) 
	    						{
	    							foreach ($value->getOrs($project->id, $model->year) as $key => $ors) 
			    					{
			    						echo '<div style="text-align: center;">'.number_format(($value->getTotalobligation($ors->ors_no, $project->id, $model->appropriation_type, $value->operating_unit, $model->year, $model->fund_cluster) - ($value->getTotaldisbursement($ors->ors_no, $project->id, $model->appropriation_type, $value->operating_unit, $model->year, $model->fund_cluster))), 2).'</div>';

			    						array_push($unpaid_total, ($value->getTotalobligation($ors->ors_no, $project->id, $model->appropriation_type, $value->operating_unit, $model->year, $model->fund_cluster) - ($value->getTotaldisbursement($ors->ors_no, $project->id, $model->appropriation_type, $value->operating_unit, $model->year, $model->fund_cluster))));

			    					}
			    					echo "<br><br>";
	    						}
	    						echo "<br><br><br>";
	    					}
	    				} ?>
	    			</td>
	    			<td class="report-td">
	    				<br><br><br><br>
	    				<?php foreach ($value->getAgency($value->department) as $key => $val) 
	    				{
	    					foreach ($value->getOu($value->department, $val->agency) as $key => $data) 
	    					{
	    						foreach ($value->getProjects($value->department, $val->agency, $data->operating_office) as $key => $project) 
	    						{
	    							foreach ($value->getOrs($project->id, $model->year) as $key => $ors) 
			    					{
			    						echo '<div style="text-align: center;">'.number_format(($value->getTotaldisbursement($ors->ors_no, $project->id, $model->appropriation_type, $value->operating_unit, $model->year, $model->fund_cluster) - ($value->getTotalliquidation($ors->ors_no, $project->id, $model->appropriation_type, $value->operating_unit, $model->year, $model->fund_cluster))), 2).'</div>';

			    						array_push($unliquidated_total, ($value->getTotaldisbursement($ors->ors_no, $project->id, $model->appropriation_type, $value->operating_unit, $model->year, $model->fund_cluster) - ($value->getTotalliquidation($ors->ors_no, $project->id, $model->appropriation_type, $value->operating_unit, $model->year, $model->fund_cluster))));
			    					}
			    					echo "<br><br>";
	    						}
	    						echo "<br><br><br>";
	    					}
	    				} ?>
	    			</td>
	    		</tr>
    		<?php endforeach ?>
    		<tr style="text-align: center;">
    			<td class="report-td1">GRAND TOTAL</td>
    			<td class="report-td1"></td>
    			<td></td>
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
