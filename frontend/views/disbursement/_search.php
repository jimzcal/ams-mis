<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */

$this->title = 'Home';
?>
<div class="site-index">
    <div class="row">
        <?php $form = ActiveForm::begin(); ?>
            <div class="search">
                <?= Html::img('@web/images/status-of-claims.png', ['alt'=>'Search', 'class' => 'search-logo']);?>
                <div class="input-group">
                    <input type="text" name="dv_no" class="search-query form-control" id="kboard" placeholder="Enter DV No./Barcode/Tracking Form No." autofocus autocomplete="off">
                    <span class="input-group-btn">
                    <?= Html::submitButton('<span class="glyphicon glyphicon-search"></span> Search', ['class' => 'btn btn-primary']) ?>
                    </span>
                    <?= Yii::$app->session->getFlash('error'); ?>
                </div>
            </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>


<script>

window.onload = function()
{
    $('#kboard').keyboard();
}

</script>
