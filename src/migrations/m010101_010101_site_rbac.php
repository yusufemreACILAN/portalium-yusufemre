<?php
use yii\db\Migration;

class m010101_010101_yusufemre_rbac extends Migration
{
    public function up()
    {
        $auth = Yii::$app->authManager;

        // add "viewUser" permission
        $yusufemreWebSettingIndex = $auth->createPermission('yusufemreWebSettingIndex');
        $yusufemreWebSettingIndex->description = 'yusufemreWebSettingIndex';
        $auth->add($yusufemreWebSettingIndex);

        // add "viewGroup" permission
        $yusufemreWebSettingUpdate = $auth->createPermission('yusufemreWebSettingUpdate');
        $yusufemreWebSettingUpdate->description = 'yusufemreWebSettingUpdate';
        $auth->add($yusufemreWebSettingUpdate);

    }

    public function down()
    {
        $auth = Yii::$app->authManager;
        $auth->remove($auth->getPermission('yusufemreWebSettingIndex'));
        $auth->remove($auth->getPermission('yusufemreWebSettingUpdate'));

    }
}