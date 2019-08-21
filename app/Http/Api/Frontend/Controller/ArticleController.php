<?php
namespace App\Http\Api\Frontend\Controller;

use App\Http\Api\Model\Article;
use yii\base\DynamicModel;
use App\Model\StatusInterface;

class ArticleController extends ActiveController
{
    public $modelClass = Article::class;

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
                'a.release_time' => SORT_DESC
            ])
            ->andWhere([
                'a.is_deleted' => 0,
                'a.status' => StatusInterface::STATUS_ACTIVE,
            ])
            ->andWhere(['<=', 'a.release_time', time()]);
    }

    public function searchModel()
    {
        return (new DynamicModel(['title' => '', 'author' => '', 'summary' => '']))
            ->addRule(['title', 'author', 'summary'], 'string');
    }

    protected function applyFilter($query, $model, $filter)
    {
        foreach (['title', 'author', 'summary'] as $name) {
            if (!empty($model->$name)) {
                $query->andWhere(['LIKE', 'a.' . $name, $model->$name]);
            }
        }
    }
}
