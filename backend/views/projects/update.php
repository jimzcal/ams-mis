<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Projects */

$this->title = 'Update Project: ' . $model->id;
// $this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
// $this->params['breadcrumbs'][] = 'Update';
?>
<div class="projects-update">

    <div style="color: #fff; border-bottom: solid 2px #fff; text-align: right; padding-top: 13px;" id="no-print">
        <h3>PROJECTS</h3>
    </div>
    <br>

    <div style="width: 90%; margin-right: auto; margin-left: auto; border-radius: 5px; background-color: #fff; opacity: .9; padding: 8px;">

	    <?= $this->render('_form', [
	        'model' => $model,
	    ]) ?>
	</div>

</div>
