<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\export\ExportMenu;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\ObjectCodeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Object Codes';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="object-code-index">

    <div class="right-top-button">
        <div class="right-button-text" data-toggle="modal" data-target="#newModal">
            <i class="glyphicon glyphicon-plus"></i> Object Code</div>
    </div>

    <div class="new-title">
        <i class="fa fa-qrcode" aria-hidden="true"></i> 
        <?= Html::encode($this->title) ?>
    </div>
    <?php Pjax::begin(); ?>

    <div style=" padding: 0; width: 88%; margin-left: auto; margin-right: auto; display: block;">
        <div class="row">
            <div class="col-md-8">
                <?php echo $this->render('_search', ['model' => $searchModel]); ?>
            </div>
            <div class="col-md-4">
                <div style="float: right;">
                    <?php /* ExportMenu::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            'description',
                            'uacs',
                        ],
                    ]); */
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="view-index">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'description',
                'uacs',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>
    <?php Pjax::end(); ?>
</div>

<div id="newModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
         <h4 class="modal-title">New Object Code</h4>
      </div>
      <div class="modal-body">
          <?= $this->render('_form', [
                'model' => $model,
           ]) ?>
      </div>
    </div>
  </div>
</div>