<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Transaction */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Transactions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaction-view">

    <div class="new-title">
        <i class="fa fa-tasks" aria-hidden="true"></i> <?= Html::encode($this->title) ?>
        <p style="text-indent: 30px; font-size: 14px;">List of Minimum Documentary Requirements for this Transaction in compliance to COA Circular No. 2012-001 of the Commission On Audit (COA) issued on June 14, 2012 as amended.</p>
    </div>

    <div class="view-index">
        <table class="table table-bordered table-striped">
            <tr>
                <td style="width: 230px;">
                    <label>Transaction</label>
                </td>
                <td>
                    <?= $model->name ?>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Documentary Requirements</label>
                </td>
                <td>
                    <?php $val = explode(',', $model->requirements) ?>

                    <?php for ($i=0; $i<sizeof($val); $i++) : ?>

                        <div style="display: block"><?= ($i+1).'. '.$val[$i] ?></div>

                    <?php endfor ?>
                </td>
            </tr>
        </table>
    </div>

</div>
