<?php
namespace App\Http\Api\Backend\Form;

use Yii;

class MyInfoForm extends UserForm
{
    protected function handleInternal()
    {
        $user = $this->getUser();
        return [
            'id' => $user->id,
            'username' => $user->username,
            'name' => $user->name,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'avatar' => $user->avatar,
            'language' => $user->language,
            'permissions' => $this->getPermissions(),
        ];
    }

    protected function getPermissions()
    {
        $user = $this->getUser();
        $auth = Yii::$app->getAuthManager();
        $permissions = $auth->getPermissionsByUser($user->id);
        $names = array_column($permissions, 'name');
        return $names;
    }
}
