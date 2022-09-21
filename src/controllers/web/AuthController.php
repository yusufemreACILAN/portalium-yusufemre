<?php

namespace portalium\yusufemre\controllers\web;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use portalium\web\Controller as WebController;
use portalium\yusufemre\Module;
use portalium\yusufemre\models\LoginForm;
use portalium\yusufemre\models\PasswordResetRequestForm;
use portalium\yusufemre\models\ResetPasswordForm;
use portalium\yusufemre\models\SignupForm;
use portalium\yusufemre\models\Setting;

class AuthController extends WebController
{
    public $layout = '@portalium/theme/layouts/main';

    public function actions()
    {
        return [
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ]
        ];
    }

    public function actionIndex()
    {
        return $this->redirect('login');
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    public function actionSignup()
    {
        if (Setting::findOne(['name' => 'form::signup'])->value) {
            $model = new SignupForm();
            if ($model->load(Yii::$app->request->post())) {
                if ($user = $model->signup()) {
                    if (Yii::$app->getUser()->login($user)) {
                        return $this->goHome();
                    }
                }
            }
            return $this->render('signup', [
                'model' => $model,
            ]);
        }

        return $this->goHome();
    }

    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', Module::t('Check your email for further instructions.'));
                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', Module::t('Sorry, we are unable to reset password for the provided email address.'));
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', Module::t('New password saved.'));

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
