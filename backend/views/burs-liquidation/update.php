<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\BursLiquidation */

$this->title = 'Update Burs Liquidation: ' . $model->id;
// $this->params['breadcrumbs'][] = ['label' => 'Burs Liquidations', 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
// $this->params['breadcrumbs'][] = 'Update';
?>
<div class="burs-liquidation-update">

    <div style="color: #fff; border-bottom: solid 2px #fff; text-align: right; padding-top: 13px;">
        <h3>LIQUIDATIONS</h3>
    </div>
    <br>
    <div style="width: 60%;">
	    <?= $this->render('_form', [
	        'model' => $model,
	        'project_id' => $model->project_id,
	    ]) ?>
	</div>
</div>
