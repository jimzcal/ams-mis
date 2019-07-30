<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\DueDemandables */

$this->title = 'Create Due Demandables';
// $this->params['breadcrumbs'][] = ['label' => 'Due Demandables', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="due-demandables-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
