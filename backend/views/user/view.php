<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = $model->fullname;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">
    <div class="panel-header-wrapper">
        <h3><span class="glyphicon icon glyphicon-user"></span> <?= Html::encode($this->title) ?></h3>
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

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'fullname',
            'username',
            //'auth_key',
            // 'password_hash',
            // 'password_reset_token',
            'email:email',
            //'status',
            [
                'attribute' => 'status',
                'value' => function($data)
                {
                    return $data->status=='10' ? 'Active' : 'Inactive';
                }
            ],
            // 'created_at',
            // 'updated_at',
            //'role',
            [
                'attribute' => 'role',
                'value' => function($data)
                {
                    return $data->role=='20' ? 'Super Admin' : 'Admin';
                }
            ],
        ],
    ]) ?>

</div>
