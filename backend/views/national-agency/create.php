<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\NationalAgency */

$this->title = 'Create National Agency';
// $this->params['breadcrumbs'][] = ['label' => 'National Agencies', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="national-agency-create">
	
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
