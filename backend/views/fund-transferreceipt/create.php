<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\FundTransferreceipt */

$this->title = 'Create Fund Transferreceipt';
$this->params['breadcrumbs'][] = ['label' => 'Fund Transferreceipts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fund-transferreceipt-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
