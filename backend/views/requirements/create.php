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

  <div class="right-top-button">
        <div class="right-button-text" data-toggle="modal" data-target="#myModal"><i class="glyphicon glyphicon-plus"></i> New Requirement</div>
    </div>

  <div class="new-title">
    <i class="fa fa-tasks" aria-hidden="true"></i> List of Requirements
    <p style="text-indent: 28px; font-size: 14px;">The below requirements will appear to the transaction once selected during the latter's creation.</p>
  </div>

  <div style=" padding: 0; width: 88%; margin-left: auto; margin-right: auto; display: block;">
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
