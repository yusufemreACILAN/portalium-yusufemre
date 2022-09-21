<?php

use yii\helpers\Html;
use portalium\yusufemre\Module;

$this->title = Module::t('About');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="yusufemre-about">
    <h1><?= Html::encode($this->title) ?></h1>
    <p><?= Module::t('This is the About page. You may modify the following file to customize its content:') ?></p>
    <code><?= __FILE__ ?></code>
</div>
