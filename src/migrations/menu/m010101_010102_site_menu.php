<?php

use portalium\menu\models\Menu;
use portalium\menu\models\MenuItem;
use yii\db\Migration;
use portalium\yusufemre\models\Form;

class m010101_010102_yusufemre_menu extends Migration
{

    public function up()
    {
        $id_menu = Menu::find()->where(['slug' => 'web-menu'])->one()->id_menu;
        $this->batchInsert('menu_item', ['id_item', 'label', 'slug', 'type', 'style', 'data', 'sort', 'id_parent', 'id_menu', 'name_auth', 'date_create', 'date_update'], [
            [NULL, 'Settings', 'setting', '2', '{"icon":"","color":"","iconSize":""}', '{"type":"2","data":{"module":"yusufemre","routeType":"action","route":"\\/yusufemre\\/setting\\/index","model":null,"menuRoute":null,"menuType":"web"}}', '7', '0', $id_menu, 'yusufemreWebSettingIndex', '2022-06-14 13:34:04', '2022-06-14 13:34:04'],
            [NULL, 'Language', 'language', '2', '{"icon":"","color":"","iconSize":""}', '{"type":"2","data":{"module":"yusufemre","routeType":"widget","route":"portalium\\\\yusufemre\\\\widgets\\\\Language","model":null,"menuRoute":null,"menuType":"web"}}', '9', '0', $id_menu, '', '2022-06-14 13:34:36', '2022-06-14 13:34:36'],
            [NULL, 'Login', 'login', '2', '{"icon":"","color":"","iconSize":""}', '{"type":"2","data":{"module":"yusufemre","routeType":"widget","route":"portalium\\\\yusufemre\\\\widgets\\\\LoginButton","model":null,"menuRoute":null,"menuType":"web"}}', '10', '0', $id_menu, '', '2022-06-14 13:35:38', '2022-06-14 13:35:38'],
        ]);
    }

    public function down()
    {

    }
}
