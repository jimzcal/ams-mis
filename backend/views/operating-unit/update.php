<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\OperatingUnit */

$this->title = 'Update Operating Unit: ' . $model->id;
// $this->params['breadcrumbs'][] = ['label' => 'Operating Units', 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
// $this->params['breadcrumbs'][] = 'Update';
?>
<div class="operating-unit-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
