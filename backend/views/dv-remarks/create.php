<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\DvRemarks */

$this->title = 'Create Dv Remarks';
$this->params['breadcrumbs'][] = ['label' => 'Dv Remarks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dv-remarks-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
