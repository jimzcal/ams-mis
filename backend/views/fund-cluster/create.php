<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\FundCluster */

$this->title = 'Create Fund Cluster';
$this->params['breadcrumbs'][] = ['label' => 'Fund Clusters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fund-cluster-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
