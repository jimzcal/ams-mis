<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Transaction */

$this->title = 'Add New Transaction';
// $this->params['breadcrumbs'][] = ['label' => 'Transactions', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaction-create">
	<?= Yii::$app->session->getFlash('error'); ?>

	    <div class="new-title">
	        <i class="fa fa-id-card" aria-hidden="true"></i> New Transaction
	    </div>

	    <?= $this->render('_form', [
	        'model' => $model,
	    ]) ?>

</div>
