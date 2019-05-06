<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\RegistryBudgetutilization */

$this->title = 'Update Registry Budgetutilization: ' . $model->burs_no;
// $this->params['breadcrumbs'][] = ['label' => 'Registry Budgetutilizations', 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
// $this->params['breadcrumbs'][] = 'Update';
?>
<div class="registry-budgetutilization-update">

    <div style="color: #fff; border-bottom: solid 2px #fff; text-align: right; padding-top: 13px;">
        <h3>REGISTRY OF BUDGET UTILIZATIONS REQUEST AND STATUS</h3>
    </div>
    <br>
    <div style="width: 80%; border-radius: 5px; background-color: #fff; margin-right: auto; margin-left: auto; padding: 15px; border: solid 1px #ccc;">
	    <?= $this->render('_updateForm', [
	        'model' => $model,
	        'data' => $data,
	    ]) ?>
	</div>

</div>
