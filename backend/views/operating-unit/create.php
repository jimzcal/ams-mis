<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\OperatingUnit */

$this->title = 'New Operating Unit';
// $this->params['breadcrumbs'][] = ['label' => 'Operating Units', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="operating-unit-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
