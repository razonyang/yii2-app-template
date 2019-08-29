<?php
namespace App\Http\Api\Model;

use App\Model\Article as BaseArticle;
use Yii;

class Article extends BaseArticle
{
    public function fields()
    {
        return [
            'id',
            'category_id',
            'category_name' => function ($model) {
                return $model->category->name ?? '';
            },
            'title',
            'author',
            'cover',
            'status',
            'summary',
            'release_time',
            'create_time',
            'update_time',
        ];
    }

    public function extraFields()
    {
        return [
            'version',
            'likes_count',
            'content' => function ($model) {
                return $model->meta->content ?? '';
            },
        ];
    }
}
