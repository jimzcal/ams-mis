<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Employees */

$this->title = 'Update Profile: ' . $model->name;
// $this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
// $this->params['breadcrumbs'][] = 'Update';
?>
<div class="employees-update">

    <div style="width: 900px; margin-right: auto; margin-left: auto; border-right: 10px; background-color: #FFFFFF; margin-top: 10px; padding: 10px;">

	    <?= $this->render('_form', [
	        'model' => $model,
	    ]) ?>

	</div>

</div>
