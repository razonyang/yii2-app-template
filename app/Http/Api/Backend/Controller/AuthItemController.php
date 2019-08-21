<?php
namespace App\Http\Api\Backend\Controller;

use yii\base\DynamicModel;

abstract class AuthItemController extends ActiveController
{
    abstract protected function getType();

    public function getQuery($action)
    {
        return parent::getQuery($action)
            ->alias('ai')
            ->orderBy(['ai.name' => SORT_ASC])
            ->andWhere(['ai.type' => $this->getType()]);
    }

    public function searchModel()
    {
        return (new DynamicModel(['name' => '', 'description' => '']))
            ->addRule(['name', 'description'], 'string');
    }

    public function applyFilter($query, $model, $filter)
    {
        foreach (['name', 'description'] as $name) {
            if (!empty($model->$name)) {
                $query->andWhere(['LIKE', 'ai.' . $name, $model->$name]);
            }
        }
    }

    public function findModelById($id, $action)
    {
        return $action->modelClass::findOne([
            'name' => $id,
            'type' => $this->getType(),
        ]);
    }
}
