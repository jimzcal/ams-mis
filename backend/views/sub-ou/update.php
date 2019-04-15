<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SubOu */

$this->title = 'Update Sub OU: ' . $model->id;
// $this->params['breadcrumbs'][] = ['label' => 'Sub Ous', 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
// $this->params['breadcrumbs'][] = 'Update';
?>
<div class="sub-ou-update">

    <div style="color: #fff; border-bottom: solid 2px #fff; text-align: right; padding-top: 13px;" id="no-print">
    <h3>SUB - OPERATING UNIT</h3>
    </div>
    <br>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
