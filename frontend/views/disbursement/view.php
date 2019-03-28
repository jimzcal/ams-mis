<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;
use backend\models\Transaction;
use backend\models\Disbursement;
use barcode\barcode\BarcodeGenerator;
use backend\models\Ors;
use backend\models\Employees;

/* @var $this yii\web\View */
/* @var $model backend\models\Disbursement */

$this->title = $model->dv_no;
//$this->params['breadcrumbs'][] = ['label' => 'Disbursements', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="disbursement-view">
    <div class="right-top-button" id="noprint">
        <a href="javascript:window.print()" class="right-button-text">
            <i class="glyphicon glyphicon-print" style= "font-size: 14px;"></i> Print Tracking Form
        </a>
    </div>

    <div class="tracking-form" style="margin-top: 40px;">
        <table class="table table-bordered table-condensed">
            <tr>
                <td colspan="7" class="tracking" style="font-size: 12px;">
                    Department of Agriculture <br>
                    Financial Management Service - Accounting Division <br>
                    <strong>TRACKING FORM</strong>
                </td>
            </tr>
            <tr>
                <td width="45" rowspan="3" colspan="3" align="center">
                    <?php 
                        $generator = new Picqer\Barcode\BarcodeGeneratorSVG();
                        echo $generator->getBarcode($model->dv_no, $generator::TYPE_CODE_128, 2, 60);
                    ?>
                    <p><?= $model->dv_no ?></p>
                </td>
                <td width="130" align="right">Name of Payee:</td>
                <td colspan="3" style="font-size: 14px;">
                    <strong><?= $model->payee; ?></strong>
                </td>
            </tr>
            <tr>
                <td width="80" align="right">Mode of Payment:</td>
                <td>
                    <strong><?= $model->mode_of_payment; ?></strong>
                </td>
                <td width="100" align="right">TIN:</td>
                <td>
                    <strong><?= $model->tin; ?></strong>
                </td>
            </tr>
            <tr>
                <td align="right">MFO/PAP:</td>
                <td colspan="3">
                    <strong><?php
                                $mfo = explode(',', $model->ors);
                                for($i=0; $i<sizeof($mfo); $i++)
                                {
                                    $mfo_pap = Ors::find()->where(['id' => $mfo[$i]])->all();
                                    foreach ($mfo_pap as $data) 
                                    {
                                       echo $data->mfo_pap.' / ';
                                    }
                                    
                                }
                            ?>
                    </strong>
                </td>
            </tr>
            <tr>
                <td align="right">Gross Amount:</td>
                <td colspan="2" width="25">
                    <strong><?= number_format($model->gross_amount, 2); ?></strong>
                </td>
                <td colspan="4" width="200">
                    This transaction should have the following documentary requirements. (Checked - <i>complied</i>, Unchecked - <i>lacking</i>)
                </td>
            </tr>
            <tr>
                <td align="right">Status:</td>
                <td colspan="2" width="25">
                    <strong><?= $model->status; ?></strong>
                </td>
                <td colspan="4" width="160" rowspan="7">
                    <?php
                        $attachments = Disbursement::find(['attachments'])->where(['id'=>$model->id])->one();
                        $attachments = explode(',', $attachments->attachments);
                        $req = Transaction::find(['requirements'])->where(['id'=>$model->transaction_id])->one();
                        $req = explode(',', $req->requirements);

                        $lacking = array_diff($req, $attachments);
                    ?>
                    <?php foreach ($attachments as $attached) : ?>
                        <?php if($attached != '') : ?>
                            <div class="cboxxx">
                                <input type="checkbox" checked="true" name="requirements[<?= $attached ?>]" value="<?= $attached ?>">
                                <label><?= mb_strimwidth($attached, 0, 40, ' ...') ?></label>
                            </div>
                        <?php endif ?>
                    <?php endforeach ?>

                    <?php foreach ($lacking as $lack) : ?>
                        <div class="cboxxx" ?>
                            <input type="checkbox" name="requirements[<?= $lack ?>]" value="<?= $lack ?>">
                            <label><?= mb_strimwidth($lack, 0, 40, ' ...') ?></label>
                        </div>
                    <?php endforeach ?>
                </td>
            </tr>
            <tr>
                <td align="right">ORS No.:</td>
                <td colspan="2" width="35">
                    <strong>
                        <?php
                            $ors = explode(',', $model->ors);
                                for($i=0; $i<sizeof($ors); $i++)
                                {
                                    $ors_no = Ors::find()->where(['id' => $ors[$i]])->all();
                                    foreach ($ors_no as $data) 
                                    {
                                       echo $data->ors_class.'-'.$data->funding_source.'-'.$data->ors_year.'-'.$data->ors_month.'-'.$data->ors_serial. '<br>';
                                    }
                                    
                                }
                        ?>
                    </strong>
                </td>
            </tr>
            <tr>
                <td align="right">Less Amount:</td>
                <td colspan="2" width="35"><strong><?= number_format($model->less_amount, 2); ?></strong></td>
            </tr>
            <tr>
                <td align="right">Net Amount:</td>
                <td colspan="2" width="35">
                    <strong><?= $model->net_amount == 0 ?  number_format($model->gross_amount - $model->less_amount, 2) : number_format($model->net_amount, 2); ?></strong>
                </td>
            </tr>
            <tr>
                <td align="right">DV Logs:</td>
                <td colspan="2" width="35">
                    <div class="view-logs" data-toggle="modal" data-target="#myModal">View DV Logs</div>
                </td>
            </tr>
            <tr>
                <td align="center" colspan="3" style="background-color: #46920e; color: #FFFFFF"><strong>TRANSACTION STATUS</strong></td>
            </tr>
            <tr>
                <td align="center"><strong>Transaction</strong></td><td align="center"><strong>Received By</strong></td><td align="center"><strong>Date/Time</strong></td>
            </tr>
            <tr>
                <td width="70">Receiving</td>
                <td width="120"><?= $transaction1[0] ?></td>
                <td width="120"><?= $transaction1[1] ?></td>
                <td colspan="4" align="center"><strong>REMARKS</strong></td>
            </tr>
            <tr>
                <td width="70">Processing</td>
                <td width="120"><?= isset($transaction2[0]) ? $transaction2[0] : '' ?></td>
                <td width="120"><?= isset($transaction2[1]) ? $transaction2[1] : '' ?></td>
                <td colspan="4" rowspan="7" style="font-size: 14px;">
                    <?php foreach ($model->remarkss as $key => $value) : ?>
                        <h6>
                            <strong style="font-style: italic;">
                                - <?= $value->user->fullname ?>
                                <i class="text-muted">(<?= $value->date ?>)</i>
                            </strong>
                            <p style="text-indent: 5px;"><?= $value->remarks ?></p>
                        </h6>
                    <?php endforeach ?>
                </td>
            </tr>
            <tr>
                <td width="70">Verification</td><td width="120"><?= isset($transaction3[0]) ? $transaction3[0] : '' ?></td><td width="120"><?= isset($transaction3[1]) ? $transaction3[1] : '' ?></td>
            </tr>
            <tr>
                <td width="70">NCA Control</td><td width="120"><?= isset($transaction4[0]) ? $transaction4[0] : '' ?></td><td width="120"><?= isset($transaction4[1]) ? $transaction4[1] : '' ?></td>
            </tr>
            <tr>
                <td width="70">Approval(Box C)</td><td width="120"><?= isset($transaction8[0]) ? $transaction8[0] : '' ?></td><td width="120"><?= isset($transaction8[1]) ? $transaction8[1] : '' ?></td>
            </tr>
            <tr>
                <td width="70">Indexing</td><td width="120"><?= isset($transaction7[0]) ? $transaction7[0] : '' ?></td><td width="120"><?= isset($transaction7[1]) ? $transaction7[1] : '' ?></td>
            </tr>
            <tr>
                <td width="70">LDDAP/ADA</td><td width="120"><?= isset($transaction5[0]) ? $transaction5[0] : '' ?></td><td width="120"><?= isset($transaction5[1]) ? $transaction5[1] : '' ?></td>
            </tr>
            <tr>
                <td width="70">Releasing</td><td width="120"><?= isset($transaction6[0]) ? $transaction6[0] : '' ?></td><td width="120"><?= isset($transaction6[1]) ? $transaction6[1] : '' ?></td>
            </tr>
        </table>
    </div>
</div>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
         <h4 class="modal-title"><i class="glyphicon glyphicon-transfer"></i> DV Activity Logs</h4>
      </div>
      <div class="modal-body">
            <table class="table table-striped" style="font-size: 12px;">
                <tr>
                    <th>Date</th>
                    <th>Particulars</th>
                    <th>Client</th>
                </tr>
                <?php foreach ($dv_log as $key => $value) : ?>
                    <tr>
                        <td><?= $value->date ?></td>
                        <td><?= ucwords($value->transaction) ?></td>
                        <td><?= $value->employee ?></td>
                    </tr>
                <?php endforeach ?>
            </table>
      </div>
    </div>
  </div>
</div>