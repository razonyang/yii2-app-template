<?php
use App\Model\Article;
use yii\bootstrap\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

/** @var Article[] $articles */
$this->title = Yii::t('app', 'Article');
?>

<?php foreach ($articles as $article): ?>

<div class="media">
  <div class="media-left">
    <?= Html::encode($article->category->name ?? '') ?>
  </div>
  <div class="media-body">
    <h4 class="media-heading">
        <?= Html::a(Html::encode($article->summary), Url::to(['/article/view', 'id' => $article->id])) ?>
        <small class="text-muted"><?= Html::encode($article->author) ?></small>
    </h4>
    <p><?= Html::encode($article->summary) ?></p>
    <small class="text-muted"><?= Yii::t('app', '{0, time}', $article->release_time) ?></small>
  </div>
</div>

<hr>

<?php endforeach; ?>

<?= LinkPager::widget([
    'pagination' => $pagination,
]);?>