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

    <div class="right-top-button">
        <?= Html::a('<i class="glyphicon glyphicon-plus"></i> Requirement', ['/requirements/create'], ['class' => 'right-button-text']) ?> | 
        <?= Html::a('<i class="glyphicon glyphicon-plus"></i> New Transaction', ['create'], ['class' => 'right-button-text']) ?>
    </div>

    <div class="new-title">
        <i class="fa fa-tasks" aria-hidden="true"></i> Common Government Transactions
        <p style="text-indent: 28px; font-size: 14px;">Minimum Documentary Requirements of each transaction</p>
    </div>

    <div style=" padding: 0; width: 88%; margin-left: auto; margin-right: auto; display: block;">
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
