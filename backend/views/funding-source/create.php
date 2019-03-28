<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\FundingSource */

$this->title = 'Create Funding Source';
$this->params['breadcrumbs'][] = ['label' => 'Funding Sources', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="funding-source-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
