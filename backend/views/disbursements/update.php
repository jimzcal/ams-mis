<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Disbursements */

$this->title = 'UPDATE DV No. ' . $model->dv_no;
// $this->params['breadcrumbs'][] = ['label' => 'Disbursements', 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
// $this->params['breadcrumbs'][] = 'Update';
?>
<div class="disbursements-update">
    <div style="color: #fff; border-bottom: solid 2px #fff; text-align: right; padding-top: 13px;">
        <h3><?= Html::encode($this->title) ?></h3>
    </div>
    <br>
    <div style="width: 85%; padding: 10px; background-color: #0099cc; opacity: .95; margin-right: auto; margin-left: auto; display: block;">
	    <?= $this->render('_form', [
	        'model' => $model,
	        'project_id' => $model->project_id,
	    ]) ?>
	</div>

</div>