<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\DisbursementSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'FINANCIAL REPORTS';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="disbursement-index">

    <div class="new-title">
        <i class="fa fa-cogs"></i> Control Panel
    </div>

    <div class="financial-reports-panel">

        <?= Html::a('<span class="fa fa-tasks fincial-report-icon-text" aria-hidden="true"></span><br>
            <spab class="report-text">COMMON TRANSACTIONS</span>', ["/transaction/index"], ['class' => 'financial-report-icon']) 
        ?>

        <?= Html::a('<span class="fa fa-users fincial-report-icon-text" aria-hidden="true"></span><br>
            <spab class="report-text">MANAGE USERS</span>', ["/user/admin/update", 'id'=>Yii::$app->user->identity->id], ['class' => 'financial-report-icon']) 
        ?>

        <?= Html::a('<span class="fa fa-list fincial-report-icon-text" aria-hidden="true"></span><br>
            <spab class="report-text">TRANSACTION REQUIREMENTS</span>', ["/requirements/create"], ['class' => 'financial-report-icon']) 
        ?>

        <?= Html::a('<span class="fa fa-file-photo-o fincial-report-icon-text" aria-hidden="true"></span><br>
            <spab class="report-text">FRONTEND GALLERY</span>', ["/images/index"], ['class' => 'financial-report-icon']) 
        ?>

        <?= Html::a('<span class="fa fa-database fincial-report-icon-text" aria-hidden="true"></span><br>
            <spab class="report-text">FUNDING SOURCE CODE</span>', ["/funding-source/index"], ['class' => 'financial-report-icon']) 
        ?>

        <?= Html::a('<span class="fa fa-object-group fincial-report-icon-text" aria-hidden="true"></span><br>
            <spab class="report-text">FUND CLUSTER CODE</span>', ["/fund-cluster/index"], ['class' => 'financial-report-icon']) 
        ?>

        <?= Html::a('<span class="fa fa-language fincial-report-icon-text" aria-hidden="true"></span><br>
            <spab class="report-text">MFO/PAP CODE</span>', ["/mfo-pap/index"], ['class' => 'financial-report-icon']) 
        ?>

        <?= Html::a('<span class="fa fa-institution fincial-report-icon-text" aria-hidden="true"></span><br>
            <spab class="report-text">RESPONSIBILITY CENTER</span>', ["/responsibility-center/index"], ['class' => 'financial-report-icon']) 
        ?>

        <?= Html::a('<span class="fa fa-qrcode fincial-report-icon-text" aria-hidden="true"></span><br>
            <spab class="report-text">OBJECT CODE</span>', ["/object-code/index"], ['class' => 'financial-report-icon']) 
        ?>

    </div>
</div>
