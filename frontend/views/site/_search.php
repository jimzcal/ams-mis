<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
// Yii::setAlias('@path', '/ams/frontend/web');
//echo Url::to('@path');

$this->title = 'Search DV';
?>
<!-- <script async src="//jsfiddle.net/Mottie/MK947/1837/embed/"></script> -->
<div class="site-index">
    <div class="body-content">
        <div class="row">
            <?php $form = ActiveForm::begin(); ?>
                <div class="search">
                    <?= Html::img('@web/images/status-of-claims.png', ['alt'=>'Search', 'class' => 'search-logo', 'style' => 'width: 40%;']);?>
                    <div class="input-group col-md-12">
                       <input type="text" name="dv_no" class="search-query form-control" placeholder="Enter DV Tracking No." autocomplete="off" autofocus = true style="height: 35px;">
                        <span class="input-group-btn">
                        <?= Html::submitButton('<span class="glyphicon glyphicon-search"></span> Search', ['class' => 'btn btn-primary']) ?>
                        </span>
                        <?= Yii::$app->session->getFlash('error'); ?>
                    </div>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

<script type="text/javascript">
   
//     $('#keyboard').keyboard({
//         layout: 'qwerty',
//         css: {
//             // input & preview
//             input: 'form-control input-sm',
//             // keyboard container
//             container: 'center-block dropdown-menu', // jumbotron
//             // default state
//             buttonDefault: 'btn btn-default',
//             // hovered button
//             buttonHover: 'btn-primary',
//             // Action keys (e.g. Accept, Cancel, Tab, etc);
//             // this replaces "actionClass" option
//             buttonAction: 'active',
//             // used when disabling the decimal button {dec}
//             // when a decimal exists in the input area
//             buttonDisabled: 'disabled'
//         }
//     })

//     .addTyping({
//     showTyping: true,
//     delay: 50
// });
</script>