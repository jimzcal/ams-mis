<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\FundRemittance */

$this->title = 'Create Fund Remittance';
$this->params['breadcrumbs'][] = ['label' => 'Fund Remittances', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fund-remittance-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
