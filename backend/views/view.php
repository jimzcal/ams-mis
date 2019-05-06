<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\SubsidiaryLedger */

$this->title = "Subsidiary Ledger";
// $this->params['breadcrumbs'][] = ['label' => 'Subsidiary Ledgers', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="subsidiary-ledger-view">
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
                    <h3>S U B S I D I A R Y  &nbsp&nbsp L E D G E R</h3>
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
        <table class="table table-bordered" style="font-size: 12px;">
            <tr>
                <td rowspan="2" colspan="3" style="vertical-align: middle;">
                    <strong>ACCOUNT OF :</strong> <?= $model->getAccount($model->account_code)->account_title ?>
                </td>
                <td colspan="3">
                    <strong>GL :</strong> <?= $model->getMotheraccount($model->account_code)->account_name ?>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <strong>SL :</strong> <?= $model->account_code ?>
                </td>
            </tr>
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
            <tr style="color: #999999; font-style: italic;">
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
                    <?= number_format($beg_debit - $beg_credit, 2) ?>
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
                        <?= $value->jev_no ?>
                    </td>
                    <td style="text-align: right; font-weight: bold;">
                        <?= $value->debit == 0.00 ? '' : number_format($value->debit, 2) ?>
                    </td>
                    <td style="text-align: right; font-weight: bold;">
                        <?= $value->credit == 0.00 ? '' : number_format($value->credit, 2) ?>
                    </td>
                    <td style="text-align: right; font-weight: bold;">
                        <?= number_format($ending_balance = $value->getBalance($model->account_code, $value->date_transaction), 2) ?>
                    </td>
                </tr>
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
                    <?= number_format($ending_balance, 2) ?>
                </td>
            </tr>

            <tr style="color: #999999">
                <td colspan="3" style="padding-left: 300px; font-weight: bold; width: 65%">
                    T O T A L :
                </td>
                <td style="border-top: solid 1px; border-bottom: solid 2px; border-top: solid 2px; text-align: right; font-weight: bold">
                    <?= number_format($end_debit = $model->getBeginningdebit($model->account_code, $model->date_to), 2) ?>
                </td>
                <td style="border-top: solid 1px; border-bottom: solid 2px; border-top: solid 2px; text-align: right; font-weight: bold">
                    <?= number_format($end_credit = $model->getBeginningcredit($model->account_code, $model->date_to), 2) ?>
                </td>
                <td style="border-top: solid 1px; border-bottom: solid 2px; border-top: solid 2px; text-align: right; font-weight: bold">
                    <?= number_format($end_debit - $end_credit, 2) ?>
                </td>
            </tr>
        </table>
    </div>
</div>
