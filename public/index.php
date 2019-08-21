<?php
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../config/bootstrap.php';
require __DIR__ . '/../config/bootstrap-local.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

$config = yii\helpers\ArrayHelper::merge(
    require __DIR__ . '/../config/common.php',
    require __DIR__ . '/../config/common-local.php',
    require __DIR__ . '/../config/web.php',
    require __DIR__ . '/../config/web-local.php'
);

(new yii\web\Application($config))->run();
