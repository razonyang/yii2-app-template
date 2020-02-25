<?php
namespace App\Http\Api\Backend\Form;

use App\Form\BaseForm;
use App\Htpp\User\LogoutInterface;
use Yii;
use yii\web\IdentityInterface;

class LogoutForm extends BaseForm
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
