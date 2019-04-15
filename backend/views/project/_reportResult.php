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
	    				<?= $value->implementing_agency ?><br><br>
	    				<p style="text-indent: 10px; font-weight: bold;"><?= $value->title ?></p>
	    			</td>
	    			<td class="report-td">
	    				<?php foreach(explode('*', $value->ors_no) as $key => $val)
	    				{
	    					echo $val.'<br>';
	    				} ?>
	    			</td>
	    			<td class="report-td">
	    				<?php foreach(explode('*', $value->ors_no) as $key => $val)
	    				{
	    					echo $value->getOrs($val, $value->region)->date.'<br>';
	    				} ?>
	    			</td>
	    			<td class="report-td">
	    				<?php foreach(explode('*', $value->ors_no) as $key => $val)
	    				{
	    					echo $value->getObligatedfirst($val, $value->region, $value->id, $value->getOrs($val, $value->region)->date, $appropriation_class) == 0.00 ? '' : number_format($value->getObligatedfirst($val, $value->region, $value->id, $value->getOrs($val, $value->region)->date, $appropriation_class), 2).'<br>';

	    					array_push($obligate_first, $value->getObligatedfirst($val, $value->region, $value->id, $value->getOrs($val, $value->region)->date, $appropriation_class));
	    				} ?>
	    			</td>
	    			<td class="report-td">
	    				<?php foreach(explode('*', $value->ors_no) as $key => $val)
	    				{
	    					echo $value->getObligatedsecond($val, $value->region, $value->id, $value->getOrs($val, $value->region)->date, $appropriation_class) == 0.00 ? '' : number_format($value->getObligatedsecond($val, $value->region, $value->id, $value->getOrs($val, $value->region)->date, $appropriation_class), 2).'<br>';

	    					array_push($obligate_second, $value->getObligatedsecond($val, $value->region, $value->id, $value->getOrs($val, $value->region)->date, $appropriation_class));
	    				} ?>
	    			</td>
	    			<td class="report-td">
	    				<?php foreach(explode('*', $value->ors_no) as $key => $val)
	    				{
	    					echo $value->getObligatedthird($val, $value->region, $value->id, $value->getOrs($val, $value->region)->date, $appropriation_class) == 0.00 ? '' : number_format($value->getObligatedthird($val, $value->region, $value->id, $value->getOrs($val, $value->region)->date, $appropriation_class), 2).'<br>';

	    					array_push($obligate_third, $value->getObligatedthird($val, $value->region, $value->id, $value->getOrs($val, $value->region)->date, $appropriation_class));
	    				} ?>
	    			</td>
	    			<td class="report-td">
	    				<?php foreach(explode('*', $value->ors_no) as $key => $val)
	    				{
	    					echo $value->getObligatedfourth($val, $value->region, $value->id, $value->getOrs($val, $value->region)->date, $appropriation_class) == 0.00 ? '' : number_format($value->getObligatedfourth($val, $value->region, $value->id, $value->getOrs($val, $value->region)->date, $appropriation_class), 2).'<br>';

	    					array_push($obligate_fourth, $value->getObligatedfourth($val, $value->region, $value->id, $value->getOrs($val, $value->region)->date, $appropriation_class));
	    				} ?>
	    			</td>
	    			<td class="report-td">
	    				<?php foreach(explode('*', $value->ors_no) as $key => $val)
	    				{
	    					echo number_format($value->getObligatedtotal($val, $value->region, $value->id, $appropriation_class, $appropriation_class), 2).'<br>';

	    					array_push($obligate_total, $value->getObligatedtotal($val, $value->region, $value->id, $appropriation_class, $appropriation_class));
	    				} ?>
	    			</td>
	    			<td class="report-td">
	    				<?php foreach(explode('*', $value->ors_no) as $key => $val)
	    				{
	    					echo $value->getDisbursedfirst($val, $value->region, $value->id, $value->getOrs($val, $value->region)->date) == 0.00 ? '' : number_format($value->getDisbursedfirst($val, $value->region, $value->id, $value->getOrs($val, $value->region)->date), 2).'<br>';

	    					array_push($disbursed_first, $value->getDisbursedfirst($val, $value->region, $value->id, $value->getOrs($val, $value->region)->date));
	    				} ?>
	    			</td>
	    			<td class="report-td">
	    				<?php foreach(explode('*', $value->ors_no) as $key => $val)
	    				{
	    					echo $value->getDisbursedsecond($val, $value->region, $value->id, $value->getOrs($val, $value->region)->date) == 0.00 ? '' : number_format($value->getDisbursedsecond($val, $value->region, $value->id, $value->getOrs($val, $value->region)->date), 2).'<br>';

	    					array_push($disbursed_second, $value->getDisbursedsecond($val, $value->region, $value->id, $value->getOrs($val, $value->region)->date));
	    				} ?>
	    			</td>
	    			<td class="report-td">
	    				<?php foreach(explode('*', $value->ors_no) as $key => $val)
	    				{
	    					echo $value->getDisbursedthird($val, $value->region, $value->id, $value->getOrs($val, $value->region)->date) == 0.00 ? '' : number_format($value->getDisbursedthird($val, $value->region, $value->id, $value->getOrs($val, $value->region)->date), 2).'<br>';

	    					array_push($disbursed_third, $value->getDisbursedsecond($val, $value->region, $value->id, $value->getOrs($val, $value->region)->date));
	    				} ?>
	    			</td>
	    			<td class="report-td">
	    				<?php foreach(explode('*', $value->ors_no) as $key => $val)
	    				{
	    					echo $value->getDisbursedfourth($val, $value->region, $value->id, $value->getOrs($val, $value->region)->date) == 0.00 ? '' : number_format($value->getDisbursedfourth($val, $value->region, $value->id, $value->getOrs($val, $value->region)->date), 2).'<br>';

	    					array_push($disbursed_fourth, $value->getDisbursedfourth($val, $value->region, $value->id, $value->getOrs($val, $value->region)->date));
	    				} ?>
	    			</td>
	    			<td class="report-td">
	    				<?php foreach(explode('*', $value->ors_no) as $key => $val)
	    				{
	    					echo number_format($value->getDisbursedtotal($val, $value->region, $value->id), 2).'<br>';

	    					array_push($disbursed_total, $value->getDisbursedtotal($val, $value->region, $value->id));
	    				} ?>
	    			</td>
	    			<td class="report-td">
	    				<?php foreach(explode('*', $value->ors_no) as $key => $val)
	    				{
	    					echo $value->getLiquidatedfirst($val, $value->region, $value->id, $value->getOrs($val, $value->region)->date) == 0.00 ? '' : number_format($value->getLiquidatedfirst($val, $value->region, $value->id, $value->getOrs($val, $value->region)->date), 2).'<br>';

	    					array_push($liquidate_first, $value->getLiquidatedfirst($val, $value->region, $value->id, $value->getOrs($val, $value->region)->date));

	    				} ?>
	    			</td>
	    			<td class="report-td">
	    				<?php foreach(explode('*', $value->ors_no) as $key => $val)
	    				{
	    					echo $value->getLiquidatedsecond($val, $value->region, $value->id, $value->getOrs($val, $value->region)->date) == 0.00 ? '' : number_format($value->getLiquidatedsecond($val, $value->region, $value->id, $value->getOrs($val, $value->region)->date), 2).'<br>';

	    					array_push($liquidate_second, $value->getLiquidatedsecond($val, $value->region, $value->id, $value->getOrs($val, $value->region)->date));
	    				} ?>
	    			</td>
	    			<td class="report-td">
	    				<?php foreach(explode('*', $value->ors_no) as $key => $val)
	    				{
	    					echo $value->getLiquidatedthird($val, $value->region, $value->id, $value->getOrs($val, $value->region)->date) == 0.00 ? '' : number_format($value->getLiquidatedthird($val, $value->region, $value->id, $value->getOrs($val, $value->region)->date), 2).'<br>';

	    					array_push($liquidate_third, $value->getLiquidatedthird($val, $value->region, $value->id, $value->getOrs($val, $value->region)->date));
	    				} ?>
	    			</td>
	    			<td class="report-td">
	    				<?php foreach(explode('*', $value->ors_no) as $key => $val)
	    				{
	    					echo $value->getLiquidatedfourth($val, $value->region, $value->id, $value->getOrs($val, $value->region)->date) == 0.00 ? '' : number_format($value->getLiquidatedfourth($val, $value->region, $value->id, $value->getOrs($val, $value->region)->date), 2).'<br>';

	    					array_push($liquidate_fourth, $value->getLiquidatedfourth($val, $value->region, $value->id, $value->getOrs($val, $value->region)->date));
	    				} ?>
	    			</td>
	    			<td class="report-td">
	    				<?php foreach(explode('*', $value->ors_no) as $key => $val)
	    				{
	    					echo number_format($value->getLiquidatedtotal($val, $value->region, $value->id), 2).'<br>';

	    					array_push($liquidate_total, $value->getLiquidatedtotal($val, $value->region, $value->id), 2);
	    				} ?>
	    			</td>
	    			<td class="report-td">
	    				<?php foreach(explode('*', $value->ors_no) as $key => $val)
	    				{
	    					echo number_format($value->getObligatedtotal($val, $value->region, $value->id, $appropriation_class, $appropriation_class) - ($value->getDisbursedtotal($val, $value->region, $value->id)), 2).'<br>';

	    					array_push($unpaid_total, $value->getObligatedtotal($val, $value->region, $value->id, $appropriation_class, $appropriation_class) - ($value->getDisbursedtotal($val, $value->region, $value->id)));
	    				} ?>
	    			</td>
	    			<td class="report-td">
	    				<?php foreach(explode('*', $value->ors_no) as $key => $val)
	    				{
	    					echo number_format(($value->getDisbursedtotal($val, $value->region, $value->id) - $value->getLiquidatedtotal($val, $value->region, $value->id)), 2).'<br>';

	    					array_push($unliquidated_total, ($value->getDisbursedtotal($val, $value->region, $value->id) - $value->getLiquidatedtotal($val, $value->region, $value->id)));
	    				} ?>
	    			</td>
	    		</tr>
    		<?php endforeach ?>
    		<tr style="text-align: center;">
    			<td class="report-td1">GRAND TOTAL</td>
    			<td class="report-td1"></td>
    			<td></td>
    			<td class="report-td1">
    				<?= number_format(array_sum($obligate_first), 2); ?>
    			</td>
    			<td class="report-td1">
    				<?= number_format(array_sum($obligate_second), 2); ?>
    			</td>
    			<td class="report-td1">
    				<?= number_format(array_sum($obligate_third), 2); ?>
    			</td>
    			<td class="report-td1">
    				<?= number_format(array_sum($obligate_fourth), 2); ?>
    			</td>
    			<td class="report-td1">
    				<?= number_format(array_sum($obligate_total), 2); ?>
    			</td>
    			<td class="report-td1">
    				<?= number_format(array_sum($disbursed_first), 2); ?>
    			</td>
    			<td class="report-td1">
    				<?= number_format(array_sum($disbursed_second), 2); ?>
    			</td>
    			<td class="report-td1">
    				<?= number_format(array_sum($disbursed_third), 2); ?>
    			</td>
    			<td class="report-td1">
    				<?= number_format(array_sum($disbursed_fourth), 2); ?>
    			</td>
    			<td class="report-td1">
    				<?= number_format(array_sum($disbursed_total), 2); ?>
    			</td>
    			<td class="report-td1">
    				<?= number_format(array_sum($liquidate_first), 2); ?>
    			</td>
    			<td class="report-td1">
    				<?= number_format(array_sum($liquidate_second), 2); ?>
    			</td>
    			<td class="report-td1">
    				<?= number_format(array_sum($liquidate_third), 2); ?>
    			</td>
    			<td class="report-td1">
    				<?= number_format(array_sum($liquidate_fourth), 2); ?>
    			</td>
    			<td class="report-td1">
    				<?= number_format(array_sum($liquidate_total), 2); ?>
    			</td>
    			<td class="report-td1">
    				<?= number_format(array_sum($unpaid_total), 2); ?>
    			</td>
    			<td class="report-td1">
    				<?= number_format(array_sum($unliquidated_total), 2); ?>
    			</td>
    		</tr>
    	</table>
    </div>
</div>
