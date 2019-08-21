<?php
namespace App\Http\Api\Backend\Controller;

use App\Http\Api\Backend\Model\Setting;
use yii\base\DynamicModel;
use Yii;

class SettingController extends ActiveController
{
    public $modelClass = Setting::class;

    public function actions()
    {
        $actions = parent::actions();
        return [
            'index' => $actions['index'],
            'view' => $actions['view'],
            'update' => $actions['update'],
            'options' => $actions['options'],
        ];
    }

    public function searchModel()
    {
        return (new DynamicModel(['id' => '', 'description' => '']))
            ->addRule(['id', 'description'], 'string');
    }

    protected function getQuery($action)
    {
        return parent::getQuery($action)
            ->alias('s')
            ->orderBy(['id' => SORT_ASC]);
    }

    protected function applyFilter($query, $model, $filter)
    {
        foreach (['id', 'description'] as $name) {
            if (!empty($model->$name)) {
                $query->andWhere(['LIKE', 's.' . $name, $model->$name]);
            }
        }
    }
}
