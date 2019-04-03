<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\OperatingUnit */

$this->title = 'Create Operating Unit';
// $this->params['breadcrumbs'][] = ['label' => 'Operating Units', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="operating-unit-create">

    <div style="color: #fff; border-bottom: solid 2px #fff; padding-top: 13px; text-align: right;" id="no-print">
        <h3>OPERATING UNIT</h3>
    </div>
    <br>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
