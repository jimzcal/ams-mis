<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\RegistryBudgetutilization */

$this->title = 'Create Registry Budgetutilization';
$this->params['breadcrumbs'][] = ['label' => 'Registry Budgetutilizations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="registry-budgetutilization-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
