<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use himiklab\thumbnail\EasyThumbnailImage;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\ImagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Images';
// $this->params['breadcrumbs'][] = $this->title;
$count = 1;
?>
<div class="images-index">
  <?php $form = ActiveForm::begin(['action' =>['delete'], 'options'=>['enctype'=>'multipart/form-data']]); ?>
    <div class="title">
        <div class="form-group">
          
        </div>

        
    </div>

    <div class="right-top-button">
        <div class="right-button-text" data-toggle="modal" data-target="#newModal">
          <i class="glyphicon glyphicon-plus"></i> Add Image</div> | 
          <?= Html::submitButton('<i class="glyphicon glyphicon-trash"></i> Delete', [
            'class' => 'right-button-text',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </div>

    <div class="new-title">
        <i class="fa fa-file-photo-o"></i> Gallery
        <p style="text-indent: 25px; font-size: 14px;">The images here are displayed also to the Acounting Digital Signage.</p>
    </div>

    <div class="album-form">
        <div class="row">
            <?php foreach($model as $image) :?>
                <div class="album-gallery">
                    <input type="checkbox" name="ids[]" value="<?= $image->id ?>" class="visbox">
                    <?= EasyThumbnailImage::thumbnailImg(
                        $image->url, 
                        230,
                        200,
                        EasyThumbnailImage::THUMBNAIL_OUTBOUND,
                        ['alt' => 'accounting-image', 'onclick'=>'openModal('.$count++.')']
                        );
                    ?>
              </div>
            <?php endforeach ?>
        </div>
    </div>

      <?php ActiveForm::end(); ?>
</div>

<div class="modal-content-gallery" id="myContent">
    <?php foreach($model as $image) :?>
        <div class="mySlides">
            <div class="text">
                <?= $image->name; ?>
                <span class="close" onclick="closeModal()">&times;</span>
            </div>
                <?= Html::img('@web/'.$image->url);?>
        </div>
    <?php endforeach ?>    
<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
<a class="next" onclick="plusSlides(1)">&#10095;</a>    
</div>

<div id="myModal" class="modall">
</div>

<div id="newModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
         <h4 class="modal-title">New Image</h4>
      </div>
      <div class="modal-body">
          <?= $this->render('_form', [
            'model2' => $model2,
                ]) 
            ?>
      </div>
    </div>
  </div>
</div> 

<script>

function openModal(n)
{
  document.getElementById('myContent').style.display = "block";
  document.getElementById('myModal').style.display = "block";
  showSlides(slideIndex = n);
}

function closeModal() 
{
  document.getElementById('myModal').style.display = "none";
  document.getElementById('myContent').style.display = "none";
}

var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) 
{
  showSlides(slideIndex += n);
}

function currentSlide(n) 
{  

}

function showSlides(n) 
{
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

// $(document).on("mouseover", "select[id='albumForm']", function () 
// { 
//   // $('#visbox').show();
//   document.getElementById('visbox').style.display = "block";
// }




</script>