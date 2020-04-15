<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \common\models\forms\LoginForm */

use yii\authclient\widgets\AuthChoice;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = Yii::t('app', 'Вход');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="row">
        <div class="col-lg-5">
        <?= Html::label(Yii::t('app', 'Войти через: '), null, ['class' => 'control-label']) ?>
            <?= AuthChoice::widget(['baseAuthUrl' => ['site/auth']]) ?>
        </div>
    </div>
    <p>
        <?= Yii::t('app', 'или') ?>
    </p>
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
            <?= $form->field($model, 'password')->passwordInput() ?>
            <?= $form->field($model, 'rememberMe')->checkbox() ?>
            <div style="color:#999;margin:1em 0">
                <?= Yii::t('app', 'Если вы забыли пароль вы можете') ?>
                <?= Html::a(Yii::t('app', 'сбросить его'), ['site/request-password-reset']) ?>.
            </div>
            <div class="form-group">
                <?= Html::submitButton(Yii::t('app', 'Вход'), ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
