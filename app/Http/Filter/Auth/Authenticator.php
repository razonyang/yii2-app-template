<?php
namespace App\Http\Filter\Auth;

use yii\filters\auth\CompositeAuth;

class Authenticator extends CompositeAuth
{
    public function authenticate($user, $request, $response)
    {
        $identity = $user->getIdentity();

        return $identity ?? parent::authenticate($user, $request, $response);
    }
}
