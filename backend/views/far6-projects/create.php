<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Far6Projects */

$this->title = 'Create Far6 Projects';
$this->params['breadcrumbs'][] = ['label' => 'Far6 Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="far6-projects-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
