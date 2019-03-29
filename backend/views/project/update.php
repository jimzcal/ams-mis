<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Project */

$this->title = 'Update Project: ' . $model->title;
// $this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
// $this->params['breadcrumbs'][] = 'Update';
?>
<div class="project-update">

    <div style="color: #fff; border-bottom: solid 2px #fff; text-align: right; padding-top: 13px;">
        <h3>PROJECT</h3>
    </div>
    <br>

    <?= $this->render('_formUpdate', [
        'model' => $model,
    ]) ?>

</div>
