<?php
use yii\bootstrap\Html;

/** @var ArticleComment[] $comments */

?>
<?php foreach ($comments as $comment): ?>
<div class="media">
  <div class="media-left">
    <a href="#">
      <img class="media-object" src="...">
    </a>
  </div>
  <div class="media-body">
    <h4 class="media-heading"><?= Html::encode($comment->user->name) ?></h4>
    <?= Html::encode($comment->content) ?>
  </div>
</div>
<?php endforeach; ?>