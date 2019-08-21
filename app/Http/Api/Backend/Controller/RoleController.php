<?php
namespace App\Http\Api\Backend\Controller;

use App\Http\Api\Backend\Model\Role;
use yii\rbac\Item;

class RoleController extends AuthItemController
{
    public $modelClass = Role::class;

    protected function getType()
    {
        return Item::TYPE_ROLE;
    }
    
    protected function getPermission($action)
    {
        return 'role' . ucfirst($action);
    }
}
