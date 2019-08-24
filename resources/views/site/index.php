<?php

/* @var $this yii\web\View */

use yii\bootstrap\Carousel;
use yii\bootstrap\Html;

$urlManager = Yii::$app->getUrlManager();

$this->title = Yii::t('app', 'Home');
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Congratulation!</h1>
    </div>
    <p class="lead text-center">You have set up Yii2 and Vue application successfully.</p>
    <p class="text-center">
        <a class="btn btn-primary" href="https://github.com/razonyang/yii2-app-template" role="button">Yii2 App Template</a>
        <a class="btn btn-primary" href="https://github.com/razonyang/yii2-vue-admin" role="button">Yii2 Vue Admin</a>
    </p>

    <?= Carousel::widget([
        'controls' => [
            '<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span><span class="sr-only">Previous</span>',
            '<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span><span class="sr-only">Next</span>'
        ],
        'items' => [
            [
                'content' => Html::img($urlManager->createUrl(['/img/yii2-app.gif'])),
                'caption' => '<h4 class="text-primary">Install Yii2 Application via Docker</h4>',
                'options' => [],
            ],
            [
                'content' => Html::img($urlManager->createUrl(['/img/yii2-vue.gif'])),
                'caption' => '<h4 class="text-primary">Install Yii2 Vue Admin</h4>',
                'options' => [],
            ],
        ],
        'clientOptions' => [
            'interval' => false,
        ],
    ]) ?>

</div>
