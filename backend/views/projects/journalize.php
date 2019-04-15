<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Projects */

$this->title = 'Journalize Project';
// $this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="projects-create">
	
    <?= $this->render('_journalize', [
        'model' => $model,
        'new_model' => $new_model,
    ]) ?>

</div>
