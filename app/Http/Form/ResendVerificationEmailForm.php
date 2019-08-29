<?php
namespace App\Http\Form;

use App\Model\User;
use Yii;
use yii\base\Model;

class ResendVerificationEmailForm extends Model
{
    /**
     * @var string
     */
    public $email;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'validateEmail'],
        ];
    }

    public function validateEmail($attribute)
    {
        $user = $this->getUser();
        if (!$user) {
            $this->addError($attribute, 'There is no user with this email address.');
            return;
        }
        if ($user->isActive()) {
            $this->addError($attribute, 'The email was verified.');
            return;
        }
    }

    /**
     * Sends confirmation email to user
     *
     * @return bool whether the email was sent
     */
    public function sendEmail()
    {
        $user = User::findOne([
            'email' => $this->email,
        ]);

        if ($user === null) {
            return false;
        }

        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }

    private $user;

    public function getUser(): ?User
    {
        if ($this->user === null) {
            $this->user = User::findOne(['email' => $this->email]);
        }

        return $this->user;
    }
}
