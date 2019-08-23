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
    <li><strong>Support</strong>: <?= Html::mailto(Yii::$app->params['supportEmail'], Yii::$app->params['supportEmail']) ?></li>
</ul>