<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error">

    <div class="alert alert-danger" style="width: 45%; margin-top: 10%; margin-left: auto; margin-right: auto; border-radius: 5px;">

        <?= Html::img('@web/images/error-icon.png', ['alt'=>'AMS Error-icon', 'style' => 'width: 30%; margin-left: auto; margin-right: auto; display: block;']);?>

        <h1 style="text-align: center;">Ooops! <?= nl2br(Html::encode($message)) ?></h1>
        <!-- <h3 style="text-align: center;"><?= Html::encode($this->title) ?></h3> -->

        <div class="alert alert-danger">
            <p>
                The above error occurred while the Web server was processing your request.
            </p>
            <p>
                Please contact your administrator or your developer if you think this is a server error. Thank you.
            </p>
        </div>

    </div>

</div>
