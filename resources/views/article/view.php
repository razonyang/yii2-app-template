<?php

use App\Http\Asset\AppAsset;
use App\Model\Article;
use yii\bootstrap\Html;
use yii\helpers\Url;

/** @var \yii\web\View $this */
/** @var Article $model */
$this->title = Html::encode($model->title);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Article'), 'url' => Url::to('/articles')];
$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile(Yii::$app->getUrlManager()->createUrl('/js/article.js'), ['depends' => AppAsset::class]);
?>

<h1>
    <?= Html::encode($model->title) ?>
    <small class="text-muted badge"><?= Html::encode($model->category->name ?? '') ?></small>
</h1>

<hr>

<p class="text-muted">
    Created by <?= Html::encode($model->author) ?> and released at <?= Yii::$app->formatter->asDate($model->release_time) ?> 
    <span class="glyphicon glyphicon-eye-open"></span> <?= $model->views ?> 
    <?php if (Yii::$app->getUser()->getIsGuest()): ?>
        <a href="<?= Yii::$app->getUrlManager()->createUrl('/site/login') ?>"<span class="glyphicon glyphicon-heart-empty" aria-hidden="true"></span></a>
    <?php else: ?>
        <?= Html::icon('heart', [
            'style' => $model->getHasLiked() ? '' : 'display: none;',
            'id' => 'btn-dislike',
            'data-id' => $model->id,
        ]) ?>
        <?= Html::icon('heart-empty', [
            'style' => $model->getHasLiked() ? 'display: none;' : '',
            'id' => 'btn-like',
            'data-id' => $model->id,
        ]) ?>
    <?php endif; ?>
    <span id="likes-count"><?= $model->getLikesCount() ?></span>
</p>

<?= $content ?>