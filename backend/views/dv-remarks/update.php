<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\DvRemarks */

$this->title = 'Update Dv Remarks: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Dv Remarks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="dv-remarks-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
