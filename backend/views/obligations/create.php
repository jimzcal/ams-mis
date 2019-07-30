<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Obligations */

$this->title = 'New Obligations';
// $this->params['breadcrumbs'][] = ['label' => 'Obligations', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="obligations-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
