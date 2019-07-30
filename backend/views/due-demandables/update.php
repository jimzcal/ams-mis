<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\DueDemandables */

$this->title = 'Update Due Demandables: ' . $model->id;
// $this->params['breadcrumbs'][] = ['label' => 'Due Demandables', 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
// $this->params['breadcrumbs'][] = 'Update';
?>
<div class="due-demandables-update">

    <div style="color: #fff; border-bottom: solid 2px #fff; text-align: right; padding-top: 13px;">
        <h3>UPDATE DUE AND DEMANDABLE</h3>
    </div>
    <br>
    <div style="width: 50%;">
	    <?= $this->render('_form', [
	        'model' => $model,
	        'project_id' => $model->project_id,
	    ]) ?>
	</div>

</div>
