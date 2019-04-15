<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\NationalAgency */

$this->title = 'Update National Agency: ' . $model->id;
// $this->params['breadcrumbs'][] = ['label' => 'National Agencies', 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
// $this->params['breadcrumbs'][] = 'Update';
?>
<div class="national-agency-update">

	<div style="color: #fff; border-bottom: solid 2px #fff; text-align: right; padding-top: 13px;" id="no-print">
        <h3>IMPLEMENTING AGENCY</h3>
    </div>
    <br>

    <div style="width: 60%; margin-right: auto; margin-left: auto; border-radius: 5px; background-color: #fff; opacity: .9; padding: 8px;">
	    <?= $this->render('_form', [
	        'model' => $model,
	    ]) ?>
	</div>

</div>
