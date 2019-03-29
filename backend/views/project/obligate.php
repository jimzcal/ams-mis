<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Ors */

$this->title = 'ORS - '.$model->title;
// $this->params['breadcrumbs'][] = ['label' => 'Ors', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="ors-view">

    <div style="color: #fff; border-bottom: solid 2px #fff; text-align: right; padding-top: 13px;">
        <h3>OBLIGATION</h3>
    </div>
    <p>
        <?= Html::a('Obligate', ['obligate', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Disburse', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Liquidate', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <div style="background-color: #fff; width: 70%; font-size: 12px; margin-right: auto; margin-left: auto; border-radius: 5px;">
        <div style="width: 100%; border-top-right-radius: 5px; border-bottom-left-radius: 5px; background-color: #e6e6e6; height: 30px; padding: 5px; line-height: 20px; color: #4d4d4d">
            OBLIGATE PROJECT
        </div>
        <table style="width: 100%;" class="table table-bordered">
            <tr>
                <td>
                    <strong>PROJECT TITLE:</strong>
                </td>
                <td colspan="4">
                    <?= $model->title ?>
                </td>
            </tr>
            <tr>
                <td>
                    <strong>DATE:</strong>
                </td>
                <td colspan="4">
                    <?= $model->date ?>
                </td>
            </tr>
            <tr>
                <td>
                    <strong>REGION:</strong>
                </td>
                <td colspan="4">
                    <?= $model->region ?>
                </td>
            </tr>
            <tr>
                <td>
                    <strong>SUB-OFFICE:</strong>
                </td>
                <td colspan="4">
                    <?= $model->sub_office ?>
                </td>
            </tr>
            <tr>
                <td>
                    <strong>IMPLEMENTING AGENCY:</strong>
                </td>
                <td colspan="4">
                    <?= $model->implementing_agency ?>
                </td>
            </tr>
            <tr>
                <td>
                    <strong>FOCAL PERSON:</strong>
                </td>
                <td colspan="4">
                    <?= $model->focal_person ?>
                </td>
            </tr>
            <tr>
                <th style="text-align: center; width: 25%;">Responsibility Cente</th>
                <th style="text-align: center;">MFO/PA</th>
                <th style="text-align: center;">Expenditure</th>
                <th style="text-align: center; width: 30%">Amount</th>
            </tr>
            <?php foreach (explode('*', $model->ors_no) as $key => $value) : ?>
                <tr>
                    <td>
                        <?= $model->getOrs($value, Yii::$app->user->identity->region)->rc ?>
                    </td>
                    <td>
                        <?= $model->getOrs($value, Yii::$app->user->identity->region)->mfo_pap ?>
                    </td>
                    <td>
                        <?= $model->getOrs($value, Yii::$app->user->identity->region)->object_code ?>
                    </td>
                    <td>
                        <?= $model->getOrs($value, Yii::$app->user->identity->region)->obligation ?>
                    </td>
                </tr>
            <?php endforeach ?>
                <tr style="height: 90px; border-top: 0px;">
                    <td colspan="5"></td>
                </tr>
        </table>
    </div>
</div>
