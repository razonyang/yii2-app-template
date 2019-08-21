<?php
namespace App\Http\Api\Backend\Form;

use App\Form\Form;
use App\Htpp\User\LogoutInterface;
use yii\web\IdentityInterface;
use Yii;

class LogoutForm extends Form
{
    protected function handleInternal()
    {
        $user = $this->getUser();
        if (!$user) {
            return;
        }

        if ($user instanceof LogoutInterface) {
            $user->logout();
            return;
        }

        Yii::$app->getUser()->logout();
    }

    private $user;

    /**
     * @return null|IdentityInterface
     */
    public function getUser()
    {
        if ($this->user === null) {
            $this->user = Yii::$app->getUser()->getIdentity();
        }

        return $this->user;
    }
}
