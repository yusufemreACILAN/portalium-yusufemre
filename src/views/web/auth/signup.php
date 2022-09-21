<?php

use yii\helpers\Html;
use yii\captcha\Captcha;
use portalium\theme\widgets\ActiveForm;
use portalium\yusufemre\Module;

$this->title = Module::t('Signup');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="yusufemre-signup">
    <h1><?= Html::encode($this->title) ?></h1>
    <p><?= Module::t('Please fill out the following fields to signup:') ?></p>
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
                <?= $form->field($model, 'email') ?>
                <?= $form->field($model, 'password')-> passwordInput() ?>
                <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                    'captchaAction'=>'/yusufemre/auth/captcha'
                ]) ?>
                <div class="form-group">
                    <?= Html::submitButton(Module::t('Signup'), ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
