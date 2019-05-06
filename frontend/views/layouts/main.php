<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use dektrium\rbac\models\Role;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale = 1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode('DA-AMS '.$this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="wrap">
    <?= Html::img('@web/images/title_banner2.png', ['alt'=>'ams-icon', 'class' => 'title-banner', 'id' => 'no-print']);?>
 
    <div class="top-banner" id="no-print">
        <?= Html::a(Html::img('@web/images/citizen_charter.png', ['alt'=>'ams-icon', 'class' => 'icon-image', 'data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'title' => 'Citizens Charter']), ["/images/index"]) ?>
        <?= Html::a(Html::img('@web/images/dv.png', ['alt'=>'ams-icon', 'class' => 'icon-image', 'data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'title' => 'Transaction Requirements']), ["/transaction/index"]) ?>
        <?= Html::a(Html::img('@web/images/transactions.png', ['alt'=>'ams-icon', 'class' => 'icon-image', 'data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'title' => 'Draft DV']), ["/draft-dv/create"]) ?>
        <?= Html::a(Html::img('@web/images/search_dv.png', ['alt'=>'ams-icon', 'class' => 'icon-image', 'data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'title' => 'Search DV']), ["/site/search"]) ?>
        <?= Html::a(Html::img('@web/images/home.png', ['alt'=>'ams-icon', 'class' => 'icon-image', 'data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'title' => 'Go to home']), ["/site/index"]) ?>
    </div>
    <div class="content-wrapper">
            <span style="position: absolute; margin-top: 60px; z-index: 1000; width: 95%; margin-right: auto; margin-left: auto; display: block;"><?= Alert::widget(); ?></span>
            <?= $content ?>
    </div>
</div>
<div style="bottom: 0; background-color: #000000; height: 15%px; width: 100%; color: #ffffff; font-size: 80%; position: fixed;" id="noprint">
    <marquee>Work in progress............. Work in progress...</marquee>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
