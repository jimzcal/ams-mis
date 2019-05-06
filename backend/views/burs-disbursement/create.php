<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\BursDisbursement */

$this->title = 'Create Burs Disbursement';
$this->params['breadcrumbs'][] = ['label' => 'Burs Disbursements', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="burs-disbursement-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
