<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\bootstrap\Nav;

/**
 * @var \yii\web\View $this
 * @var \dektrium\user\models\User $user
 * @var string $content
 */

$this->title = Yii::t('user', 'Update Accounts');
// $this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Users'), 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('/_alert', ['module' => Yii::$app->getModule('user')]) ?>

<?php if (Yii::$app->user->can('manageUsers')) : ?>
    <?= $this->render('_menu') ?>
<?php else : ?>
    <br><br><br><br>
<?php endif ?>

<div class="row update-profile">
    <div class="col-md-3">
        <div class="panel panel-default">
            <div class="panel-body">
                <?php if (Yii::$app->user->can('manageUsers')) : ?>
                    <?= Nav::widget([
                        'options' => [
                            'class' => 'nav-pills nav-stacked',
                        ],
                        'items' => [
                            [
                                'label' => Yii::t('user', 'Account details'),
                                'url' => ['/user/admin/update', 'id' => $user->id]
                            ],
                            [
                                'label' => Yii::t('user', 'Profile details'),
                                'url' => ['/user/admin/update-profile', 'id' => $user->id]
                            ],
                            ['label' => Yii::t('user', 'Information'), 'url' => ['/user/admin/info', 'id' => $user->id]],
                            [
                                'label' => Yii::t('user', 'Assignments'),
                                'url' => ['/user/admin/assignments', 'id' => $user->id],
                                'visible' => isset(Yii::$app->extensions['dektrium/yii2-rbac']),
                            ],
                            '<hr>',
                            [
                                'label' => Yii::t('user', 'Confirm'),
                                'url' => ['/user/admin/confirm', 'id' => $user->id],
                                'visible' => !$user->isConfirmed,
                                'linkOptions' => [
                                    'class' => 'text-success',
                                    'data-method' => 'post',
                                    'data-confirm' => Yii::t('user', 'Are you sure you want to confirm this user?'),
                                ],
                            ],
                            [
                                'label' => Yii::t('user', 'Block'),
                                'url' => ['/user/admin/block', 'id' => $user->id],
                                'visible' => !$user->isBlocked,
                                'linkOptions' => [
                                    'class' => 'text-danger',
                                    'data-method' => 'post',
                                    'data-confirm' => Yii::t('user', 'Are you sure you want to block this user?'),
                                ],
                            ],
                            [
                                'label' => Yii::t('user', 'Unblock'),
                                'url' => ['/user/admin/block', 'id' => $user->id],
                                'visible' => $user->isBlocked,
                                'linkOptions' => [
                                    'class' => 'text-success',
                                    'data-method' => 'post',
                                    'data-confirm' => Yii::t('user', 'Are you sure you want to unblock this user?'),
                                ],
                            ],
                            [
                                'label' => Yii::t('user', 'Delete'),
                                'url' => ['/user/admin/delete', 'id' => $user->id],
                                'linkOptions' => [
                                    'class' => 'text-danger',
                                    'data-method' => 'post',
                                    'data-confirm' => Yii::t('user', 'Are you sure you want to delete this user?'),
                                ],
                            ],
                        ],
                    ]) ?>

                <?php elseif (!Yii::$app->user->can('manageUsers')) : ?>
                    <?= Nav::widget([
                        'options' => [
                            'class' => 'nav-pills nav-stacked',
                        ],
                        'items' => [
                            [
                                'label' => Yii::t('user', 'Account details'),
                                'url' => ['/user/admin/update', 'id' => $user->id]
                            ],
                            [
                                'label' => Yii::t('user', 'Profile details'),
                                'url' => ['/user/admin/update-profile', 'id' => $user->id]
                            ],
                            ['label' => Yii::t('user', 'Information'), 'url' => ['/user/admin/info', 'id' => $user->id]
                            ],
                        ],
                    ]) ?>
                <?php endif ?>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="panel panel-default">
            <div class="panel-body">
                <?= $content ?>
            </div>
        </div>
    </div>
</div>
