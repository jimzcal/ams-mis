<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\JournalEntry */

$this->title = 'Journal Entry - Loan Repayment';
// $this->params['breadcrumbs'][] = ['label' => 'Journal Entries', 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
// $this->params['breadcrumbs'][] = 'Update';
?>
<div class="journal-entry-update">
    <div class="main-panel">
        <div style="font-size: 32px; color: #999999">
            <i class="fa fa-credit-card"></i> Loan Monthly Remittance
        </div>
        <br>
        
       <?= $this->render('_paymentForm', [
            'model' => $model,
            'dataProvider' => $dataProvider,
            'date' => $date,
        ]) ?>
    </div>
</div>



