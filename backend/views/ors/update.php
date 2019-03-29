<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Ors */

$this->title = 'Update Ors: ' . $model->id;
// $this->params['breadcrumbs'][] = ['label' => 'Ors', 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
// $this->params['breadcrumbs'][] = 'Update';
?>
<div class="ors-update">

    <div style="color: #fff; border-bottom: solid 2px #fff; text-align: right; padding-top: 13px;">
        <h3>OBLIGATION</h3>
    </div>
    <br>

    <?= $this->render('_formUpdate', [
        'model' => $model,
    ]) ?>

</div>
