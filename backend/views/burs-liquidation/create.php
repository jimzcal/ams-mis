<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\BursLiquidation */

$this->title = 'Create Burs Liquidation';
$this->params['breadcrumbs'][] = ['label' => 'Burs Liquidations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="burs-liquidation-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
