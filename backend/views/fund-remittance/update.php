<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\FundRemittance */

$this->title = 'Update Fund Remittance: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Fund Remittances', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="fund-remittance-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
