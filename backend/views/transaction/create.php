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

	    <div style="color: #fff; border-bottom: solid 2px #fff; text-align: right; padding-top: 13px;">
	        <h3>Common Government Transaction</h3>
	    </div>

	    <?= $this->render('_form', [
	        'model' => $model,
	    ]) ?>

</div>
