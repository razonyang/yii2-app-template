<?php
namespace App\Http\Api\Frontend\Controller;

use App\Http\Api\Form\ArticleDislikeForm;
use App\Http\Api\Form\ArticleLikeForm;
use App\Http\Api\Model\Article;
use App\Model\StatusInterface;
use yii\base\DynamicModel;

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

    /**
     * Likes an article.
     */
    public function actionLike($id)
    {
        $model = new ArticleLikeForm();
        $model->load(['id' => $id], '');
        return $model->handle();
    }

    /**
     * Dislikes an article.
     */
    public function actionDislike($id)
    {
        $model = new ArticleDislikeForm();
        $model->load(['id' => $id], '');
        return $model->handle();
    }
}
