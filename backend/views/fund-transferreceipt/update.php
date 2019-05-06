<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\FundTransferreceipt */

$this->title = 'Update Fund Transferreceipt: ' . $model->id;
// $this->params['breadcrumbs'][] = ['label' => 'Fund Transferreceipts', 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
// $this->params['breadcrumbs'][] = 'Update';
?>
<div class="fund-transferreceipt-update">

    <div style="color: #fff; border-bottom: solid 2px #fff; text-align: right; padding-top: 13px;">
        <h3>FUND TRANSFER RECEIPT</h3>
    </div>
    <br>

    <div style="width: 40%;">
	    <?= $this->render('_form', [
	        'model' => $model,
	        'project' => $project
	    ]) ?>
	</div>

</div>
