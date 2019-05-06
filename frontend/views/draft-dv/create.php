<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\DraftDv */

$this->title = 'Create Draft Dv';
// $this->params['breadcrumbs'][] = ['label' => 'Draft Dvs', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="draft-dv-create">

    <div style="color: #fff; border-bottom: solid 2px #fff; text-align: right; margin-top: 3%;" id="no-print">
        <h3>DRAFT DISBURSEMENT VOUCHER</h3>
    </div>
    <br><br>
    <div class="row">
    	<div class="col-md-9">
		    <?= $this->render('_form', [
		        'model' => $model,
		    ]) ?>
		</div>
	</div>

</div>
