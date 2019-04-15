<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ImplementingAgency */

$this->title = 'Update Implementing Agency: ' . $model->id;
// $this->params['breadcrumbs'][] = ['label' => 'Implementing Agencies', 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
// $this->params['breadcrumbs'][] = 'Update';
?>
<div class="implementing-agency-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
