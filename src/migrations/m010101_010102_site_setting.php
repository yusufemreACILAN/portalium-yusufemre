<?php

use yii\db\Migration;
use portalium\yusufemre\models\Form;
use Yii;
use yii\helpers\ArrayHelper;

class m010101_010102_yusufemre_setting extends Migration
{
    public function up()
    {
        $roles = ArrayHelper::map(
            Yii::$app->authManager->getRoles(),
            'name',
            'name'
        );

        $this->insert('yusufemre_setting', [
            'module' => 'yusufemre',
            'name' => 'default::role',
            'label' => 'Default Role',
            'value' => 'admin',
            'type' => Form::TYPE_DROPDOWNLIST,
            'config' => json_encode([
                'model' => [
                    'class' => 'portalium\yusufemre\models\DbManager', 
                    'map' => [
                        'key' => 'name' ,
                        'value' => 'name'
                    ]
                ]
            ])
        ]);

        $this->insert('yusufemre_setting', [
            'module' => 'yusufemre',
            'name' => 'admin::user_role',
            'label' => 'Default User Role',
            'value' => '0',
            'type' => Form::TYPE_DROPDOWNLIST,
            'config' => json_encode([
                'model' => [
                    'class' => 'portalium\yusufemre\models\DbManager', 
                    'map' => [
                        'key' => 'name' ,
                        'value' => 'name'
                    ]
                ]
            ])
        ]);
    }

    public function down()
    {
        $this->dropTable('yusufemre_setting');
    }
}
