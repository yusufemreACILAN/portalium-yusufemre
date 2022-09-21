<?php

use portalium\yusufemre\Module;

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['yusufemre/auth/reset-password', 'token' => $user->password_reset_token]);
?>
<?= Module::t('Hello {username},',['username' => $user->username]) ?>
<?= Module::t('Follow the link below to reset your password:') ?>
<?= $resetLink ?>