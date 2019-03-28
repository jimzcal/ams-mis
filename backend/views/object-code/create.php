<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ObjectCode */

$this->title = 'Create Object Code';
$this->params['breadcrumbs'][] = ['label' => 'Object Codes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="object-code-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
