<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Obligations */

$this->title = 'Update Obligations: ' . $model->id;
// $this->params['breadcrumbs'][] = ['label' => 'Obligations', 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
// $this->params['breadcrumbs'][] = 'Update';
?>
<div class="obligations-update">

    <div style="color: #fff; border-bottom: solid 2px #fff; text-align: right; padding-top: 13px;">
        <h3>UPDATE OBLIGATION</h3>
    </div>
    <br>
    <div style="width: 85%; padding: 10px; background-color: #0099cc; opacity: .95; margin-right: auto; margin-left: auto; display: block;">
    	<?= $this->render('_formUpdate', [
	        'model' => $model,
	        'data' => $data,
	    ]) ?>
    </div>
</div>
