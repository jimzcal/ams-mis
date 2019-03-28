<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ResponsibilityCenter */

$this->title = 'Create Responsibility Center';
$this->params['breadcrumbs'][] = ['label' => 'Responsibility Centers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="responsibility-center-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
