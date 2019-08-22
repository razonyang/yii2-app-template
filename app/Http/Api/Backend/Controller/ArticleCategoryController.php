<?php
namespace App\Http\Api\Backend\Controller;

use App\Http\Api\Backend\Model\ArticleCategory;
use yii\base\DynamicModel;

class ArticleCategoryController extends ActiveController
{
    public $modelClass = ArticleCategory::class;
    
    public function getQuery($action)
    {
        return parent::getQuery($action)
            ->alias('c')
            ->orderBy([
                'c.name' => SORT_ASC
            ]);
    }

    public function searchModel()
    {
        return (new DynamicModel(['id' => '', 'name' => '']))
            ->addRule(['name'], 'string')
            ->addRule(['id'], 'number');
    }

    protected function applyFilter($query, $model, $filter)
    {
        foreach (['name'] as $name) {
            if (!empty($model->$name)) {
                $query->andWhere(['LIKE', 'c.' . $name, $model->$name]);
            }
        }
        foreach (['id'] as $name) {
            if (is_numeric($model->$name)) {
                $query->andWhere(['c.' . $name => $model->$name]);
            }
        }
    }
}
