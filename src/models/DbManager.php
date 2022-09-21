<?php

namespace portalium\yusufemre\models;

use Yii;
use yii\base\Model;
use portalium\yusufemre\Module;
use portalium\yusufemre\model\Setting;
use portalium\user\models\User;

class DbManager extends Model
{
    public $name;
    public $type;
    public $description;


    public function rules()
    {
        return [
            [['name', 'type', 'description'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => Module::t('Name'),
            'type' => Module::t('Type'),
            'description' => Module::t('Description'),
        ];
    }

    public static function find()
    {
        $query = new \yii\db\Query();
        $query->select(['name', 'description'])
            ->from('auth_item')
            ->where(['type' => 1]);
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
        return $query;
    }
}