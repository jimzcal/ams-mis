<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SubLedgerAccountsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Subsidiary Ledger Accounts';
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="sub-ledger-accounts-index">
    <div class="main-panel">
        <div style="font-size: 32px; color: #999999">
            <i class="fa fa-book"></i> Chart of SL Accounts
        </div>
        <br>
        <div style="width: 100%; border-bottom: solid 1px #cccccc">
            <div class="topnav" style="width: 380px">
                <?= Html::a("Major Accounts", ["/major-accounts/index"], ['class' => 'topnav-menu-first']) ?>
                <?= Html::a("SL Accounts", ["/sub-ledger-accounts/index"], ['class' => 'topnav-menu']) ?>
                <span class = 'topnav-menu-last' data-toggle="modal" data-target="#newModal"> New SL Account </span>
            </div>
        </div>
        <div class="right-panel-search">
            <div class="row">
                <div class="col-md-12">
                    <?= $this->render('_search', ['model' => $searchModel]); ?>
                </div>
            </div>
        </div>
        <br>

        <div style="overflow-y: scroll; max-height: 500px;">
            <table class="table table-bordered table-condensed table-striped" id="row">
                <tr>
                    <th>No.</th>
                    <th>Mother Account</th>
                    <th>Account Code</th>
                    <th>Account Title</th>
                    <th>Status</th>
                </tr>
                <?php foreach ($dataProvider->getModels() as $key => $value) : ?>
                    <tr data-id = "<?= $value->id ?>">
                        <td><?= $key + 1; ?></td>
                        <td><?= $value->mother_account.' - '.$value->getAccount($value->mother_account) ?></td>
                        <td><?= $value->account_code ?></td>
                        <td><?= $value->account_title ?></td>
                        <td><?= $value->status ?></td>
                    </tr>
                <?php endforeach ?>
                <?php if($dataProvider->getModels() == null) : ?>
                        <tr style="background-color: #d8d8d8">
                            <td colspan="4" style="font-style: italic;">No Records...</td>
                        </tr>
                    <?php endif ?>
            </table>
        </div>

    </div>
</div>

<div id="newModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
         <h4 class="modal-title">New Entry</h4>
      </div>
      <div class="modal-body">
            <div class="news-content-modal">
                <?= $this->render('_form', [
                    'model' => $model,
                ]) ?>
            </div>
      </div>
    </div>
    </div>
</div>

<!-- <script>
    $('tbody td').css('cursor', 'pointer');
        // $('tbody th').css('background-color', '#f5f5f0');
        $('tbody td').click(function (e) {
            var id = $(this).closest('tr').data('id');
            if (e.target == this)
                location.href = '" . Url::to(['disbursement/update']) . "&id=' + id;
        });
    ");
</script> -->

<?php
$this->registerJs("
    $('tbody').css('font-size', '12px');
    $('tbody td').css('cursor', 'pointer');
    $('tbody th').css('text-align', 'center');
    $('tbody td').click(function (e) {
        var id = $(this).closest('tr').data('id');
        if (e.target == this)
            location.href = '" . Url::to(['sub-ledger-accounts/update']) . "?id=' + id;
    });
"); ?>
