<?php
namespace App\Factory;

use App\Model\ArticleMeta;
use Yii;

class ArticleMetaFactory
{
    public static function findByArticleId(int $articleId): ?ArticleMeta
    {
        return ArticleMeta::findOne([
            'article_id' => $articleId,
        ]);
    }

    public static function create(int $articleId, string $content): ArticleMeta
    {
        return new ArticleMeta([
            'article_id' => $articleId,
            'content' => $content,
        ]);
    }
}
