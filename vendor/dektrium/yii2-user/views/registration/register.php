<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var dektrium\user\models\User $model
 * @var dektrium\user\Module $module
 */

$this->title = Yii::t('user', 'Sign up');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row" style="margin-top: 90px;">
    <?= Html::img('@web/images/da-ams-logo.png', ['alt'=>'DA-AMS Logo', 'style' => 'margin-left: auto; margin-right: auto; width: 160px; display: block;']); ?>
    <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
        <div class="panel panel-default" style="border: solid 1px #2a2b43">
            <div class="panel-heading" style="background-color: #2a2b43; color: #FFFFFF">
                <h3 class="panel-title"><i class="glyphicon glyphicon-edit"></i> <?= Html::encode($this->title) ?></h3>
            </div>
            <div class="panel-body">
                <p style="font-size: 11px; font-style: italic;">Provide here your login account. After the successful sign-up, you are required to update your profile information by clicking the user icon on the top menu bar.</p>
                <?php $form = ActiveForm::begin([
                    'id' => 'registration-form',
                    'enableAjaxValidation' => true,
                    'enableClientValidation' => false,
                ]); ?>

                <?= $form->field($model, 'region')->dropDownList(
                    [
                        'NCR' => 'NCR - National Capital Region',
                        'Region I' => 'Region I - Ilocos Region',
                        'CAR' => 'CAR - Cordillera Administrative Region',
                        'Region II' => 'Region II - Cagayan Valley Region',
                        'Region III' => 'Region III - Central Luzon',
                        'Region IV-A' => 'Region IV-A : CALABARZON',
                        'MIMAROPA Region' => 'MIMAROPA Region - Southwestern Tagalog Region',
                        'Region V' => 'Region V - Bicol Region',
                        'Region VI' => 'Region VI - Western Visayas',
                        'Region VII' => 'Region VII - Central Visayas',
                        'Region VIII' => 'Region VIII - Estern Visayas',
                        'Region IX' => 'Region IX - Zamboanga Peninsula',
                        'Region X' => 'Region X - Northern Mindanoa',
                        'Region XI' => 'Region XI - Davao Region',
                        'Region XII' => 'Region XII - SOCCSKSARGEN Region',
                        'Region XIII' => 'Region XIII - CARAGA Region',
                        'ARMM' => 'ARMM - Autonomous Region of Muslim Mindanao',
                    ],
                      [
                          'prompt'=>'Select Region',
                      ]); 
                  ?>

                <?= $form->field($model, 'fullname') ?> 

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'username') ?>

                <?php if ($module->enableGeneratingPassword == false): ?>
                    <?= $form->field($model, 'password')->passwordInput() ?>
                <?php endif ?>

                <?= Html::submitButton(Yii::t('user', 'Sign up'), ['class' => 'btn login-button']) ?>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
        <p class="text-center">
            <?= Html::a(Yii::t('user', 'Already registered? Sign in!'), ['/user/security/login']) ?>
        </p>
    </div>
</div>
