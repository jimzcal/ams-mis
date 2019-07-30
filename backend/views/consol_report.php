<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Project */

$this->title = 'Report Result';
// $this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-create">
    <div style="color: #fff; border-bottom: solid 2px #fff; text-align: right; padding-top: 13px;"  id="no-print">
        <h3>INTER-AGENCY FUND TRANSFER REPORT</h3>
    </div>

    <?= $this->render('_consolReport', [
        'dataProvider' => $dataProvider,
        'model' => $model,
    ]) ?>

</div>
