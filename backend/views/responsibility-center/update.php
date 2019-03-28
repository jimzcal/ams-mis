<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ResponsibilityCenter */

$this->title = 'Update Responsibility Center: '.$model->description;
// $this->params['breadcrumbs'][] = ['label' => 'Responsibility Centers', 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->description, 'url' => ['view', 'id' => $model->id]];
// $this->params['breadcrumbs'][] = 'Update';
?>
<div class="responsibility-center-update">

    <div class="form-wrapper">
		<div class="form-title">
			Update <?= $model->description ?>
			<?= Html::a('&times;', ['/responsibility-center/index'], ['class' => 'close-button']) ?>
		</div>
		<div style="padding: 15px;">
		    <?= $this->render('_form', [
		        'model' => $model,
		    ]) ?>
		</div>
	</div>

</div>
