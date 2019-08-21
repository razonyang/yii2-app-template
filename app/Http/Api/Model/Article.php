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
            'title',
            'author',
            'cover',
            'summary',
            'release_time',
            'update_time',
        ];
    }

    public function extraFields()
    {
        return [
            'version',
            'content',
        ];
    }
}
