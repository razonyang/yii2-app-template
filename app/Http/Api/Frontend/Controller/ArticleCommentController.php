<?php
namespace App\Http\Api\Frontend\Controller;

use App\Http\Api\Model\ArticleComment;
use yii\base\DynamicModel;

class ArticleCommentController extends ActiveController
{
    public $modelClass = ArticleComment::class;

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['authenticator']['optional'] = ['options', 'index'];

        return $behaviors;
    }
    
    public function getQuery($action)
    {
        return parent::getQuery($action)
            ->alias('a')
            ->orderBy([
                'a.create_time' => SORT_DESC
            ])
            ->andWhere([
                'a.is_deleted' => 0,
            ]);
    }

    public function searchModel()
    {
        return (new DynamicModel(['article_id' => null]))
            ->addRule(['article_id'], 'number');
    }

    protected function applyFilter($query, $model, $filter)
    {
        foreach (['article_id'] as $name) {
            if (!empty($model->$name)) {
                $query->andWhere(['a.' . $name => (int) $model->$name]);
            }
        }
    }
}
