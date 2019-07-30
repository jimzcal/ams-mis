<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use dosamigos\chartjs\ChartJs;

/* @var $this yii\web\View */
/* @var $model backend\models\Projects */

$this->title = $model->id;
// $this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="projects-view">

    <div style="color: #fff; border-bottom: solid 2px #fff; text-align: right; padding-top: 13px;">
        <h4><?= strtoupper($model->project_title) ?></h4>
    </div>
    <br>
    <div class="row">
        <div class="col-md-3">
            <div style="width: 100%; min-height: 400px; padding: 10px; background-color: #0099cc">
                <div style="background-color: #33ccff; width: 100%; padding: 12px; color: #fff; border: solid 1px #00ace6;">
                    <span class="fa fa-pen" style="color: green; text-shadow: 2px 2px 2px #fff; font-size: 20px;"></span> SELECT ACTION
                </div><br>
                <?= Html::a('OBLIGATIONS', ['obligations/index', 'project_id' => $model->id], ['class' => 'btn btn-primary', 'style' => 'width: 100%; display: inline-block; margin-bottom: 5px;']) ?>
                <br>
                <?= Html::a('DISBURSEMENTS', ['disbursements/index', 'project_id' => $model->id], ['class' => 'btn btn-primary', 'style' => 'width: 100%; display: inline-block; margin-bottom: 5px;']) ?>
                <br>
                <?= Html::a('LIQUIDATIONS', ['liquidations/index', 'project_id' => $model->id], ['class' => 'btn btn-primary', 'style' => 'width: 100%; display: inline-block; margin-bottom: 5px;']) ?>
                <br>
                <?= Html::a('UPDATE PROJECT', ['update', 'id' => $model->id], ['class' => 'btn btn-primary', 'style' => 'width: 100%; display: inline-block; margin-bottom: 5px;']) ?>
                <?= Html::a('DELETE PROJECT', ['delete', 'id' => $model->id], [
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
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-striped table-condensed table-bordered" style="background-color: #fff; font-size: 11px;">
                        <tr>
                            <td colspan="2" style="background-color: #f2f2f2; font-weight: bold;">
                                PROJECT DETAILS
                            </td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold; width: 18%;">
                                Source Agency :
                            </td>
                            <td style="font-style: italic;">
                                <?= $model->department.' - '.$model->agency.' - '.$model->operating_office ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;">
                                Focal Person :
                            </td>
                            <td style="font-style: italic;">
                                <?= $model->focal_person ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div style="background-color: #fff">
                        <?= ChartJs::widget([
                            'type' => 'bar',
                            'options' => [
                                'height' => 140,
                                'width' => 400
                            ],
                            'data' => [
                                'labels' => ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sept", "Oct", "Nov", "Dec"],
                                'datasets' => [
                                    [
                                        'label' => "Obligations",
                                        'backgroundColor' => "rgba(0,204,102,0.75)",
                                        // 'borderColor' => "rgba(179,181,198,1)",
                                        'pointBackgroundColor' => "rgba(179,181,198,1)",
                                        'pointBorderColor' => "#fff",
                                        'pointHoverBackgroundColor' => "#fff",
                                        'pointHoverBorderColor' => "rgba(179,181,198,1)",
                                        'data' => $model->getMonthlyobligation($model->id),
                                    ],
                                    [
                                        'label' => "Disbursements",
                                        'backgroundColor' => "rgba(0,153,153,0.75)",
                                        // 'borderColor' => "rgba(255,99,132,1)",
                                        'pointBackgroundColor' => "rgba(255,99,132,1)",
                                        'pointBorderColor' => "#fff",
                                        'pointHoverBackgroundColor' => "#fff",
                                        'pointHoverBorderColor' => "rgba(255,99,132,1)",
                                        'data' => $model->getMonthlydisbursement($model->id),
                                    ],
                                    [
                                        'label' => "Liquidations",
                                        'backgroundColor' => "rgba(255,204,153,0.75)",
                                        // 'borderColor' => "rgba(255,99,132,1)",
                                        'pointBackgroundColor' => "rgba(255,99,132,1)",
                                        'pointBorderColor' => "#fff",
                                        'pointHoverBackgroundColor' => "#fff",
                                        'pointHoverBorderColor' => "rgba(255,99,132,1)",
                                        'data' => $model->getMonthlyliquidation($model->id),
                                    ]
                                ]
                            ]
                        ]);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
