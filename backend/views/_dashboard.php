<?php

use yii\widgets\ActiveForm;
use dosamigos\chartjs\ChartJs;
use kartik\select2\Select2;
use backend\models\OperatingUnit;
use yii\helpers\ArrayHelper;
use backend\models\Obligations;
use yii\helpers\Html;

$this->title = 'Financial Performance Monitoring';

?>
<style type="text/css">
	 .help-block{
        margin: 0px !important;
    }
    .form-group{
        margin: 0px !important;
    }
    .form-control
    {
        height: 34px;
    }

    #app {
  padding: 5px 0;
}
.timeline {
  margin: 5px 0;
  list-style-type: none;
  display: flex;
  padding: 0;
  text-align: center;
}
.timeline li {
  transition: all 200ms ease-in;
}
.timestamp {
  width: 200px;
  margin-bottom: 10px;
  padding: 5px;
  display: flex;
  text-align: center;
  flex-direction: column;
  align-items: center;
  font-weight: 100; 
}
.status {
  display: flex;
  justify-content: center;
  border-top: 4px solid #fff;
  position: relative;
  transition: all 200ms ease-in;
  text-align: center;
}
  
.status span {
  font-weight: 600;
  padding-top: 16px;
}
.status span:before {
  content: '';
  width: 25px;
  height: 25px;
  background-color: #e8eeff;
  border-radius: 25px;
  border: 4px solid #b3b300;
  position: absolute;
  top: -15px;
  left: 42%;
  transition: all 200ms ease-in;
}
.swiper-control {
  text-align: right;
}

.swiper-container {
  width: 100%;
  height: 140px;
  margin: 5px 0;
  overflow: auto;
  padding: 0 5px 5px 5px;
}
.swiper-slide {
  width: 200px;
  text-align: center;
  font-size: 12px;
  display: inline;
}

</style>

<div class="ors-view">
    <?php $form = ActiveForm::begin(); ?>

     <div style="color: #fff; border-bottom: solid 2px #fff; text-align: right; padding-top: 13px;">
        <h3>FINANCIAL PERFORMANCE MONITORING FOR FUND TRANSFER</h3>
    </div>
    <table style="width: 45%;">
        <tr>
            <td style="padding: 1px;">
                <?php if(Yii::$app->user->identity->region == 'Central Office') : ?>
                      <?= $form->field($model, 'operating_unit')->widget(Select2::classname(), [
                            'data' => ArrayHelper::map(OperatingUnit::find()
                                    ->all(),'abbreviation', 'abbreviation') + ['All' => 'All - Consolidated'],
                            'options' => [
                                'prompt' => 'Select Oprating Unit', 
                                'multiple' => false],
                            'pluginOptions' => [
                                'tags' => true,
                                'tokenSeparators' => [';'],
                            ],
                            ])->label(false);
                        ?>
                <?php else : ?>
                    <?= $form->field($model, 'operating_unit')->textInput(['value' => Yii::$app->user->identity->region, 'readOnly' => true])->label(false) ?>
                <?php endif ?>
            </td>
            <td style="padding: 1px;">
                <?= $form->field($model, 'ors_year')->widget(Select2::classname(), [
                        'data' => ArrayHelper::map(Obligations::find()
                                ->groupBy(['ors_year'])
                                ->orderBy(['ors_year' => SORT_DESC])
                                ->all(),'ors_year', 'ors_year'),
                        'options' => [
                            'prompt' => 'Year of Obligation', 
                            'multiple' => false],
                        ])->label(false);
                    ?>
            </td>
            <td>
                <?= Html::submitButton('Generate', ['class' => 'btn btn-success']) ?>
            </td>
        </tr>
    </table>
    <br>
    <h4 style="color: #404040">ACCUMULATED OBLIGATIONS OVER THE YEARS</h4>
    <div id="app" class="container" style="font-size: 10px;">
	  <div class="row">
	    <div class="col-md-12">
	      <div class="swiper-container">
	        <div class="swiper-wrapper timeline">

	        <?php foreach ($years as $key => $value): ?>
	        	<div class="swiper-slide" v-for="item in steps">
		            <div class="timestamp">
		              <span class="date"><?= $value->ors_year ?><span>
		            </div>
		            <div class="status">
		              <span>
                    <?= '<div style="color: #00cc66; font-size: italic;">Obli. '. number_format($model->getYearlyobligations($value->ors_year, $model->operating_unit), 2).'</div>' ?>
                      
                      <?= '<div style="color: #00a3cc; font-size: italic;">Disb. '. number_format($model->getYearlydisbursements($value->ors_year, $model->operating_unit), 2).'</div>' ?>
                    </span>
                </div>
		          </div>
	        <?php endforeach ?>
	        </div>
	        <?php if($years == null) : ?>
	        <div style="color: #fff; opacity: .5; margin-left: auto; margin-right: auto; font-size: 20px;">
	        		NO DATA ENTRY
	        </div>
	        <?php endif ?>
	        <!-- Add Pagination -->
	        <div class="swiper-pagination"></div>
	      </div>
	    </div>
	  </div>
	</div>

    <div class="row">
    	<div class="col-md-6">
    		<h4 style="color: #404040">TOTAL UNPAID OBLIGATIONS</h4>
			<div style="padding: 5px; background-color: #fff; opacity: .9;"> 
				<?= ChartJs::widget([
		            'type' => 'line',
		            'options' => [
		                'height' => 200,
		                'width' => 400,

		                'scales' => [
	               			'yAxes' => [
	               				'ticks' => [
	               					'beginAtZero' => true,
	               				]
	               			],
	               		]
		            ],
		            'data' => [
		                'labels' => ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sept", "Oct", "Nov", "Dec"],
		                'datasets' => [
		                    [
		                        'label' => "Unpaid Obligations (%)",
		                        'backgroundColor' => "rgba(51, 153, 51,0.65)",
		                        // 'borderColor' => "rgba(179,181,198,1)",
		                        'pointBackgroundColor' => "rgba(255,99,132,1)",
		                        'pointBorderColor' => "#fff",
		                        'pointHoverBackgroundColor' => "#fff",
		                        'pointHoverBorderColor' => "rgba(179,181,198,1)",
		                        'data' => $model->getTotalobligations($model->operating_unit, $model->ors_year),
		                    ],
		                ]
		            ],

		            // 'clientOptions' => [
	            	// 	'scales' => [
	             //   			'yAxes' => [
	             //   				'ticks' => [
	             //   					'beginAtZero' => true,
	             //   				]
	             //   			],
	             //   		]
		            // ],
		        ]);
		        ?>
			</div>
		</div>
		<div class="col-md-6">
			<h4 style="color: #404040">TOTAL UNLIQUIDATED FUNDS</h4>
			<div style="padding: 5px; background-color: #fff; opacity: .9;"> 
				<?= ChartJs::widget([
		            'type' => 'line',
		            'options' => [
		                'height' => 200,
		                'width' => 400
		            ],
		            'data' => [
		                'labels' => ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sept", "Oct", "Nov", "Dec"],
		                'datasets' => [
		                    [
		                        'label' => "Unliquidated Fund (%)",
		                        'backgroundColor' => "rgba(0,153,153,0.65)",
		                        // 'borderColor' => "rgba(255,99,132,1)",
		                        'pointBackgroundColor' => "rgba(255,99,132,1)",
		                        'pointBorderColor' => "#fff",
		                        'pointHoverBackgroundColor' => "#fff",
		                        'pointHoverBorderColor' => "rgba(255,99,132,1)",
		                        'data' => $model->getTotalliquidations($model->operating_unit, $model->ors_year),
		                    ]
		                ]
		            ]
		        ]);
		        ?>
			</div>
		</div>
	</div>
    <?php ActiveForm::end(); ?>
</div>

<script>
	const data = [
		  { dateLabel: 'January 2017', title: 'Gathering Information' },
		  { dateLabel: 'February 2017', title: 'Planning' },
		  { dateLabel: 'March 2017', title: 'Design' },
		  { dateLabel: 'April 2017', title: 'Content Writing and Assembly' },
		  { dateLabel: 'May 2017', title: 'Coding' },
		  { dateLabel: 'June 2017', title: 'Testing, Review & Launch' },
		  { dateLabel: 'July 2017', title: 'Maintenance' }
		];

new Vue({
  el: '#app', 
  data: {
    steps: data,
  },
  mounted() {
    var swiper = new Swiper('.swiper-container', {
      //pagination: '.swiper-pagination',
      slidesPerView: 4,
      paginationClickable: true,
      grabCursor: true,
      paginationClickable: true,
      nextButton: '.next-slide',
      prevButton: '.prev-slide',
    });    
  }
})
</script>