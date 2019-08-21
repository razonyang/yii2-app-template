<?php
namespace App\Rbac\Rule;

use App\Model\User;
use Yii;
use yii\rbac\Rule;
use yii\web\ForbiddenHttpException;

class UserDeleteRule extends Rule
{
    public $name = 'userDelete';

    public function execute($user, $item, $params)
    {
        /** @var User $model */
        $model = $params['model'];
        if ($model->id == $user) {
            throw new ForbiddenHttpException(Yii::t('app', 'You cannot delete your own account'));
        }
        
        return true;
    }
}
