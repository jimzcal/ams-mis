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
		padding: 2px;
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
		font-size: 8.5px;
		text-align: center;
	}

	.report-td1{
		border: solid 1px;
		border-top: solid 1px;
		vertical-align: middle;
		font-size: 10px;
		font-weight: bold;
		padding: 3px;
	}

	.report-td2{
		border-right: solid 1px;
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
                    As at the Quarter Ending <input type="text" name="text" class="textfield" placeholder="Enter Date here" value="March 31, 2019" style="border: none; width: 20%; padding-left: 1px;">
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
    						<input type="text" name="text" class="textfield" placeholder="Enter Organization Code" value="05 001 01 00000" style="border: none; width: 90%; padding-left: 0px;">
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

    	<table style="width: 100%;" class="report-table">
    		<tr>
    			<th rowspan="2" class="report-th" style="vertical-align: middle;">Operating Units</th>
    			<th class="report-th">Obligations</th>
    			<th class="report-th">Disbursements</th>
    			<th class="report-th">Liquidations</th>
    			<th rowspan="2" class="report-th">Unpaid Obligations</th>
    			<th rowspan="2" class="report-th">Unliquidated<br>Fund Transfers</th>
    		</tr>
    		<tr>
    			<!-- <th colspan="2" class="report-th2" style="width: 15%;">
    				Obligation Request and Status
    			</th> -->
    			<!-- <th class="report-th2">1st Quarter</th>
    			<th class="report-th2">2nd Quarter</th>
    			<th class="report-th2">3rd Quarter</th>
    			<th class="report-th2">4th Quarter</th> -->
    			<th class="report-th2">Total</th>
    			<!-- <th class="report-th2">1st Quarter</th>
    			<th class="report-th2">2nd Quarter</th>
    			<th class="report-th2">3rd Quarter</th>
    			<th class="report-th2">4th Quarter</th> -->
    			<th class="report-th2">Total</th>
    			<!-- <th class="report-th2">1st Quarter</th>
    			<th class="report-th2">2nd Quarter</th>
    			<th class="report-th2">3rd Quarter</th>
    			<th class="report-th2">4th Quarter</th> -->
    			<th class="report-th2">Total</th>
    		</tr>
    		<!-- <tr>
    			<th class="report-th2">Number</th>
    			<th class="report-th2">Date</th>
    		</tr> -->
    		<tr style="text-align: center;">
    			<!-- <td class="report-td1" style="width: 20%;">1</td>
    			<td class="report-td1">2</td> -->
    			<td class="report-td1">1</td>
    			<!-- <td class="report-td1">2</td>
    			<td class="report-td1">3</td>
    			<td class="report-td1">4</td>
    			<td class="report-td1">5</td> -->
    			<td class="report-td1" style="font-size: 7px; width: 15%;">2</td>
    			<!-- <td class="report-td1">7</td>
    			<td class="report-td1">8</td>
    			<td class="report-td1">9</td>
    			<td class="report-td1">10</td> -->
    			<td class="report-td1" style="font-size: 7px; width: 15%;">3</td>
    			<!-- <td class="report-td1">12</td>
    			<td class="report-td1">13</td>
    			<td class="report-td1">14</td>
    			<td class="report-td1">15</td> -->
    			<td class="report-td1" style="font-size: 7px; width: 15%;">4</td>
    			<td class="report-td1">5=(2+3)</td>
    			<td class="report-td1" style="font-size: 7px;">6=(4-5)</td>
    		</tr>
    		<?php foreach ($dataProvider as $key => $value): ?>
    			<tr>
    				<td class="report-td1" style="text-align: left; width: 30%;">
    					<?= $value->abbreviation.' - '.$value->description ?>
    				</td>
					<!-- <td class="report-td1" style="text-align: right;">
						<?= $model->getConsolobligation($value->abbreviation, $model->appropriation_type, $model->year, 1, $model->fund_cluster) != 0.00 ? number_format($model->getConsolobligation($value->abbreviation, $model->appropriation_type, $model->year, 1, $model->fund_cluster), 2) : ''; ?>

						<?php array_push($obligate_first, $model->getConsolobligation($value->abbreviation, $model->appropriation_type, $model->year, 1, $model->fund_cluster)) ?>
					</td>
					<td class="report-td1" style="text-align: right;">
						<?= $model->getConsolobligation($value->abbreviation, $model->appropriation_type, $model->year, 2, $model->fund_cluster) != 0.00 ? number_format($model->getConsolobligation($value->abbreviation, $model->appropriation_type, $model->year, 2, $model->fund_cluster), 2) : ''; ?>

						<?php array_push($obligate_second, $model->getConsolobligation($value->abbreviation, $model->appropriation_type, $model->year, 2, $model->fund_cluster)) ?>
					</td>
					<td class="report-td1" style="text-align: right;">
						<?= $model->getConsolobligation($value->abbreviation, $model->appropriation_type, $model->year, 3, $model->fund_cluster) != 0.00 ? number_format($model->getConsolobligation($value->abbreviation, $model->appropriation_type, $model->year, 3, $model->fund_cluster), 2) : ''; ?>

						<?php array_push($obligate_third, $model->getConsolobligation($value->abbreviation, $model->appropriation_type, $model->year, 3, $model->fund_cluster)) ?>
					</td>
					<td class="report-td1" style="text-align: right;">
						<?= $model->getConsolobligation($value->abbreviation, $model->appropriation_type, $model->year, 4, $model->fund_cluster) != 0.00 ? number_format($model->getConsolobligation($value->abbreviation, $model->appropriation_type, $model->year, 4, $model->fund_cluster), 2) : ''; ?>

						<?php array_push($obligate_fourth, $model->getConsolobligation($value->abbreviation, $model->appropriation_type, $model->year, 4, $model->fund_cluster)) ?>
					</td> -->
					<td class="report-td1" style="text-align: right;">
						<?= $model->getConsolobligationtotal($value->abbreviation, $model->appropriation_type, $model->year, $model->fund_cluster) != 0.00 ? number_format($model->getConsolobligationtotal($value->abbreviation, $model->appropriation_type, $model->year, $model->fund_cluster), 2) : ''; ?>

						<?php array_push($obligate_total, $model->getConsolobligationtotal($value->abbreviation, $model->appropriation_type, $model->year, $model->fund_cluster)) ?>
					</td>
					<!-- <td class="report-td1" style="text-align: right;">
						<?= $model->getConsoldisbursement($value->abbreviation, $model->appropriation_type, $model->year, 1, $model->fund_cluster) != 0.00 ? number_format($model->getConsoldisbursement($value->abbreviation, $model->appropriation_type, $model->year, 1, $model->fund_cluster), 2) : ''; ?>

						<?php array_push($disbursed_first, $model->getConsoldisbursement($value->abbreviation, $model->appropriation_type, $model->year, 1, $model->fund_cluster)) ?>
					</td>
					<td class="report-td1" style="text-align: right;">
						<?= $model->getConsoldisbursement($value->abbreviation, $model->appropriation_type, $model->year, 2, $model->fund_cluster) != 0.00 ? number_format($model->getConsoldisbursement($value->abbreviation, $model->appropriation_type, $model->year, 2, $model->fund_cluster), 2) : ''; ?>

						<?php array_push($disbursed_second, $model->getConsoldisbursement($value->abbreviation, $model->appropriation_type, $model->year, 2, $model->fund_cluster)) ?>
					</td>
					<td class="report-td1" style="text-align: right;">
						<?= $model->getConsoldisbursement($value->abbreviation, $model->appropriation_type, $model->year, 3, $model->fund_cluster) != 0.00 ? number_format($model->getConsoldisbursement($value->abbreviation, $model->appropriation_type, $model->year, 3, $model->fund_cluster), 2) : ''; ?>

						<?php array_push($disbursed_third, $model->getConsoldisbursement($value->abbreviation, $model->appropriation_type, $model->year, 3, $model->fund_cluster)) ?>
					</td>
					<td class="report-td1" style="text-align: right;">
						<?= $model->getConsoldisbursement($value->abbreviation, $model->appropriation_type, $model->year, 4, $model->fund_cluster) != 0.00 ? number_format($model->getConsoldisbursement($value->abbreviation, $model->appropriation_type, $model->year, 4, $model->fund_cluster), 2) : ''; ?>

						<?php array_push($disbursed_fourth, $model->getConsoldisbursement($value->abbreviation, $model->appropriation_type, $model->year, 4, $model->fund_cluster)) ?>
					</td> -->
					<td class="report-td1" style="text-align: right;">
						<?= $model->getConsoldisbursementtotal($value->abbreviation, $model->appropriation_type, $model->year, $model->fund_cluster) != 0.00 ? number_format($model->getConsoldisbursementtotal($value->abbreviation, $model->appropriation_type, $model->year, $model->fund_cluster), 2) : ''; ?>

						<?php array_push($disbursed_total, $model->getConsoldisbursementtotal($value->abbreviation, $model->appropriation_type, $model->year, $model->fund_cluster)) ?>
					</td>
					<!-- <td class="report-td1" style="text-align: right;">
						<?= $model->getConsolliquidation($value->abbreviation, $model->appropriation_type, $model->year, 1, $model->fund_cluster) != 0.00 ? number_format($model->getConsolliquidation($value->abbreviation, $model->appropriation_type, $model->year, 1, $model->fund_cluster), 2) : ''; ?>

						<?php array_push($liquidate_first, $model->getConsolliquidation($value->abbreviation, $model->appropriation_type, $model->year, 1, $model->fund_cluster)) ?>
					</td>
					<td class="report-td1" style="text-align: right;">
						<?= $model->getConsolliquidation($value->abbreviation, $model->appropriation_type, $model->year, 2, $model->fund_cluster) != 0.00 ? number_format($model->getConsolliquidation($value->abbreviation, $model->appropriation_type, $model->year, 2, $model->fund_cluster), 2) : ''; ?>

						<?php array_push($liquidate_second, $model->getConsolliquidation($value->abbreviation, $model->appropriation_type, $model->year, 2, $model->fund_cluster)) ?>
					</td>
					<td class="report-td1" style="text-align: right;">
						<?= $model->getConsolliquidation($value->abbreviation, $model->appropriation_type, $model->year, 3, $model->fund_cluster) != 0.00 ? number_format($model->getConsolliquidation($value->abbreviation, $model->appropriation_type, $model->year, 3, $model->fund_cluster), 2) : ''; ?>

						<?php array_push($liquidate_third, $model->getConsolliquidation($value->abbreviation, $model->appropriation_type, $model->year, 3, $model->fund_cluster)) ?>
					</td>
					<td class="report-td1" style="text-align: right;">
						<?= $model->getConsolliquidation($value->abbreviation, $model->appropriation_type, $model->year, 4, $model->fund_cluster) != 0.00 ? number_format($model->getConsolliquidation($value->abbreviation, $model->appropriation_type, $model->year, 4, $model->fund_cluster), 2) : ''; ?>

						<?php array_push($liquidate_fourth, $model->getConsolliquidation($value->abbreviation, $model->appropriation_type, $model->year, 4, $model->fund_cluster)) ?>
					</td> -->
					<td class="report-td1" style="text-align: right;">
						<?= $model->getConsolliquidationtotal($value->abbreviation, $model->appropriation_type, $model->year, $model->fund_cluster) != 0.00 ? number_format($model->getConsolliquidationtotal($value->abbreviation, $model->appropriation_type, $model->year, $model->fund_cluster), 2) : ''; ?>

						<?php array_push($liquidate_total, $model->getConsolliquidationtotal($value->abbreviation, $model->appropriation_type, $model->year, $model->fund_cluster)) ?>
					</td>
					<td class="report-td1" style="text-align: right;">
						<?=
							number_format(($model->getConsolobligationtotal($value->abbreviation, $model->appropriation_type, $model->year, $model->fund_cluster) - $model->getConsoldisbursementtotal($value->abbreviation, $model->appropriation_type, $model->year, $model->fund_cluster)), 2);
						?>

						<?php array_push($unpaid_total, ($model->getConsolobligationtotal($value->abbreviation, $model->appropriation_type, $model->year, $model->fund_cluster) - $model->getConsoldisbursementtotal($value->abbreviation, $model->appropriation_type, $model->year, $model->fund_cluster))) ?>
					</td>
					<td class="report-td1" style="text-align: right;">
						<?=
							number_format($model->getConsoldisbursementtotal($value->abbreviation, $model->appropriation_type, $model->year, $model->fund_cluster) - $model->getConsolliquidationtotal($value->abbreviation, $model->appropriation_type, $model->year, $model->fund_cluster), 2);
						?>
						<?php array_push($unliquidated_total, ($model->getConsoldisbursementtotal($value->abbreviation, $model->appropriation_type, $model->year, $model->fund_cluster) - $model->getConsolliquidationtotal($value->abbreviation, $model->appropriation_type, $model->year, $model->fund_cluster))) ?>
					</td>
    			</tr>
    		<?php endforeach ?>
    			<tr style="text-align: center;">
    			<td class="report-td1" style="text-align: center;">GRAND TOTAL</td>
    			<!-- <td class="report-td1">
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
    			</td> -->
    			<td class="report-td1">
    				<?= number_format(array_sum($obligate_total), 2) ?>
    			</td>
    			<!-- <td class="report-td1">
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
    			</td> -->
    			<td class="report-td1">
    				<?= number_format(array_sum($disbursed_total), 2) ?>
    			</td>
    			<!-- <td class="report-td1">
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
    			</td> -->
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
    	<div style="width: 100%; height: 10px;"></div>
    	<table style="width: 100%; font-size: 11px;">
    		<tr>
    			<th style="width: 25%; height: 10px; vertical-align: top;">Certified Correct:</th>
				<th style="width: 25%; height: 10px; vertical-align: top;">Certified Correct:</th>
				<th style="width: 25%; height: 10px; vertical-align: top;">Recommending Approval:</th>
				<th style="width: 25%; height: 10px; vertical-align: top;">Approved By:</th>
    		</tr>
    		<tr>
    			<td colspan="3" style="height: 20px;"></td>
    		</tr>
    		<tr>
    			<td><input type="text" name="text" class="textfield" placeholder="Enter name here" value="TELMA C. TOLENTINO" style="font-weight: bold;"></td>
				<td><input type="text" name="text" class="textfield" placeholder="Enter name here" value="CHARIE SARAH D. SAQUING" style="font-weight: bold;"></td>
				<td><input type="text" name="text" class="textfield" placeholder="Enter name here" value="MIRIAM C. CORNELIO" style="font-weight: bold;"></td>
				<td><input type="text" name="text" class="textfield" placeholder="Enter name here" value="ATTY. FRANCISCO M. VILLANO, JR." style="font-weight: bold;"></td>
    		</tr>
    		<tr>
    			<td style="vertical-align: top;">
                    <input type="text" name="text" class="textfield" placeholder="Enter Position here" style="border: none; width: 90%; padding-left: 1px;" value="Chief, Budget Division">
                </td>
				<td style="vertical-align: top;">
                    <input type="text" name="text" class="textfield" placeholder="Enter Position here" style="border: none; width: 90%; padding-left: 1px;" value="Chief, Accounting Division">
                </td>
				<td style="vertical-align: top;">
                    <input type="text" name="text" class="textfield" placeholder="Enter Position here" style="border: none; width: 90%; padding-left: 1px;" value="Director, FMS">            
                </td>
				<td style="vertical-align: top;">
                    <input type="text" name="text" class="textfield" placeholder="Enter Position here" style="border: none; width: 90%; padding-left: 1px;" value="Undersecretary - Designate for Finance">            
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
