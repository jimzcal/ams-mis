<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use backend\models\Accounts;
use yii\helpers\ArrayHelper;
use dosamigos\chartjs\ChartJs;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CollectionsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'General Ledger';
// $this->params['breadcrumbs'][] = $this->title;

$total_debit = 0;
$total_credit = 0;
$bal = 0;
?>
<style type="text/css">
    @page{
        margin: 0.5px;
    }
</style>
<div class="collections-index">
    <div class="ledger-journal-form">
        <table style="width: 100%; text-align: center;">
            <tr>
                <td>
                    <h3>NAFC-DA Multipurpose Cooperative</h3>
                </td>
            </tr>
            <tr>
                <td>
                    G/F Right Wing, Department of Agriculture Bldg, Elliptical Road, Diliman, Quezon City
                </td>
            </tr>
            <tr>
                <td>
                    CDA Reg. No. 9520-16014984
                </td>
            </tr>
            <tr>
                <td>
                    
                </td>
            </tr>
            <tr>
                <td>
                    <h3>G E N E R A L  &nbsp&nbsp L E D G E R</h3>
                </td>
            </tr>
            <tr>
                <td>
                    <?= date("F d, Y", strtotime($model->date_from)).' - '.date("F d, Y", strtotime($model->date_to)) ?>
                </td>
            </tr>
            <tr style="height: 20px;">
                <td>
                    
                </td>
            </tr>
        </table>
        <center>
            <p style="font-weight: bold;">
                Account Code: <?= $model->account_code ?> - <?= $model->getAccount($model->account_code) ?>
            </p>
        </center>
        
        <table class="table table-bordered" style="font-size: 12px; width: 95%;">
            <tr>
                <th style="width: 6%">
                    Date
                </th>
                <th style="width: 30%">
                    Account Title / Particulars
                </th>
                <th style="width: 15%">
                    Reference
                </th>
                <th>
                    Debit
                </th>
                <th>
                    Credit
                </th>
                <th>
                    Balance
                </th>
            </tr>
            <tr style="font-style: italic;">
                <td style="width: 10%;">
                    <?= date("M. d", strtotime($model->date_from)) ?>
                </td>
                <td style="width: 30%">
                    Beginning Balance
                </td>
                <td style="width: 15%">
                    
                </td>
                <td style="text-align: right; font-weight: bold;">
                    <?= number_format($beg_debit = $model->getBeginningdebit($model->account_code, $model->date_from), 2) ?>
                </td>
                <td style="text-align: right; font-weight: bold;">
                    <?= number_format($beg_credit = $model->getBeginningcredit($model->account_code, $model->date_from), 2) ?>
                </td>
                <td style="text-align: right; font-weight: bold;">
                    <?= number_format($bal = $beg_debit - $beg_credit, 2) ?>
                </td>
            </tr>
            <?php foreach ($dataProvider as $key => $value) : ?>
                <tr>
                    <td style="width: 10%">
                        <?= date("M. d", strtotime($value->date_transaction)) ?>
                    </td>
                    <td style="width: 30%">
                        <?= $value->particulars ?>
                    </td>
                    <td style="width: 15%">
                        <?= 'JEV No. '.$value->jev_no ?>
                    </td>
                    <td style="text-align: right; font-weight: bold;">
                        <?= $value->debit == 0.00 ? '' : number_format($value->debit, 2) ?>
                    </td>
                    <td style="text-align: right; font-weight: bold;">
                        <?= $value->credit == 0.00 ? '' : number_format($value->credit, 2) ?>
                    </td>
                    <td style="text-align: right; font-weight: bold;">
                        <?php //echo number_format($bal = $bal + $value->credit, 2);
                            echo $value->getAccount2($value->account_code) == 'Credit' ? number_format($bal = $bal + $value->credit, 2) : number_format($bal = ($bal + $value->debit) - $value->credit, 2);

                         ?>
                    </td>
                </tr>
                <?php
                    $total_debit = $total_debit + $value->debit;
                    $total_credit = $total_credit + $value->credit;
                ?>
            <?php endforeach ?>
            <tr>
                <td style="width: 10%">

                </td>
                <td style="width: 30%">
                    Ending Balance
                </td>
                <td style="width: 15%">
                    
                </td>
                <td style="text-align: right; font-weight: bold;">
                    
                </td>
                <td style="text-align: right; font-weight: bold;">
                    
                </td>
                <td style="text-align: right; font-weight: bold;">
                 <?= number_format($bal, 2) ?>
                </td>
            </tr>

            <tr>
                <td colspan="3" style="padding-left: 300px; font-weight: bold; width: 65%">
                    T O T A L :
                </td>
                <td style="border-top: solid 1px; border-bottom: solid 2px; border-top: solid 2px; text-align: right; font-weight: bold">
                    <?= number_format($total_debit + $beg_debit = $model->getBeginningdebit($model->account_code, $model->date_from), 2) ?>
                </td>
                <td style="border-top: solid 1px; border-bottom: solid 2px; border-top: solid 2px; text-align: right; font-weight: bold">
                    <?= number_format($total_credit + $model->getBeginningcredit($model->account_code, $model->date_from), 2) ?>
                </td>
                <td>
                    
                </td>
            </tr>
        </table>
        <span style="bottom: 0; font-style: italic; color: gray">
            This is a system generated document. Printed on <?= date('M-d-Y') ?> by <?= Yii::$app->user->identity->fullname ?>
        </span>
    </div>
</div>

<?php
$this->registerJs("
    $('tbody th').css('text-align', 'center');
"); ?>