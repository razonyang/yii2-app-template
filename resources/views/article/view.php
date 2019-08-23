<?php
use App\Model\Article;
use yii\bootstrap\Html;

/** @var Article $model */
$this->title = $model->title;
?>

<h1>
    <?= Html::encode($model->title) ?>
    <small class="text-muted badge"><?= Html::encode($model->category->name ?? '') ?></small>
</h1>

<hr>

<p class="text-muted">
    Created by <?= Html::encode($model->author) ?> and released at <?= Yii::$app->formatter->asDate($model->release_time) ?> 
    <span class="glyphicon glyphicon-eye-open"></span> <?= $model->views ?>
</p>

<?= $content ?>