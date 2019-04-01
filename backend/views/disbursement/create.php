<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Disbursement */

$this->title = 'New Disbursement';
// $this->params['breadcrumbs'][] = ['label' => 'Disbursements', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="disbursement-create">

    <div style="color: #fff; border-bottom: solid 2px #fff; text-align: right; padding-top: 13px;">
        <h3>DISBURSEMENT VOUCHER</h3>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
