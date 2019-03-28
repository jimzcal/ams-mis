<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-login"> 
    <div style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-5 col-sm-8 col-sm-offset-5">
            <div class="panel panel-default" >
                    <div class="panel-heading">
                        <div class="panel-title"><?= Html::encode($this->title) ?></div>
                        <!-- <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="#">Forgot password?</a></div> -->
                    </div> 

                    <div style="padding-top:30px" class="panel-body" >
                            
                        <!--<form id="loginform" class="form-horizontal" role="form"> -->
                            <?php $form = ActiveForm::begin(['id' => 'login-form', 'class'=>'form-horizontal'] ); ?>
                                    
                            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                            <?= $form->field($model, 'password')->passwordInput() ?>

                            <?= $form->field($model, 'rememberMe')->checkbox() ?>

                            <div class="form-group">
                                <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                            </div>
                            
                            <!--</form> -->    
                            <?php ActiveForm::end(); ?>

                    </div>                     
            </div>  
    </div>
</div>