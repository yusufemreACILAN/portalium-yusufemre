<?php

namespace portalium\yusufemre\models;

use yii\db\ActiveRecord;
use portalium\yusufemre\Module;
use portalium\yusufemre\models\Form;

class Setting extends ActiveRecord
{
    public static function tableName()
    {
        return '{{'. Module::$tablePrefix .'setting}}';
    }

    public function rules()
    {
        return [
            [['module','name','label','type'], 'required'],
            [['name', 'value'], 'string', 'max' => 200],
            ['type', 'default', 'value' => Form::TYPE_INPUT],
            ['type', 'in', 'range' => Form::getTypes()],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Module::t('ID'),
            'module' => Module::t('Module'),
            'name' => Module::t('Name'),
            'label' => Module::t('Label'),
            'value' => Module::t('Value'),
            'type' => Module::t('Type'),
            'config' => Module::t('Config')
        ];
    }
}
