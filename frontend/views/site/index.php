<?php

use frontend\models\Images;
use sjaakp\cycle\Cycle;
use yii\helpers\Html;
use yii\bootstrap\Carousel;
use yii\helpers\Url;

/* @var $this yii\web\View */
$exec = exec("hostname");
$hostname = trim($exec);
$ip = gethostbyname($hostname);

$baseUrl2 = Yii::getAlias('@web/images/online');
$this->title = 'Home';
?>
<?php // 'Client Computer Name: '. php_uname('n'); ?>
<?php// if($hostname == 'ams-accounting') : ?>
    <div class="row">
        <div class="site-index">
            <div style="color: #fff; border-bottom: solid 2px #fff; text-align: right; padding-top: 1%; padding-right: 20px; position: relative; padding-top: 13px;">
                <h3>CITIZEN'S CHARTER</h3>
            </div>
            <div class="gallery gallery-portrait">
                <?= Cycle::widget([
                    'dataProvider' => $dataProvider,
                    'imgAttribute' => function($data){

                            $baseUrl = Yii::getAlias('@mBackend/images');
                            return $baseUrl.'/'.$data->name;
                        },
                    'options' => [
                        'speed' => 3000,
                        'fx' => 'tileSlide',
                        'tileCount' => 18,
                        'tileVertical' => true,
                        'timeout' => 16000,
                    ],
                ]) ?>
            </div>

            <div class="gallery-online gallery-landscape">
                <!-- <h1>Test - Display this if the display-screen is on landsacape mode.</h1> -->
                <?=
                    Carousel::widget([
                        'items' => [
                           // the item contains only the image
                            // '<img src="http://twitter.github.io/bootstrap/assets/img/bootstrap-mdo-sfmoma-01.jpg"/>',
                            // // equivalent to the above
                            // ['content' => '<img src="@mBackend/images/online/Process Flow for Airfare (Under special agreement with airlines).png"/>'],
                            // // the item contains both the image and the caption
                            [
                                'content' => Html::img(URL::to('@web/images/online/front-page.png')),
                            ],
                            [
                                'content' => Html::img(URL::to('@web/images/online/vision and mission.png')),
                            ],
                            [
                                'content' => Html::img(URL::to('@web/images/online/general functions.png')),
                            ],
                            [
                                'content' => Html::img(URL::to('@web/images/online/specific functions.png')),
                            ],
                            [
                                'content' => Html::img(URL::to('@web/images/online/Process Flow for the issuance of Advice to Debit Account.png')),
                            ],
                            [
                                'content' => Html::img(URL::to('@web/images/online/Process Flow for Airfare (Under special agreement with airlines).png')),
                            ],
                            [
                                'content' => Html::img(URL::to('@web/images/online/Process Flow for Validation of Bank Acc. & Letter of Intent.png')),
                            ],
                            [
                                'content' => Html::img(URL::to('@web/images/online/Process Flow of Disbursement Vouchers.png')),
                            ],
                            [
                                'content' => Html::img(URL::to('@web/images/online/Process Flow of Liquidation Report.png')),
                            ],
                            [
                                'content' => Html::img(URL::to('@web/images/online/Process Flow to secure Certificate of Availability of Funds.png')),
                            ],
                        ]
                    ]);
                ?>
            </div>
        </div>
    </div>
<script>

// window.onload = function(){
//     if (window.height < window.width){
//         alert("Display in portrait");
//     }
// }
</script>

