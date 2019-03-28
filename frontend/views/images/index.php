<?php

use yii\helpers\Html;
use yii\grid\GridView;
use himiklab\thumbnail\EasyThumbnailImage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ImagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Images';
$count = 1;
$baseUrl = Yii::getAlias('@mBackend/images');
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="images-index">

    <div style="color: #fff; border-bottom: solid 2px #fff; text-align: right; padding-top: 1%; padding-right: 20px; position: relative; padding-top: 13px;">
        <h3>CITIZEN'S CHARTER</h3>
    </div>

    <div style="padding: 10px; width: 88%; margin-left: auto; margin-right: auto;">
        <div class="row">
            <?php foreach($model as $image) :?>
                <div class="album-gallery" style="vertical-align: top;">
                    <?= Html::img('@mBackend/images/'.$image->name, ['alt' => 'accounting-image', 'onclick'=>'openModal('.$count++.')' ]);?>
                    <div class="desc">
                        <?= $image->name; ?>
                    </div>
              </div>
            <?php endforeach ?>
        </div>
    </div>
</div>

<div id="myModal" class="modall">
  <div class="modal-content-gallery" id="myContent">
    <?php foreach($model as $image) :?>
        <div class="mySlides">
            <div class="text">
                <?= $image->name; ?>
                <span class="close" onclick="closeModal()">&times;</span>
            </div>
                <?= Html::img('@mBackend/images/'.$image->name);?>
        </div>
    <?php endforeach ?>    
  <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
  <a class="next" onclick="plusSlides(1)">&#10095;</a>    
  </div>
</div>

<script>
    function openModal(n) {
      document.getElementById('myContent').style.display = "block";
      document.getElementById('myModal').style.display = "block";
      showSlides(slideIndex = n);
    }

    function closeModal() {
      document.getElementById('myModal').style.display = "none";
      document.getElementById('myContent').style.display = "none";
    }

    var slideIndex = 1;
    showSlides(slideIndex);

    function plusSlides(n) {
      showSlides(slideIndex += n);

    }

    function currentSlide(n) {  

    }

    function showSlides(n) {
      var i;
      var slides = document.getElementsByClassName("mySlides");
      var dots = document.getElementsByClassName("demo");
      var captionText = document.getElementById("caption");
      if (n > slides.length)
      {
          slideIndex = 1
      }

      if (n < 1)
      {
        slideIndex = slides.length
      }


      for (i = 0; i < slides.length; i++)
      {
          slides[i].style.display = "none";
      }


      for (i = 0; i < dots.length; i++)
      {
          dots[i].className = dots[i].className.replace(" active", "");
      }

      slides[slideIndex-1].style.display = "block";
      dots[slideIndex-1].className += " active";
      captionText.innerHTML = dots[slideIndex-1].alt;
    }
</script>
