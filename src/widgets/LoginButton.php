<?php

namespace portalium\yusufemre\widgets;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use portalium\yusufemre\Module;

class LoginButton extends Widget
{
    public function init()
    {
        parent::init();
    }

    public function run()
    {
        if (Yii::$app->user->isGuest) {
            return '<li class="nav-item">' . Html::a(Module::t('Login'), ['/yusufemre/auth/login'], ['class' => 'nav-link']) . '</li>';
        } else {
            return '<li class="nav-item">' . Html::a(Module::t('Logout'). ' (' . Yii::$app->user->identity->username . ')',['/yusufemre/auth/logout'],['class' => 'nav-link']) . '</li>';
        }
    }
}
