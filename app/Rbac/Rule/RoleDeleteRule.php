<?php
namespace App\Rbac\Rule;

use Yii;
use yii\rbac\Rule;

class RoleDeleteRule extends Rule
{
    public $name = 'roleDelete';

    public function execute($user, $item, $params)
    {
        $auth = Yii::$app->getAuthManager();
        $roles = $auth->getRolesByUser($user);
        $roleName = $params['model']->name;
        return isset($roles[$roleName]) ? false : true;
    }
}
