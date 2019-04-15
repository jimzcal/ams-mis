<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use barcode\barcode\BarcodeGenerator;

/* @var $this yii\web\View */
/* @var $model backend\models\Disbursement */

$this->title = $model->dv_no;
// $this->params['breadcrumbs'][] = ['label' => 'Disbursements', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<style type="text/css">
    .locator{
        margin-bottom: 10px;
    }
    @page {
        size: 8in 6.5in;
        margin: .5px;
    }
</style>
<div class="disbursement-view">

    <div style="color: #fff; border-bottom: solid 2px #fff; text-align: right; padding-top: 13px;" id="no-print">
        <h3>DISBURSEMENT VOUCHER</h3>
    </div>
    <br>
    <div class="row">
        <div class="col-md-3" id="no-print">
            <div style="width: 100%; min-height: 460px; padding: 10px; background-color: #0099cc;">
                <div style="background-color: #ccffff; width: 100%; padding: 12px; color: #595959; border: solid 1px #00ace6;">
                    <span class="fa fa-map-signs" style="color: green; text-shadow: 2px 2px 2px #fff; font-size: 20px;"></span> DV FLOW INDICATOR
                </div><br>

                <div class="locator">
                    <table style="width: 100%; color: #fff;">
                        <tr>
                            <td style="width: 7%; opacity: <?= $model->getStatus($model->dv_no, 'Receiving') != null ? 1 : .5 ; ?>">
                                <span class="fa fa-map-marker" style="color: #fff; font-size: 22px; text-shadow: 2px 2px 2px 3px green"></span>
                            </td>
                            <td style="width: 40%; vertical-align: middle; padding-right: 5px; opacity: <?= $model->getStatus($model->dv_no, 'Receiving') != null ? 1 : .5 ; ?>; font-weight: bold;">
                                 RECEIVING
                            </td>
                            <td>
                                <?= $model->getStatus($model->dv_no, 'Receiving') != null ? $model->getStatus($model->dv_no, 'Receiving')->employee : ''; ?>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>
                                <?= $model->getStatus($model->dv_no, 'Receiving') != null ? $model->getStatus($model->dv_no, 'Receiving')->date : ''; ?>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="locator">
                    <table style="width: 100%; color: #fff;">
                        <tr>
                            <td style="width: 7%; opacity: <?= $model->getStatus($model->dv_no, 'Processing') != null ? 1 : .5 ; ?>">
                                <span class="fa fa-map-marker" style="color: #fff; font-size: 22px; text-shadow: 2px 2px 2px 3px green"></span>
                            </td>
                            <td style="width: 40%; vertical-align: middle; padding-right: 5px; opacity: <?= $model->getStatus($model->dv_no, 'Processing') != null ? 1 : .5 ; ?>; font-weight: bold;">
                                 PROCESSING
                            </td>
                            <td>
                                <?= $model->getStatus($model->dv_no, 'Processing') != null ? $model->getStatus($model->dv_no, 'Processing')->employee : ''; ?>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>
                                <?= $model->getStatus($model->dv_no, 'Processing') != null ? $model->getStatus($model->dv_no, 'Processing')->date : ''; ?>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="locator">
                    <table style="width: 100%; color: #fff;">
                        <tr>
                            <td style="width: 7%; opacity: <?= $model->getStatus($model->dv_no, 'Verifying') != null ? 1 : .5 ; ?>">
                                <span class="fa fa-map-marker" style="color: #fff; font-size: 22px; text-shadow: 2px 2px 2px 3px green"></span>
                            </td>
                            <td style="width: 40%; vertical-align: middle; padding-right: 5px; opacity: <?= $model->getStatus($model->dv_no, 'Verifying') != null ? 1 : .5 ; ?>; font-weight: bold;">
                                 VERIFYING
                            </td>
                            <td>
                                <?= $model->getStatus($model->dv_no, 'Verifying') != null ? $model->getStatus($model->dv_no, 'Verifying')->employee : ''; ?>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>
                                <?= $model->getStatus($model->dv_no, 'Verifying') != null ? $model->getStatus($model->dv_no, 'Verifying')->date : ''; ?>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="locator">
                    <table style="width: 100%; color: #fff;">
                        <tr>
                            <td style="width: 7%; opacity: <?= $model->getStatus($model->dv_no, 'NCA Controlling') != null ? 1 : .5 ; ?>">
                                <span class="fa fa-map-marker" style="color: #fff; font-size: 22px; text-shadow: 2px 2px 2px 3px green"></span>
                            </td>
                            <td style="width: 40%; vertical-align: middle; padding-right: 5px; opacity: <?= $model->getStatus($model->dv_no, 'NCA Controlling') != null ? 1 : .5 ; ?>; font-weight: bold;">
                                 NCA Control
                            </td>
                            <td>
                                <?= $model->getStatus($model->dv_no, 'NCA Controlling') != null ? $model->getStatus($model->dv_no, 'NCA Controlling')->employee : ''; ?>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>
                                <?= $model->getStatus($model->dv_no, 'NCA Controlling') != null ? $model->getStatus($model->dv_no, 'NCA Controlling')->date : ''; ?>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="locator">
                    <table style="width: 100%; color: #fff;">
                        <tr>
                            <td style="width: 7%; opacity: <?= $model->getStatus($model->dv_no, 'Indexing') != null ? 1 : .5 ; ?>">
                                <span class="fa fa-map-marker" style="color: #fff; font-size: 22px; text-shadow: 2px 2px 2px 3px green"></span>
                            </td>
                            <td style="width: 40%; vertical-align: middle; padding-right: 5px; opacity: <?= $model->getStatus($model->dv_no, 'Indexing') != null ? 1 : .5 ; ?>; font-weight: bold;">
                                 Indexing
                            </td>
                            <td>
                                <?= $model->getStatus($model->dv_no, 'Indexing') != null ? $model->getStatus($model->dv_no, 'Indexing')->employee : ''; ?>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>
                                <?= $model->getStatus($model->dv_no, 'Indexing') != null ? $model->getStatus($model->dv_no, 'Indexing')->date : ''; ?>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="locator">
                    <table style="width: 100%; color: #fff;">
                        <tr>
                            <td style="width: 7%; opacity: <?= $model->getStatus($model->dv_no, 'Preparing ADA') != null ? 1 : .5 ; ?>">
                                <span class="fa fa-map-marker" style="color: #fff; font-size: 22px; text-shadow: 2px 2px 2px 3px green"></span>
                            </td>
                            <td style="width: 40%; vertical-align: middle; padding-right: 5px; opacity: <?= $model->getStatus($model->dv_no, 'Preparing ADA') != null ? 1 : .5 ; ?>; font-weight: bold;">
                                 ADA Preparation
                            </td>
                            <td>
                                <?= $model->getStatus($model->dv_no, 'Preparing ADA') != null ? $model->getStatus($model->dv_no, 'Preparing ADA')->employee : ''; ?>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>
                                <?= $model->getStatus($model->dv_no, 'Preparing ADA') != null ? $model->getStatus($model->dv_no, 'Preparing ADA')->date : ''; ?>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="locator">
                    <table style="width: 100%; color: #fff;">
                        <tr>
                            <td style="width: 7%; opacity: <?= $model->getStatus($model->dv_no, 'Client') != null ? 1 : .5 ; ?>">
                                <span class="fa fa-map-marker" style="color: #fff; font-size: 22px; text-shadow: 2px 2px 2px 3px green"></span>
                            </td>
                            <td style="width: 40%; vertical-align: middle; padding-right: 5px; opacity: <?= $model->getStatus($model->dv_no, 'Releasing') != null ? 1 : .5 ; ?>; font-weight: bold;">
                                 Releasing
                            </td>
                            <td>
                                <?= $model->getStatus($model->dv_no, 'Releasing') != null ? $model->getStatus($model->dv_no, 'Releasing')->employee : ''; ?>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>
                                <?= $model->getStatus($model->dv_no, 'Releasing') != null ? $model->getStatus($model->dv_no, 'Releasing')->date : ''; ?>
                            </td>
                        </tr>
                    </table>
                </div>

            </div>
        </div>
        <div class="col-md-9">
            <div style="background-color: #fff; padding: 10px;">
                <table class="table table-bordered table-condensed" style="border: solid 1px;">
                    <tr>
                        <td colspan="2" rowspan="3" style="max-width: 35%; padding: 5px; text-align: center;">
                            <?php 
                                $generator = new Picqer\Barcode\BarcodeGeneratorSVG();
                                echo $generator->getBarcode($model->dv_no, $generator::TYPE_CODE_128, 1.7, 80);
                            ?>
                            <p><?= $model->dv_no ?></p>
                        </td>
                        <td colspan="2" style="text-align: center; width: 65%;">
                            <span style="font-size: 18px; font-weight: bold;">TRACKING FORM</span><br>
                            Accounting Division DV Tracking System
                        </td>
                    </tr>
                    <tr style = "font-size: 11px;">
                        <td style="width: 10%; font-weight: bold;">Name</td>
                        <td>
                            <?= $model->payee ?>
                        </td>
                    </tr>
                    <tr style = "font-size: 11px;">
                        <td style="font-weight: bold;">R_Center</td>
                        <td>
                            <?= $model->getRc($model->rc_code); ?>
                        </td>
                    </tr>
                    <tr style = "font-size: 11px;">
                        <td style="width: 10%; font-weight: bold;">
                            Fund Cluster
                        </td>
                        <td>
                            <?= $model->fund_cluster ?>
                        </td>
                        <td colspan="2">
                            Transaction : <?= $model->getTransaction($model->transaction) ?>
                        </td>
                    </tr>
                    <tr style = "font-size: 11px;">
                        <td style = "font-weight: bold;">Gross Amount</td>
                        <td><?= number_format($model->gross_amount, 2) ?></td>
                        <td colspan="2">
                            This transaction should have the following documentary requirements.
                        </td>
                    </tr>
                    <tr style = "font-size: 11px;">
                        <td style = "font-weight: bold;">Net Amount</td>
                        <td><?= number_format($model->net_amount, 2) ?></td>
                        <td colspan="2" rowspan="6">
                            <?php foreach ($dv_attachments as $key => $attach) : ?>
                                <?php if($attach != null) : ?>
                                <div style="width: 190px; display: inline-block;">
                                <input type="checkbox" checked="true" name="attach[<?= $key ?>]" value="<?= $attach ?>">
                                    <label style="font-size: 10px;"><?= mb_strimwidth($attach, 0, 35, ' ...') ?></label><br>
                                </div>
                                <?php endif ?>
                            <?php endforeach ?>
                            <?php foreach ($lacking as $key => $lack) : ?>
                                <div style="width: 190px; display: inline-block;">
                                <input type="checkbox" name="attach[<?= $key ?>]" value="<?= $lack ?>">
                                    <label style="font-size: 10px; color: grey"><?= mb_strimwidth($lack, 0, 35, ' ...') ?></label><br>
                                </div>
                            <?php endforeach ?>
                        </td>
                    </tr>
                    <tr style = "font-size: 11px;">
                        <td style = "font-weight: bold;">Date</td>
                        <td><?= $model->date; ?></td>
                    </tr>
                    <tr style = "font-size: 11px;">
                        <td style = "font-weight: bold;">Received by</td>
                        <td>
                            <?= $model->getDvstatus($model->dv_no) ?>
                        </td>
                    </tr>
                    <tr style = "font-size: 11px;">
                        <td style = "font-weight: bold;">Status</td>
                        <td><?= $model->status ?></td>
                    </tr>
                    <tr style = "font-size: 11px;">
                        <td colspan="2" style="background-color: #cccccc">Remarks</td>
                    </tr>
                    <tr style = "font-size: 11px;">
                        <td colspan="2" style="min-height: 100px;">
                            <?php foreach ($remarks as $key => $value) : ?>
                            <div class="alert alert-success" style="margin-bottom: 0px;">
                            <table style="width: 100%;">
                                <tr>
                                    <td style="vertical-align: top; color: #000; text-align: right; border-right: solid 1px; padding-right: 3px; width: 40%">
                                        <?= $value->name->fullname ?>
                                        <p style="font-size: 9px; color: #000"><?= $value->date ?></p>
                                    </td>
                                    <td style="padding-left: 3px; vertical-align: top;">
                                        <p><?= $value->remarks ?></p>
                                    </td>
                                </tr>
                            </table>
                            </div>
                            <br>
                        <?php endforeach ?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>