<?php
namespace App\Behavior;

use App\Factory\ArticleMetaFactory;
use App\Model\Article;
use Yii;
use yii\base\Behavior;
use yii\base\Event;

class ArticleBehavior extends Behavior
{
    public function events()
    {
        return [
            Article::EVENT_AFTER_INSERT => 'saveMeta',
            Article::EVENT_AFTER_UPDATE => 'saveMeta',
            Article::EVENT_AFTER_DELETE => 'afterDelete',
        ];
    }

    public function saveMeta(Event $event)
    {
        /** @var Article $model */
        $model = $event->sender;

        $meta = ArticleMetaFactory::findByArticleId($model->id);
        if (!$meta) {
            $meta = ArticleMetaFactory::create($model->id, $model->content);
        } else {
            $meta->content = $model->content;
        }
        if (!$meta->save()) {
            Yii::error($meta->getErrors(), __METHOD__);
            throw new \Exception('Unable to save article meta');
        }
    }

    public function afterDelete(Event $event)
    {
        /** @var Article $model */
        $model = $event->sender;

        $meta = ArticleMetaFactory::findByArticleId($model->id);
        if ($meta && $meta->delete() === false) {
            throw new \Exception('Unable to delete article meta');
        }
    }
}
