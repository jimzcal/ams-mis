<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Ors */

$this->title = 'Create Ors';
// $this->params['breadcrumbs'][] = ['label' => 'Ors', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="ors-create">

    <div style="color: #fff; border-bottom: solid 2px #fff; text-align: right; padding-top: 13px;">
        <h3>OBLIGATION</h3>
    </div>
    <p>
        <?= Html::a('Obligations', ['ors/index'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Projects', ['project/index'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Reports', ['project/index'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
