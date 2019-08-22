<?php
namespace App\Behavior;

use App\Model\Article;
use App\Model\ArticleCategory;
use yii\base\Behavior;
use yii\base\Event;

class ArticleCategoryBehavior extends Behavior
{
    public function events()
    {
        return [
            ArticleCategory::EVENT_BEFORE_DELETE => 'beforeDelete',
        ];
    }

    public function beforeDelete(Event $event)
    {
        /** @var ArticleCategory $model */
        $model = $event->sender;
        $count = Article::find()
            ->where([
                'category_id' => $model->id,
                'is_deleted' => 0,
            ])
            ->count();
        if ($count > 0) {
            throw new \Exception('Unable to delete category since there are articles belong to it');
        }
    }
}
