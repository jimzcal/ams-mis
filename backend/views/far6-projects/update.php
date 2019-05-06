<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Far6Projects */

$this->title = 'Update Far6 Projects: ' . $model->project_title;
// $this->params['breadcrumbs'][] = ['label' => 'Far6 Projects', 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
// $this->params['breadcrumbs'][] = 'Update';
?>
<div class="far6-projects-update">

    <div style="color: #fff; border-bottom: solid 2px #fff; text-align: right; padding-top: 13px;">
        <h3>PROJECT</h3>
    </div>

    <div style="width: 70%; padding: 10px;">
	    <?= $this->render('_form', [
	        'model' => $model,
	    ]) ?>
	</div>

</div>
