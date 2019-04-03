<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\PurchaseOrder */

$this->title = 'PO Report';
// $this->params['breadcrumbs'][] = ['label' => 'Purchase Orders', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="purchase-order-create">

    <div style="color: #fff; border-bottom: solid 2px #fff; text-align: right; padding-top: 13px;" id="no-print" id="no-print">
        <h3>DV LOGSHEET</h3>
    </div>

    <?= $this->render('_report', [
        'data' => $data,
        'model' => $model,
    ]) ?>

</div>
