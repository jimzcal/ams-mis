<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use barcode\barcode\BarcodeGenerator;

/* @var $this yii\web\View */
/* @var $model common\models\DraftDv */

$this->title = $model->reference_no;
// $this->params['breadcrumbs'][] = ['label' => 'Draft Dvs', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="draft-dv-view">

    <div class="right-top-button">
        <?= Html::a('<i class="glyphicon glyphicon-edit"></i> Update ', ['update', 'id' => $model->id], ['class' => 'right-button-text']) ?>
        <a href="javascript:window.print()" class="right-button-text">
            <i class="glyphicon glyphicon-print" style= "font-size: 14px;"></i> Print DV
        </a>
        <?= Html::a(' <i class="glyphicon glyphicon-trash"></i> Delete', ['delete', 'id' => $model->id], [
            'class' => 'right-button-text',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </div>

   <!--  <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'reference_no',
            'date',
            'payee',
            'tin',
            'fund_cluster',
            'transaction_type',
            'particulars:ntext',
            'gross_amount',
            'created_by',
            'status',
        ],
    ]) ?> -->
    <div class="view-dv">
        <table style="margin-right: auto; margin-left: auto; border: solid 2px #000000;" id="view-dv-table">
            <tr>
                <td style="width: 20%">
                    <?= Html::img('@web/images/DA_logo.png', ['alt'=>'DA-AMS Logo', 'style' => 'width: 110px; display: block; margin: 10px 10px 0px 10px;']); ?>
                </td>
                <td colspan="4" style="width: 60%">
                    <p style="text-align: center; margin-top: 5px;">
                        <span style="font-size: 18px; font-weight: bold;">Department of Agriculture</span>
                        <br style="font-size: 14px;">Central Office, Elliptical Road, Diliman, Quezon City
                    </p>
                    <p style="text-align: center; font-size: 20px;">DISBURSEMENT VOUCHER</p>
                </td>
                <td style="width: 20%; border-left: solid 1px #000000; vertical-align: top; padding-top: 3px;">
                    <span style="font-weight: bold;">Fund Cluster:</span><br>
                    <span style="text-decoration: underline;"><?= $model->cluster->description ?></span><br>
                    <span style="font-weight: bold;">Date: </span>
                    <span style="text-decoration: underline;"> <?= $model->date ?></span><br>
                    <span style="font-weight: bold;">DV No: </span><br>
                </td>
            </tr>
            <tr style="border-top: solid 1px #000000">
                <td style="border-right: solid 1px #000000; font-weight: bold; text-align: right; height: 30px;">
                    Mode of Payment:
                </td>
                <td colspan="5">
                    <span class="glyphicon glyphicon-unchecked" style="margin-left: 10px;"></span> MDS Check 
                    <span class="glyphicon glyphicon-unchecked" style="margin-left: 10px;"></span> Commercial Check 
                    <span class="glyphicon glyphicon-unchecked" style="margin-left: 10px;"></span> LDDAP-ADA 
                    <span class="glyphicon glyphicon-unchecked" style="margin-left: 10px;"></span> Others (Pls. specify) ______________ 
                </td>
            </tr>
            <tr style="border-top: solid 1px #000000; font-size: 12px; height: 30px;">
                <td style="border-right: solid 1px #000000; font-weight: bold; text-align: right;">
                    Payee:
                </td>
                <td colspan="3" style="border-right: solid 1px #000000;">
                    <?= $model->payee ?>
                </td>
                <td style="border-right: solid 1px #000000; vertical-align: top; width: 20%">
                    <strong>TIN No./Employee No.</strong><br>
                    <?= $model->tin ?>
                </td>
                <td style="border-right: solid 1px #000000; vertical-align: top;">
                    <strong>ORS/BURS No.</strong>
                </td>
            </tr>
            <tr style="border-top: solid 1px #000000">
                <td style="border-right: solid 1px #000000; font-weight: bold; text-align: right; height: 30px;">
                    Address:
                </td>
                <td colspan="5">
                    <input type="text" name="name" class="textfield" style="text-align: left;">
                </td>
            </tr>
            <tr style="border-top: solid 1px #000000;">
                <td colspan="6">
                    <table style="width: 100%;">
                        <tr style="font-size: 12px;">
                            <td style="border-right: solid 1px #000000; text-align: center; font-weight: bold; width: 60%">
                                Particulars
                            </td>
                            <td style="border-right: solid 1px #000000; font-weight: bold; width: 15%;">
                                Responsibility Center
                            </td>
                            <td style="border-right: solid 1px #000000; font-weight: bold; text-align: center; width: 15%;">MFO/PAP</td>
                            <td style="font-weight: bold; text-align: center; width: 10%;">Amount</td>
                        </tr>
                        <tr style="border-top: solid 1px #000000; height: 260px; vertical-align: top;">
                            <td style="border-right: solid 1px #000000;">
                                <table style="width: 100%; height: 100%; font-size: 12px;">
                                    <tr style="vertical-align: top; height: 90px;">
                                        <td>
                                            <?= $model->particulars ?>
                                        </td>
                                    </tr>
                                    <tr style="vertical-align: top;">
                                        <td>
                                           <strong>Documentary Requirements:</strong><br>
                                           <?php foreach ($requirements as $key => $value) : ?>
                                                <?= ($key+1).'. '.$value.'<br>' ?>
                                           <?php endforeach ?>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td style="border-right: solid 1px #000000; font-weight: bold; vertical-align: top;">
                                <input type="text" name="name" class="textfield" style="text-align: center;">
                            </td>
                            <td style="border-right: solid 1px #000000; font-weight: bold; text-align: center; vertical-align: top;">
                                <input type="text" name="name" class="textfield" style="text-align: center;">
                            </td>
                            <td style="font-weight: bold; text-align: center; vertical-align: top; font-size: 12px;">
                                <?= $model->gross_amount ?>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="font-weight: bold;">
                                <?= $model->gross_amount ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr style="border-top: solid 2px #000000; height: 130px;">
                <td colspan="6" style="border-right: solid 1px #000000; vertical-align: top; font-size: 12px; height: 45px; line-height: 10px; padding: 5px;">
                    <i>A. Certified Expenses/Cash Advance Necessary, lawful and incurred under my direct supervision.</i><br><br><br><br><br><br>
                    <center>
                        <input type="text" name="name" class="textfield" style="text-align: center; font-weight: bold; width: 300px; border-bottom: solid 1px #000000; font-size: 13px; text-transform: uppercase;" placeholder="Refer your input here to GMO">
                    </center><br>
                    <center>Printed Name, Designation and Signature of Supervisor</center>
                </td>
            </tr>
            <tr style="border-bottom: solid 1px #000000; border-top: solid 2px #000000">
                <td colspan="6" style="border-right: solid 1px #000000; vertical-align: top; font-size: 12px; height: 20px; line-height: 10px; padding: 5px;">
                    B. Accounting Entry
                </td>
            </tr>
            <tr style="border-bottom: solid 1px #000000">
                <td colspan="6">
                    <table style="width: 100%">
                        <tr>
                            <td colspan="3" style="width: 50%; border-right: solid 2px #000000; text-align: center; font-weight: bold;">
                                Account Title
                            </td>
                            <td style="border-right: solid 1px #000000; width: 170px; font-weight: bold; text-align: center;">
                                UACS Code
                            </td>
                            <td style="border-right: solid 1px #000000; font-weight: bold; text-align: center;">Debit</td>
                            <td style="font-weight: bold; text-align: center;">Credit</td>
                        </tr>
                        <tr style="border-top: solid 1px #000000; border-bottom: solid 1px #000000; height: 120px;">
                            <td colspan="3" style="border-right: solid 2px #000000; vertical-align: top; padding: 10px;">
                            </td>
                            <td style="border-right: solid 1px #000000; width: 170px; font-weight: bold;">
                                
                            </td>
                            <td style="border-right: solid 1px #000000; font-weight: bold; text-align: center;">

                            </td>
                            <td style="font-weight: bold; text-align: center;">

                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="6">
                    <table style="width: 100%">
                        <tr>
                            <td style="border-right: solid 2px #000000; vertical-align: top; font-size: 12px; height: 20px; line-height: 10px; padding: 5px; width: 50%">
                                C. Certified
                            </td>
                            <td style="vertical-align: top; font-size: 12px; height: 20px; line-height: 10px; padding: 5px; width: 50%">
                                D. Approved for Payment
                            </td>
                        </tr>
                        <tr style="border-top: solid 1px #000000; height: 80px;">
                            <td style="border-right: solid 2px #000000; vertical-align: top; font-size: 12px; height: 20px; line-height: 10px; padding-top: 5px; font-size: 13px; line-height: 23px;">
                                <span class="glyphicon glyphicon-unchecked" style="margin-left: 10px;"></span> Cash Available<br>
                                <span class="glyphicon glyphicon-unchecked" style="margin-left: 10px;"></span> Subject to Authority to debit Account (if applicable)<br>
                                <span class="glyphicon glyphicon-unchecked" style="margin-left: 10px;"></span>  Supporting documents complete and amount claimed proper<br>
                            </td>
                            <td style="vertical-align: top; font-size: 12px; height: 20px; line-height: 10px; padding: 5px;">
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr style="border-bottom: solid 2px">
                <td colspan="6">
                    <table style="width: 100%">
                        <tr style="border-top: solid 1px #000000; height: 80px;">
                            <td style="border-right: solid 2px #000000; vertical-align: top; font-size: 12px; height: 20px; line-height: 10px; padding: 5px; width: 50%">
                                <table style="width: 100%; height: 100%">
                                    <tr>
                                        <td style="width: 30%; text-align: left; border-bottom: solid 1px #000000; border-right: solid 1px #000000; padding: 5px;">Signature</td>
                                        <td></td>
                                    </tr>
                                    <tr style="border-bottom: solid 1px #000000">
                                        <td style="width: 30%; text-align: left; border-bottom: solid 1px #000000; border-right: solid 1px #000000; padding: 5px;">Printed Name</td>
                                        <td>
                                            <input type="text" name="name" class="textfield" style="text-align: center; font-weight: bold; text-transform: uppercase;" placeholder="Refer your input here to GMO">
                                        </td>
                                    </tr>
                                    <tr style="border-bottom: solid 1px #000000">
                                        <td style="width: 30%; text-align: left; border-bottom: solid 1px #000000; border-right: solid 1px #000000; padding: 5px;">Position</td>
                                        <td>
                                            <input type="text" name="name" class="textfield" style="text-align: center;">
                                        </td>
                                    </tr>
                                    <tr style="border-bottom: solid 1px #000000">
                                        <td style="width: 30%; text-align: left; border-right: solid 1px #000000; padding: 5px;">Date</td>
                                        <td style="text-align: center; font-weight: bold;"><?= date('M d, Y') ?></td>
                                    </tr>
                                </table>
                            </td>
                            <td style="vertical-align: top; font-size: 12px; height: 20px; line-height: 10px; padding: 5px; width: 50%">
                                <table style="width: 100%; height: 100%">
                                    <tr>
                                        <td style="width: 30%; text-align: left; border-bottom: solid 1px #000000; border-right: solid 1px #000000; padding: 5px;">Signature</td>
                                        <td></td>
                                    </tr>
                                    <tr style="border-bottom: solid 1px #000000">
                                        <td style="width: 30%; text-align: left; border-bottom: solid 1px #000000; border-right: solid 1px #000000; padding: 5px;">Printed Name</td>
                                        <td>
                                            <input type="text" name="name" class="textfield" style="text-align: center; font-weight: bold; text-transform: uppercase;" placeholder="Refer your input here to GMO">
                                        </td>
                                    </tr>
                                    <tr style="border-bottom: solid 1px #000000">
                                        <td style="width: 30%; text-align: left; border-bottom: solid 1px #000000; border-right: solid 1px #000000; padding: 5px;">Position</td>
                                        <td>
                                            <input type="text" name="name" class="textfield" style="text-align: center;">
                                        </td>
                                    </tr>
                                    <tr style="border-bottom: solid 1px #000000">
                                        <td style="width: 30%; text-align: left; border-right: solid 1px #000000; padding: 5px;">Date</td>
                                        <td style="text-align: center; font-weight: bold;"><?= date('M d, Y') ?></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr style="border-bottom: solid 1px #000000;">
                <td colspan="6">
                    <table style="width: 100%">
                        <tr>
                            <td style="border-right: solid 1px #000000; vertical-align: top; font-size: 12px; height: 20px; line-height: 10px; padding: 5px; width: 80%;">
                                E. Receipt of Payment
                            </td>
                            <td style="font-size: 12px;">
                                JEV No.
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr style="border-bottom: solid 1px #000000;">
                <td colspan="6">
                    <table style="width: 100%; font-size: 11px; height: 30px;">
                        <tr style="vertical-align: top; ">
                            <td style="border-right: solid 1px; width: 15%">Check/Ada No.</td>
                            <td style="border-right: solid 1px; width: 25%"></td>
                            <td style="border-right: solid 1px; width: 10%">Date:</td>
                            <td style="border-right: solid 1px">Bank Name & Account No.</td>
                            <td style="width: 20%"></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr style="border-bottom: solid 1px #000000;">
                <td colspan="6">
                    <table style="width: 100%; font-size: 11px; height: 30px;">
                        <tr style="vertical-align: top; ">
                            <td style="border-right: solid 1px; width: 15%">Signature</td>
                            <td style="border-right: solid 1px; width: 25%"></td>
                            <td style="border-right: solid 1px; width: 10%">Date:</td>
                            <td style="border-right: solid 1px">Printed Name:</td>
                            <td style="width: 20%">Date:</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr style="border-bottom: solid 2px #000000;">
                <td colspan="6" style="font-size: 10px;">
                    Official Receipt No. & Date/Other Documents:
                </td>
            </tr>
        </table>
    </div>

    <div class="view-dv-ref">
        <table style="margin-right: auto; margin-left: auto; border: solid 2px #000000;" id="view-dv-table">
            <tr>
                <td colspan="4" style="border-bottom: solid 2px #000000;">
                    <i style="font-size: 16px; font-weight: bold;">REFERENCE FORM</i> 
                    <i style="font-size: 11px;"> - Print this form along with your Disbursement Voucher and present this to the receiving personnel of Accounting Division when you start processing your claim/s.
                </td>
            </tr>
            <tr style="border-bottom: solid 1px;">
                <td width="45" rowspan="4" align="center" style="padding: 10px; border-right: solid 2px;">
                    <?php 
                        $generator = new Picqer\Barcode\BarcodeGeneratorSVG();
                        echo $generator->getBarcode($model->reference_no, $generator::TYPE_CODE_128, 2, 60);
                    ?>
                    <p><?= $model->reference_no ?></p>
                </td>
                <td style="font-weight: bold; width: 15%;">Name of Payee</td>
                <td style="width: 2%;">:</td>
                <td><?= $model->payee ?></td>
            </tr>
            <tr style="border-bottom: solid 1px;">
                <td style="font-weight: bold;">Date</td>
                <td>:</td>
                <td><?= $model->date ?></td>
            </tr>
            <tr style="border-bottom: solid 1px;">
                <td style="font-weight: bold;">Gross Amount</td>
                <td>:</td>
                <td><?= $model->gross_amount ?></td>
            </tr>
            <tr style="border-bottom: solid 1px;">
                <td style="font-weight: bold;">Particulars</td>
                <td>:</td>
                <td><?= $model->particulars ?></td>
            </tr>
        </table>
    </div>
</div>
