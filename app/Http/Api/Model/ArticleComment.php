<?php
namespace App\Http\Api\Model;

use App\Model\ArticleComment as Model;
use Yii;

class ArticleComment extends Model
{
    public function fields()
    {
        return [
            'id',
            'is_deleted',
            'username',
            'content',
            'create_time',
            'update_time',
        ];
    }
}
