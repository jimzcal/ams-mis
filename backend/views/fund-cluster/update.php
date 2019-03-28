<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\FundCluster */

$this->title = 'Update Fund Cluster: '.$model->description;
// $this->params['breadcrumbs'][] = ['label' => 'Fund Clusters', 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->description, 'url' => ['view', 'id' => $model->id]];
// $this->params['breadcrumbs'][] = 'Update';
?>
<div class="fund-cluster-update">

    <div class="form-wrapper">
		<div class="form-title">
			Update <?= $model->description ?>
			<?= Html::a('&times;', ['/fund-cluster/index'], ['class' => 'close-button']) ?>
		</div>
		<div style="padding: 15px;">
		    <?= $this->render('_form', [
		        'model' => $model,
		    ]) ?>
		</div>
	</div>

</div>
