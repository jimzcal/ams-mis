<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = 'Update User: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-update">

    <div class="panel-header-wrapper">
        <h3><span class="glyphicon icon glyphicon-edit"></span> <?= Html::encode($this->title) ?></h3>
    </div>

    <?= $this->render('_changePasswordForm', [
        'model' => $model, 'model2' => $model2,
    ]) ?>

</div>
