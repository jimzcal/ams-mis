<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Requirements */

$this->title = 'Update Requirement: ' . $model->requirement;
// $this->params['breadcrumbs'][] = ['label' => 'Requirements', 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
// $this->params['breadcrumbs'][] = 'Update';
?>
<div class="requirements-update">
	<div class="form-wrapper">
	    <div class="form-title">UPDATE FORM</div>

	    <?= $this->render('_form', [
	        'model' => $model,
	    ]) ?>
	</div>
</div>
