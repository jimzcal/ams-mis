<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Ors */

$this->title = 'ORS - '.$model->ors_no;
// $this->params['breadcrumbs'][] = ['label' => 'Ors', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="ors-view">

    <div style="color: #fff; border-bottom: solid 2px #fff; text-align: right; padding-top: 13px;">
        <h3>OBLIGATION</h3>
    </div>
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div style="background-color: #fff; width: 70%; font-size: 13px; margin-right: auto; margin-left: auto; border-radius: 5px;">
        <div style="width: 100%; border-top-right-radius: 5px; border-bottom-left-radius: 5px; background-color: #e6e6e6; height: 30px; padding: 5px; line-height: 20px; color: #4d4d4d">
            OBLIGATION REQUEST AND STATUS
        </div>
        <table style="width: 100%;" class="table table-bordered">
            <tr>
                <td colspan="3" style="text-align: center; padding: 3px;">
                    <h3>DEPARTMENT OF AGRICULTURE</h3>
                    <span style="font-size: 16px;"><?= $model->region ?></span><br>
                    <span style="font-size: 14px; font-style: italic;"><?= $model->sub_office ?></span>
                </td>
                <td colspan="2">
                    <strong>DATE:</strong><br>
                    <?= $model->date ?>
                    <br><br>
                    <strong>ORS No.</strong><br>
                    <?= $model->ors_no ?>
                </td>
            </tr>
            <tr>
                <td colspan="5">
                    <strong>APPROPRIATION:</strong> <?= $model->appropriation_class ?>
                </td>
            </tr>
            <tr>
                <td colspan="5">
                    <strong>PARTICULARS</strong><br><br>
                    <?= $model->particulars; ?>
                </td>
            </tr>
            <tr>
                <th style="text-align: center;">Responsibility Cente</th>
                <th style="text-align: center;">MFO/PA</th>
                <th style="text-align: center;">Expenditure</th>
                <th style="text-align: center; width: 30%">Amount</th>
            </tr>
            <?php foreach ($model->getOrs($model->ors_no, $model->region, $model->sub_office) as $key => $value) : ?>
                <tr>
                    <td><?= $value->rc ?></td>
                    <td><?= $value->mfo_pap ?></td>
                    <td><?= $value->object_code ?></td>
                    <td style="text-align: right; font-weight: bold;">
                        <?= number_format($value->obligation, 2) ?>        
                    </td>
                </tr>
            <?php endforeach ?>
                <tr style="height: 90px; border-top: 0px;">
                    <td colspan="5"></td>
                </tr>
        </table>
    </div>
</div>
