<?php
namespace App\Http\Controller;

use App\Model\Article;
use App\Model\StatusInterface;
use yii\data\Pagination;
use yii\helpers\HtmlPurifier;
use yii\web\NotFoundHttpException;

class ArticleController extends Controller
{
    public function afterAction($action, $result)
    {
        if ($action->id === 'view') {
            $this->model->updateCounters([
                'views' => 1
            ]);
        }

        return parent::afterAction($action, $result);
    }

    public function actionIndex()
    {
        $query = Article::find()
            ->alias('a')
            ->joinWith('category')
            ->where([
                'a.status' => StatusInterface::STATUS_ACTIVE,
                'a.is_deleted' => 0,
            ])
            ->andWhere(['<=', 'a.release_time', time()])
            ->orderBy(['a.release_time' => SORT_DESC]);

        $count = $query->count();
        $pagination = new Pagination(['totalCount' => $count]);

        $articles = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        
        return $this->render('index', [
            'articles' => $articles,
            'pagination' => $pagination,
        ]);
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);
        
        return $this->render('view', [
            'model' => $model,
            'content' => HtmlPurifier::process($model->meta->content),
        ]);
    }

    /**
     * @var Article $model
     */
    private $model;

    private function findModel($id)
    {
        $model = Article::findOne($id);
        if (!$model) {
            throw new NotFoundHttpException('Article does not exists');
        }

        $this->model = $model;
        return $this->model;
    }
}
