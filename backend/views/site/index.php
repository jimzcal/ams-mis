<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Nav;
use backend\models\Tblcontent;
use yii\widgets\ActiveForm;

$this->title = 'HOME';
?>
<div class="site-index">
    <div class="row">
    	<?php $form = ActiveForm::begin(); ?>
    		<div class="search">
    			<?= Html::img('@web/images/status-of-claims.png', ['alt'=>'Search', 'class' => 'search-logo']);?>
		        <div class="input-group col-md-12">
		            <input type="text" name="dv_no" class="search-query form-control" placeholder="Enter DV No./Barcode/Tracking Form No." autocomplete="off" autofocus = true style="height: 35px;">
		            <span class="input-group-btn">
		            <?= Html::submitButton('<span class="glyphicon glyphicon-search"></span> Search', ['class' => 'btn btn-primary']) ?>
		            </span>
		            <?= Yii::$app->session->getFlash('error'); ?>
		        </div>
		    </div>
    	<?php ActiveForm::end(); ?>
    </div>
</div>

