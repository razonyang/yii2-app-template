<?php
namespace App\Http\Api\Backend\Controller;

use yii\rbac\Item;
use App\Http\Api\Backend\Model\Permission;

class PermissionController extends AuthItemController
{
    public $modelClass = Permission::class;

    public function actions()
    {
        $actions = parent::actions();

        return [
            'index' => $actions['index'],
            'options' => $actions['options'],
        ];
    }

    protected function getType()
    {
        return Item::TYPE_PERMISSION;
    }
}
