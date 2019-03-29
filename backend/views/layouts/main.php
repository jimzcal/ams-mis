<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\bootstrap\BootstrapAsset;
use yii\widgets\Breadcrumbs;
use yii\widgets\Menu;
use backend\models\CashAdvance;
use common\widgets\Alert;
use dektrium\rbac\models\Role;
use yii\bootstrap\Dropdown;
use yii\helpers\ArrayHelper;

AppAsset::register($this);
//rmrevin\yii\fontawesome\AssetBundle::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php $this->registerLinkTag(['rel' => 'icon', 'type' => 'image/png', 'href' => '@mBackend/images/ams.png']) ?>
    
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode('AMS - '.$this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <div id="noprint">
        <?= Html::img('@web/images/title_banner2.png', ['alt'=>'ams-icon', 'class' => 'title-banner']);?>
        <?php if(!Yii::$app->user->isGuest) : ?>
            <div class="top-banner">
                <?= Html::a(Html::img('@web/images/login.png', ['alt'=>'ams-icon', 'class' => 'icon-image', 'data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'title' => 'Logout']), ["site/logout"], ['data' => ['method' => 'post']]) ?>
                <?= Html::a(Html::img('@web/images/user.png', ['alt'=>'ams-icon', 'class' => 'icon-image', 'data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'title' => 'User Account']), ["/site/index"]) ?>
                <?= Html::a(Html::img('@web/images/citizen_charter.png', ['alt'=>'ams-icon', 'class' => 'icon-image', 'data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'title' => 'Citizens Charter']), ["/images/index"]) ?>
                <?= Html::a(Html::img('@web/images/dv.png', ['alt'=>'ams-icon', 'class' => 'icon-image', 'data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'title' => 'Transaction Requirements']), ["/transaction/index"]) ?>
                <?= Html::a(Html::img('@web/images/urs.png', ['alt'=>'ams-icon', 'class' => 'icon-image', 'data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'title' => 'Fund Transfer']), ["/project/index"]) ?>
                <?= Html::a(Html::img('@web/images/transactions.png', ['alt'=>'ams-icon', 'class' => 'icon-image', 'data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'title' => 'Disbursement']), ["/disbursement/index"]) ?>
                <?= Html::a(Html::img('@web/images/home.png', ['alt'=>'ams-icon', 'class' => 'icon-image', 'data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'title' => 'Go to home']), ["/site/index"]) ?>
            </div>
        <?php endif ?>
    </div>
<!--body-->
    <div class="content-wrapper">
        <?php
            $exec = exec("hostname"); //the "hostname" is a valid command in both windows and linux
            $hostname = trim($exec); //remove any spaces before and after
            $ip = gethostbyname($hostname);

            //echo gethostbyaddr($_SERVER['REMOTE_ADDR']);
            //echo php_uname('n');
        ?>
            <?php 
                if (!Yii::$app->user->isGuest) {
                    echo Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                                ]);
                        }
            ?>
            <div style="width: 60%; margin-right: auto; margin-left: auto;">
                <?= Alert::widget() ?>
            </div>
            
            <?php // date("Y-M-d") ?>
            <?php //$diff = date_diff(date_create(date("Y-M-d", $notifications->due_date)), date_create(date("Y-M-d"))); ?>
            <?php //$diff->format('%d') ?>
            <?= $content ?>
    </div>
    <div class="footer" id="noprint">
        <p>
            <?= date('l').' - '; ?> <?= date('M. d, Y').' | '; ?>
            <?php if(!Yii::$app->user->isGuest)
                { 
                    echo 'Logged: '.Yii::$app->user->identity->fullname. ' - ' .Yii::$app->user->identity->region;
                } 
            ?>
        </p>

    </div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>