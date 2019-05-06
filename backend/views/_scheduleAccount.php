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
                    <h3>S C H E D U L E  &nbsp O F&nbsp A C C O U N T</h3>
                    <p style="font-size: 20px; text-decoration: underline;"><?= '('.$model->account_code.') '.$model->getAccount($model->account_code) ?></p>
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
        <table style="font-size: 12px; width: 98%; margin-left: auto; margin-right: auto;">
            <tr style="border-bottom: solid 1px; border-top: solid 1px">
                <th style="width: 25%; padding: 5px">
                    C O D E
                </th>
                <th style="width: 50%; padding: 5px">
                    D E S C R I P T I O N
                </th>
                <th>
                    A M O U N T 
                </th>
            </tr>
            <?php $total = 0; ?>
            <?php foreach ($dataProvider as $key => $value) : ?>
                <tr>
                    <td style="padding: 7px">
                        <?= $value->account_code ?>
                    </td>
                    <td style="padding: 7px">
                        <?= Html::a($value->account_title, ["subsidiary-ledger/subindex", 'date_from' => $model->date_from, 'date_to' => $model->date_to, 'account_code' => $value->account_code], ['style' => 'text-decoration: none; color: #000;'])  ?>
                    </td>
                    <td style="padding: 7px; text-align: right; font-weight: bold;">
                        <?= number_format($value->getAmount($value->account_code, $model->date_from, $model->date_to), 2) ?>
                    </td>
                </tr>
                <?php
                    $total = $total + $value->getAmount($value->account_code, $model->date_from, $model->date_to);
                 ?>
            <?php endforeach ?>
                <tr>
                    <td></td>
                    <td style="font-weight: bold; font-style: 18px; text-align: right;">GRAND TOTAL: </td>
                    <td style="font-weight: bold; text-align: right; font-size: 20px; border-bottom: solid 1px; border-top: solid 1px;">
                        <?= number_format($total, 2) ?>
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