<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Employees */

$this->title = 'New Employee';
// $this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="employees-create">

    <div style="width: 900px; margin-right: auto; margin-left: auto; border-right: 10px; background-color: #FFFFFF; margin-top: 10px; padding: 10px;">
    	<!-- <div class="mini-header">
    		<i class="fa fa-group" aria-hidden="true"></i> New Employees
    	</div> -->
    	
	    <?= $this->render('_form', [
	        'model' => $model,
	    ]) ?>
	</div>

</div>
