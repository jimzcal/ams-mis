<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\SubOu */

$this->title = 'Create Sub-OU';
// $this->params['breadcrumbs'][] = ['label' => 'Sub Ous', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="sub-ou-create">

    <div style="color: #fff; border-bottom: solid 2px #fff; text-align: right; padding-top: 13px;" id="no-print">
        <h3>SUB - OPERATING UNIT</h3>
    </div>
    <br>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
