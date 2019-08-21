<?php
namespace App\Http\Api\Backend\Controller;

use App\Http\Api\Backend\Model\Session;
use Yii;

class SessionController extends ActiveController
{
    public $modelClass = Session::class;

    public function actions()
    {
        $actions = parent::actions();

        return [
            'index' => $actions['index'],
            'delete' => $actions['delete'],
            'view' => $actions['view'],
            'options' => $actions['options'],
        ];
    }

    public function getPermission($action)
    {
        // return 'userSession' . ucfirst($action);
    }

    public function searchModel()
    {
        return (new \yii\base\DynamicModel(['id', 'username' => null, 'email' => null, 'status' => null]))
            ->addRule(['id', 'status'], 'integer')
            ->addRule(['username', 'email'], 'trim')
            ->addRule(['username', 'email'], 'string');
    }

    protected function getQuery($action)
    {
        return parent::getQuery($action)
            ->alias('us')
            ->orderBy(['us.create_time' => SORT_DESC]);
    }

    protected function applyFilter($query, $model, $filter)
    {
        foreach (['id', 'username', 'email'] as $name) {
            if (!empty($model->$name)) {
                $query->andFilterWhere(['LIKE', 'u.' . $name, $model->$name]);
            }
        }

        if (is_numeric($model->status)) {
            $query->andWhere(['u.status' => intval($model->status)]);
        }
    }
}
