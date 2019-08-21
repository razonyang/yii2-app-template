<?php
namespace App\Http\Api\Backend\Controller;

use App\Http\Api\Backend\Model\Article;
use yii\base\DynamicModel;

class ArticleController extends ActiveController
{
    public $modelClass = Article::class;
    
    public function getQuery($action)
    {
        return parent::getQuery($action)
            ->alias('a')
            ->orderBy([
                'a.id' => SORT_DESC
            ])
            ->andWhere([
                'a.is_deleted' => 0,
            ]);
    }

    public function searchModel()
    {
        return (new DynamicModel(['id' => '', 'title' => '', 'author' => '', 'summary' => '', 'status' => '']))
            ->addRule(['title', 'author', 'summary'], 'string')
            ->addRule(['id', 'status'], 'number');
    }

    protected function applyFilter($query, $model, $filter)
    {
        foreach (['title', 'author', 'summary'] as $name) {
            if (!empty($model->$name)) {
                $query->andWhere(['LIKE', 'a.' . $name, $model->$name]);
            }
        }
        foreach (['id', 'status'] as $name) {
            if (is_numeric($model->$name)) {
                $query->andWhere(['a.' . $name => $model->$name]);
            }
        }
    }
}
