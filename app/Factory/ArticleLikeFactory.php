<?php
namespace App\Factory;

use App\Model\ArticleLike;
use Yii;

class ArticleLikeFactory
{
    public static function create(int $articleId, int $userId): ArticleLike
    {
        return new ArticleLike([
            'article_id' => $articleId,
            'user_id' => $userId,
        ]);
    }
}
