<?php
use App\Model\Article;
use yii\bootstrap\Html;

/** @var Article $model */
$this->title = $model->title;
?>

<h1>
    <?= Html::encode($model->title) ?>
    <small class="text-muted"><?= Html::encode($model->category->name ?? '') ?></small>
</h1>

<hr>

<p class="text-muted">
    Released by <?= Html::encode($model->author) ?> at <?= Yii::t('app', '{0, time}', $model->release_time) ?>
</p>

<?= $model->meta->content ?>