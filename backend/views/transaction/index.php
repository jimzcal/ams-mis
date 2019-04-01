<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\TransactionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'TRANSACTIONS';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaction-index">

    <div style="color: #fff; border-bottom: solid 2px #fff; text-align: right; padding-top: 13px;">
        <h3>Common Government Transactions</h3>
    </div>

    <p>
        <?= Html::a('New Requirement', ['/requirements/create'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('New Transaction', ['create'], ['class' => 'btn btn-primary']) ?>
    </p>

    <div class="new-title">
        <p style="text-indent: 28px; font-size: 14px; color: #fff">Minimum Documentary Requirements of each transaction</p>
    </div>

    <div style=" padding: 0; width: 98%; margin-left: auto; margin-right: auto; display: block;">
        <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    </div>

    <div class="view-index">
        <?php Pjax::begin(); ?>
        <?= GridView::widget([
                'dataProvider' => $dataProvider,
                //'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => 'name',
                        'format' => 'Html',
                        'contentOptions'=>['style'=>'max-width: 200px; white-space: normal;'],
                    ],
                    [
                        'attribute' => 'requirements',
                        'format' => 'Html',
                        'contentOptions'=>['style'=>'max-width: 700px; white-space: normal;'],
                        'value' => function($data){
                            $values = explode(', ', $data->requirements);
                            foreach ($values as $value)
                            {
                                return $value;
                            }
                            
                        }
                    ],

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        <?php Pjax::end(); ?>
    </div>
</div>
