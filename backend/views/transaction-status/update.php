<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\TransactionStatus */

$this->title = 'Update Transaction Status: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Transaction Statuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="transaction-status-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
