<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Liquidations */

$this->title = 'Create Liquidations';
$this->params['breadcrumbs'][] = ['label' => 'Liquidations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="liquidations-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
