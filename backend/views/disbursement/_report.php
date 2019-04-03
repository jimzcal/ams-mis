<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\PurchaseOrder */

$this->title = 'Generate Report for PO';
// $this->params['breadcrumbs'][] = ['label' => 'Purchase Orders', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<style type="text/css">
    #tbl-po th{
        text-align: center;
        font-size: 12px;
        vertical-align: middle;
    }
    #tbl-po td{
        font-size: 11px;
    }
</style>
<div class="purchase-order-view">
    <br>
    <div style="background-color: #fff; padding: 5px;">
      <table style="width: 40%;">
        <tr>
          <td rowspan="5" style="width: 30%">
            
          </td>
          <td style="font-size: 11px;">Republic of the Philippines</td>
        </tr>
        <tr>
          <td style="font-size: 13px; font-weight: bold;">DEPARTMENT OF AGRICULTURE</td>
        </tr>
        <tr>
          <td style="font-weight: bold; font-size: 12px;">Office of the Secretary</td>
        </tr>
        <tr>
          <td style="font-size: 11px;">Elliptical Road, Diliman, Quezon City</td>
        </tr>
        <tr>
          <td style="font-size: 11px;">Truck Line: 928-8742 / Direct Line: 920-3989</td>
        </tr>
      </table>
      <div style="width: 100%; text-align: center;">
          <h3>DISBURSEMENT VOUCHER LOGSHEET</h3>
          <p>For the period of <?= date('F d, Y', strtotime($model->date_from)).' - '.date('F d, Y', strtotime($model->date_to)).'<br>Fund Cluster : '.$model->fund_cluster ?></p>
          <br>
      </div>
        <table class="table table-bordered table-condensed" id="tbl-po">
            <tr>
                <th rowspan="2">DATE</th>
                <th rowspan="2">DV NO.</th>
                <th rowspan="2">PAYEE</th>
                <th rowspan="2">PARTICULARS</th>
                <th rowspan="2">AMOUNT</th>
                <th colspan="7">REMARKS</th>
            </tr>
            <tr>
              <th>Release</th>
              <th>Out</th>
              <th>In</th>
              <th>Out</th>
              <th>In</th>
              <th>Out</th>
              <th>In</th>
            </tr>
        <?php foreach ($data as $key => $value) : ?>
           <tr>
               <td><?= $value->date ?></td>
               <td><?= $value->dv_no ?></td>
               <td><?= $value->payee ?></td>
               <td style="width: 25%;"><?= $value->particulars ?></td>
               <td style="font-weight: bold; text-align: right;">
                  <?= number_format($value->gross_amount, 2) ?>
               </td>
               <td></td>
               <td></td>
               <td></td>
               <td></td>
               <td></td>
               <td></td>
               <td></td>
           </tr>
       <?php endforeach ?>
       </table>
   </div>
</div>
