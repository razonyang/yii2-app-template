<?php
use App\Model\Article;
use yii\bootstrap\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

/** @var Article[] $articles */
$this->title = Yii::t('app', 'Article');
?>

<?php foreach ($articles as $article): ?>

<div class="media article">
  <div class="media-left media-middle">    
    <img class="media-object" src="<?= $article->cover ?>">
  </div>
  <div class="media-body">
    <h4 class="media-heading title">        
        <?= Html::a(Html::encode($article->title), Url::to(['/article/view', 'id' => $article->id])) ?>
        <small class="badge text-muted"><?= Html::encode($article->category->name ?? '') ?></small>
    </h4>
    
    <p class="summary"><?= Html::encode($article->summary) ?></p>

    <small class="text-muted">
      Created by <?= Html::encode($article->author) ?> and released at <?= Yii::$app->formatter->asDate($article->release_time) ?>
    </small>
  </div>
</div>

<hr>

<?php endforeach; ?>

<?= LinkPager::widget([
    'pagination' => $pagination,
]);?>