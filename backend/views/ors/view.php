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
    <br>
    <div class="row">
        <div class="col-md-3">
            <div style="width: 100%; min-height: 400px; padding: 10px; background-color: #0099cc">
                <div style="background-color: #33ccff; width: 100%; padding: 12px; color: #fff; border: solid 1px #00ace6;">
                    <span class="fa fa-pointer" style="color: green; text-shadow: 2px 2px 2px #fff; font-size: 20px;"></span> SELECT ACTION
                </div><br>
                <?= Html::a('UPDATE', ['update', 'id' => $model->id], ['class' => 'btn btn-primary', 'style' => 'width: 100%; display: inline-block; margin-bottom: 5px;']) ?>
                <?= Html::a('DELETE', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'style' => 'width: 100%; display: inline-block; margin-bottom: 5px;',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
            </div>
        </div>
        <div class="col-md-9">
            <div style="background-color: #fff; width: 99%; font-size: 13px; margin-right: auto; margin-left: auto; border-radius: 5px;">
                <div style="width: 100%; border-top-right-radius: 5px; border-bottom-left-radius: 5px; background-color: #e6e6e6; height: 30px; padding: 5px; line-height: 20px; color: #4d4d4d">
                    OBLIGATION REQUEST AND STATUS
                </div>
                <table class="table table-striped table-condensed table-bordered" style="font-size: 12px;">
                    <tr>
                        <td style="width: 15%; font-weight: bold; font-style: italic;">Date</td>
                        <td><?= $model->date ?></td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold; font-style: italic;">ORS No.</td>
                        <td><?= $model->ors_no ?></td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold; font-style: italic;">GAA No.</td>
                        <td><?= $model->general_appropriation ?></td>
                    </tr>
                    <tr>
                        <td rowspan="2" style="font-weight: bold; font-style: italic;">Particulars</td>
                        <td rowspan="2" style="height: 80px; padding: 5px;"><?= $model->particulars; ?></td>
                    </tr>
                </table>
                <table style="width: 100%; font-size: 12px;" class="table table-bordered">
                    <tr>
                        <th style="text-align: center;">Responsibility Center</th>
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
    </div>
</div>
