<?php
namespace App\Http\Api\Backend\Form;

use App\Form\BaseForm;
use App\Model\User;
use Yii;

abstract class UserForm extends BaseForm
{
    private $user;

    public function rules()
    {
        return [
            [['user'], 'required'],
        ];
    }

    /**
     * @return User
     */
    protected function getUser(): ?User
    {
        if ($this->user === null) {
            $this->user = Yii::$app->getUser()->getIdentity();
        }

        return $this->user;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }
}
