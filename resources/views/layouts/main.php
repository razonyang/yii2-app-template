<?php

/* @var $this \yii\web\View */
/* @var $content string */

use App\Http\Asset\AppAsset;
use App\Http\Widget\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title . ' - ' . Yii::$app->name) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => Yii::t('app', 'Home'), 'url' => ['/site/index']],
        ['label' => Yii::t('app', 'Article'), 'url' => ['/article/index']],
        ['label' => Yii::t('app', 'About Us'), 'url' => ['/site/about']],
        ['label' => Yii::t('app', 'Contact Us'), 'url' => ['/site/contact']],
        ['label' => Yii::t('app', 'Console'), 'url' => Yii::$app->params['backend.url'], 'linkOptions' => ['target' => '_blank']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => Yii::t('app', 'Login'), 'url' => ['/site/login']];
        $menuItems[] = ['label' => Yii::t('app', 'Sign Up'), 'url' => ['/site/signup']];
    } else {
        $menuItems[] = [
            'label' => Yii::$app->user->identity->name,
            'items' => [
                ['label' => Yii::t('app', 'Setting'), 'url' => '#'],
                '<li role="separator" class="divider"></li>',
                ['label' => Yii::t('app', 'Logout'), 'url' => 'javascript: $("#logout-form").submit();'],
            ],
        ];
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left"><?= Yii::$app->params['site.since'] . ' - ' . date('Y') ?> &copy; <?= Html::encode(Yii::$app->name) ?></p>

        <p class="pull-right">
            <?= \Yii::t('yii', 'Powered by {yii}', [
                'yii' => Html::a('Yii2 App Template', 'https://github.com/razonyang/yii2-app-template', ['target' => '_blank']),
            ]) ?>
        </p>
    </div>
</footer>

<?php if (!Yii::$app->user->isGuest): ?>
<?= Html::beginForm(['/logout'], 'post', ['id' => 'logout-form']) ?>
<?= Html::endForm() ?>
<?php endif; ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
