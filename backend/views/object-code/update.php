<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ObjectCode */

$this->title = 'Update Object Code: '.$model->description;
// $this->params['breadcrumbs'][] = ['label' => 'Object Codes', 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->description, 'url' => ['view', 'id' => $model->id]];
// $this->params['breadcrumbs'][] = 'Update';
?>
<div class="object-code-update">

	<div class="form-wrapper">
		<div class="form-title">
			Update <?= $model->description ?>
			<?= Html::a('&times;', ['/object-code/index'], ['class' => 'close-button']) ?>
		</div>
		<div style="padding: 15px;">
		    <?= $this->render('_form', [
		        'model' => $model,
		    ]) ?>
		</div>
	</div>
</div>
