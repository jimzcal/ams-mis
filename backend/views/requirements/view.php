<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Requirements */

$this->title = $model->id;
// $this->params['breadcrumbs'][] = ['label' => 'Requirements', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="requirements-view">

    <div class="title">
        <p>
            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-right']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger btn-right',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>
    </div>
    <div class="new-title">
        <i class="fa fa-tasks" aria-hidden="true"></i> Requirement
    </div>

    <div class="view-index">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                // [
                //     'attribute' => 'requirement',
                //     'value' => function($data){
                //         $values = unserialize($data->requirement);
                //         foreach ($values as $value)
                //         {
                //             return $value;
                //         }
                        
                //     }
                // ],
                'requirement',
            ],
        ]) ?>
    </div>

</div>
