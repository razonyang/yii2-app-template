<?php
namespace App\Http\Api\Backend\Controller;

use App\Http\Api\Backend\Model\Permission;
use yii\rbac\Item;

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
