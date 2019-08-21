<?php
namespace App\Rbac\Rule;

use yii\rbac\Rule;
use yii\web\ForbiddenHttpException;
use Yii;

class RoleDeleteRule extends Rule
{
    public $name = 'roleDelete';

    public function execute($user, $item, $params)
    {
        $auth = Yii::$app->getAuthManager();
        $roles = $auth->getRolesByUser($user);
        $roleName = $params['model']->name;
        if (isset($roles[$roleName])) {
            throw new ForbiddenHttpException(Yii::t('app', 'You cannot delete the role you are belong to'));
        }
    
        return true;
    }
}
