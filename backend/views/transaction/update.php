<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Transaction */

$this->title = 'Update ' . $model->name;
// $this->params['breadcrumbs'][] = ['label' => 'Transactions', 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
// $this->params['breadcrumbs'][] = 'Update';
?>
<div class="transaction-update">

	<div class="new-title">
        <i class="glyphicon glyphicon-edit" aria-hidden="true"></i> Update Transaction
    </div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
