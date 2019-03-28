<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\FundingSource */

$this->title = 'Update Funding Source: '.$model->description;
// $this->params['breadcrumbs'][] = ['label' => 'Funding Sources', 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->description, 'url' => ['view', 'id' => $model->id]];
// $this->params['breadcrumbs'][] = 'Update';
?>
<div class="funding-source-update">

    <div class="form-wrapper">
		<div class="form-title">
			Update <?= $model->description ?>
			<?= Html::a('&times;', ['/funding-source/index'], ['class' => 'close-button']) ?>
		</div>
		<div style="padding: 15px;">
		    <?= $this->render('_form', [
		        'model' => $model,
		    ]) ?>
		</div>
	</div>

</div>
