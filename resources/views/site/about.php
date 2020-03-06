<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = Yii::t('app', 'About Us');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
</div>
<ul>
    <li>
        <a href="https://github.com/razonyang/yii2-app-template" target="_blank">GitHub repository</a>
    </li>
    <li>
        <a href="https://github.com/razonyang/yii2-app-template/issues/new" target="_blank">File an issue or request a new feature</a>
    </li>
    <li>
        <?= Html::mailto('Send me an email', Yii::$app->params['supportEmail']) ?>
    </li>
</ul>