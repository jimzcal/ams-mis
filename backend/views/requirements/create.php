<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;


/* @var $this yii\web\View */
/* @var $model backend\models\Requirements */

$this->title = 'Requirement';
// $this->params['breadcrumbs'][] = ['label' => 'Requirements', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="requirements-create">
  <?= Yii::$app->session->getFlash('error'); ?>

  <div style="color: #fff; border-bottom: solid 2px #fff; text-align: right; padding-top: 13px;">
        <h3>New Requirement</h3>
    </div>
    <div class="btn btn-primary" data-toggle="modal" data-target="#myModal">New Requirement</div><br><br>

  <div class="new-title">
    <p style="text-indent: 28px; font-size: 14px; color: #fff;">These are the list of common requirements which canbe selected during the creation of transaction</p>
  </div>

  <div style=" padding: 0; width: 99%; margin-left: auto; margin-right: auto; display: block;">
      <?php echo $this->render('_search', ['model' => $searchModel]); ?>
  </div>
    
	<?= $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]); ?>
</div>


<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
         <h4 class="modal-title">New Requirement</h4>
      </div>
      <div class="modal-body">
		  <?= $this->render('_form', [
		        'model' => $model,
		   ]) ?>
      </div>
    </div>
  </div>
</div>

<!-- <script>
  
(function()
{
  if( window.localStorage )
  {
    if( !localStorage.getItem('firstLoad') )
    {
      localStorage['firstLoad'] = true;
      window.location.reload();
    }  
    else
      localStorage.removeItem('firstLoad');
  }
})();
</script> -->
