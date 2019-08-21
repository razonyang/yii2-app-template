<?php
namespace App\Http\Api\Backend\Form;

use common\validators\PasswordValidator;
use Yii;

class ChangePasswordForm extends UserForm
{
    /**
     * @var string $password current password.
     */
    public $password;

    /**
     * @var string $new_password new password.
     */
    public $new_password;

    public function rules()
    {
        return array_merge(parent::rules(), [
            [['password', 'new_password'], 'trim'],
            [['password', 'new_password'], 'required'],
            [['password', 'new_password'], 'string'],
            ['password', 'validatePassword'],
            ['new_password', 'compare', 'compareAttribute' => 'password', 'operator' => '!='],
            ['new_password', PasswordValidator::class],
        ]);
    }

    public function validatePassword($attribute)
    {
        $user = $this->getUser();
        if (!$user || !$user->validatePassword($this->$attribute)) {
            $this->addError($attribute, Yii::t('app', 'Original password is incorrect'));
        }
    }

    protected function handleInternal()
    {
        $user = $this->getUser();
        $user->setPassword($this->new_password);
        if (!$user->save()) {
            Yii::error($user->getErrors());
            throw new \RuntimeException('Unable to change password');
        }
    }
}
