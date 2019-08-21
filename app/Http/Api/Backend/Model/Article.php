<?php
namespace App\Http\Api\Backend\Model;

use App\Http\Api\Model\Article as BaseArticle;
use Yii;

class Article extends BaseArticle
{
    public function rules()
    {
        return array_merge([
            ['user_id', 'default', 'value' => function () {
                return Yii::$app->getUser()->getId();
            }],
        ], parent::rules());
    }
}
