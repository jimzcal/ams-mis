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
    }
    #tbl-po td{
        font-size: 11px;
    }

    @page { 
      size: 13in 8.5in landscape; 
      margin: .5cm;
    }
    
</style>
<div class="purchase-order-view">
    <br>
    <div style="background-color: #fff; padding: 5px;">
        <div style="width: 100%; text-align: center;">
            <h3>LIST OF PURCHASE ORDER</h3>
            <p>For the period of <?= date('F d, Y', strtotime($model->date_from)).' - '.date('F d, Y', strtotime($model->date_to)).'<br>Status : '.$model->status ?></p>
            <br>
        </div>
        <table class="table table-bordered table-condensed" id="tbl-po">
            <tr>
                <th>Date</th>
                <th>P.O No.</th>
                <th>Date Receieved</th>
                <th>Supplier</th>
                <th>Description</th>
                <th>Amount</th>
                <th>Status</th>
            </tr>
        <?php foreach ($data as $key => $value) : ?>
           <tr>
               <td><?= $value->date ?></td>
               <td><?= $value->po_no ?></td>
               <td><?= $value->date_recived ?></td>
               <td><?= $value->supplier ?></td>
               <td><?= $value->description ?></td>
               <td style="text-align: right; font-weight: bold;"><?= number_format($value->total_amount, 2) ?></td>
               <td><?= $value->status ?></td>
           </tr>
       <?php endforeach ?>
       </table>
   </div>
</div>
