<?php

namespace portalium\yusufemre;

use Yii;
use portalium\user\Module as UserModule;
use portalium\yusufemre\components\TaskAutomation;

class Module extends \portalium\base\Module
{
    const EVENT_ON_LOGIN = 'yusufemreAfterLogin';
    const EVENT_ON_SIGNUP = 'yusufemreAfterSignup';

    public $apiRules = [
        [
            'class' => 'yii\rest\UrlRule',
            'controller' => [
                'yusufemre/auth',
            ]
        ],
    ];

    public static $tablePrefix = 'yusufemre_';

    public function getMenuItems(){
        $menuItems = [
            [
                [
                    'menu' => 'web',
                    'type' => 'widget',
                    'label' => 'portalium\yusufemre\widgets\LoginButton',
                    'name' => 'Login',
                ],
                [
                    'menu' => 'web',
                    'type' => 'widget',
                    'label' => 'portalium\yusufemre\widgets\Language',
                    'name' => 'Language',
                ],
                [
                    'menu' => 'web',
                    'type' => 'action',
                    'route' => '/yusufemre/setting/index',
                ]
            ],
        ];
        return $menuItems;
    }

    public static function moduleInit()
    {
        self::registerTranslation('yusufemre','@portalium/yusufemre/messages',[
            'yusufemre' => 'yusufemre.php',
        ]);
    }

    public function registerComponents()
    {
        return [
            'theme' => [
                'class' => 'portalium\theme\Theme',
            ],
            'setting' => [
                'class' => 'portalium\yusufemre\components\Setting',
            ]
        ];
    }

    public static function t($message, array $params = [])
    {
        return parent::coreT('yusufemre', $message, $params);
    }

    public static function settingT($category, $message, array $params = [])
    {
        self::registerTranslation($category,'@portalium/'. $category .'/messages',[
            $category => $category.'.php',
        ]);

        return parent::coreT($category, $message, $params);
    }

    public function registerEvents()
    {
        Yii::$app->on(UserModule::EVENT_USER_CREATE, [new TaskAutomation(), 'onUserCreate']);
        Yii::$app->on(self::EVENT_ON_SIGNUP, [new TaskAutomation(), 'onUserCreate']);
    }
}
