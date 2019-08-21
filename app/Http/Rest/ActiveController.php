<?php
namespace App\Http\Rest;

use yii\data\ActiveDataFilter;
use yii\data\ActiveDataProvider;
use yii\data\DataFilter;
use yii\data\Pagination;
use yii\data\Sort;
use yii\db\ActiveQuery;
use yii\rest\ActiveController as BaseActiveController;
use yii\rest\IndexAction;
use yii\rest\Action;
use yii\web\ForbiddenHttpException;
use yii\rest\UpdateAction;
use yii\rest\CreateAction;
use yii\rest\ViewAction;
use yii\web\NotFoundHttpException;
use Yii;

class ActiveController extends BaseActiveController
{
    public $serializer = Serializer::class;

    public function actions()
    {
        return [
            'index' => [
                'class' => IndexAction::class,
                'modelClass' => $this->modelClass,
                'checkAccess' => [$this, 'checkAccess'],
                'dataFilter' => $this->dataFilter(),
                'prepareDataProvider' => [$this, 'prepareDataProvider'],
            ],
            'view' => [
                'class' => ViewAction::class,
                'modelClass' => $this->modelClass,
                'findModel' => [$this, 'findModel'],
                'checkAccess' => [$this, 'checkAccess'],
            ],
            'create' => [
                'class' => CreateAction::class,
                'modelClass' => $this->modelClass,
                'checkAccess' => [$this, 'checkAccess'],
                'scenario' => $this->createScenario,
            ],
            'update' => [
                'class' => UpdateAction::class,
                'modelClass' => $this->modelClass,
                'checkAccess' => [$this, 'checkAccess'],
                'scenario' => $this->updateScenario,
                'findModel' => [$this, 'findModel'],
            ],
            'delete' => [
                'class' => DeleteAction::class,
                'modelClass' => $this->modelClass,
                'checkAccess' => [$this, 'checkAccess'],
                'findModel' => [$this, 'findModel'],
            ],
            'options' => [
                'class' => OptionsAction::class,
            ],
        ];
    }

    /**
     * @param string $id
     * @param Action $action
     */
    public function findModel($id, $action)
    {
        $model = $this->findModelById($id, $action);

        if (isset($model)) {
            return $model;
        }

        throw new NotFoundHttpException("Object not found: $id");
    }

    /**
     * @param string $id
     * @param Action $action
     */
    protected function findModelById($id, $action)
    {
        /* @var yii\db\ActiveRecordInterface $modelClass */
        $modelClass = $action->modelClass;
        $keys = $modelClass::primaryKey();
        if (count($keys) > 1) {
            $values = explode(',', $id);
            if (count($keys) === count($values)) {
                return $modelClass::findOne(array_combine($keys, $values));
            }
        } elseif ($id !== null) {
            return $modelClass::findOne($id);
        }
    }

    /**
     * Returns data filter.
     *
     * @return null|DataFilter
     */
    public function dataFilter()
    {
        $searchModel = $this->searchModel();
        if ($searchModel === null) {
            return null;
        }

        return [
            'class' => ActiveDataFilter::class,
            'filterAttributeName' => 'filter',
            'searchModel' => $searchModel,
        ];
    }

    /**
     * Returns search model.
     *
     * @return null|array|callable
     */
    protected function searchModel()
    {
        return null;
    }

    /**
     * Gets data provider.
     *
     * @param IndexAction $action
     * @param null|DataFilter $filter
     *
     * @return mixed
     */
    public function prepareDataProvider(IndexAction $action, $filter)
    {
        $requestParams = Yii::$app->getRequest()->getBodyParams();
        if (empty($requestParams)) {
            $requestParams = Yii::$app->getRequest()->getQueryParams();
        }

        $query = $this->getQuery($action);
        if (!empty($filter)) {
            $this->applyFilter($query, $action->dataFilter->searchModel, $filter);
        }

        return Yii::createObject([
            'class' => ActiveDataProvider::class,
            'query' => $query,
            'pagination' => [
                'class' => Pagination::class,
                'pageParam' => 'page',
                'pageSizeParam' => 'limit',
                'pageSizeLimit' => [1, 100],
                'defaultPageSize' => 20,
                'params' => $requestParams,
            ],
            'sort' => [
                'class' => Sort::class,
                'sortParam' => 'sort',
                'params' => $requestParams,
            ],
        ]);
    }

    /**
     * Returns active query instance.
     *
     * @param Action $action
     *
     * @return ActiveQuery
     */
    protected function getQuery($action)
    {
        /* @var $modelClass \yii\db\BaseActiveRecord */
        $modelClass = $action->modelClass;
        $query = $modelClass::find();

        return $query;
    }

    /**
     * Applies filter on query.
     *
     * @param ActiveQuery $query
     * @param \yii\base\Model
     * @param DataFilter $filter
     */
    protected function applyFilter($query, $model, $filter)
    {
        $query->andWhere($filter);
    }

    public function checkAccess($action, $model = null, $params = [])
    {
        $permission = $this->getPermission($action);
        if ($permission === null) {
            return;
        }

        Yii::info('Checking permission: ' . $permission, __METHOD__);
        $user = Yii::$app->getUser();
        if (!$user->can($permission, ['model' => $model])) {
            Yii::error(sprintf("User #%d doesn't have permission: %s", $user->getId(), $permission), __METHOD__);
            throw new ForbiddenHttpException();
        }
    }

    /**
     * @return string|null
     */
    protected function getPermission($action)
    {
        return null;
    }
}
