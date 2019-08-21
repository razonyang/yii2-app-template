<?php
namespace App\Http\Api\Backend\Form;

use App\Model\Session;
use App\Factory\SessionFactory;
use Yii;

class SessionRefreshForm extends UserForm
{
    public $refresh_token;

    public function rules()
    {
        return array_merge(parent::rules(), [
            [['refresh_token'], 'trim'],
            [['refresh_token'], 'string'],
            [['refresh_token'], 'required'],
            ['refresh_token', 'validateRefreshToken'],
        ]);
    }

    public function validateRefreshToken($attribute)
    {
        if ($this->hasErrors()) {
            return;
        }

        $session = $this->getSession();
        if (!$session || $this->$attribute !== $session->refresh_token) {
            $this->addError($attribute, Yii::t('app', '{attribute} is invalid'));
        }
        if ($session->isRefreshTokenExpired()) {
            $this->addError($attribute, Yii::t('app', '{attribute} is expired'));
        }
    }

    protected function handleInternal()
    {
        $user = $this->getUser();
        $transaction = Yii::$app->getDb()->beginTransaction();
        try {
            // creates new session
            $newSession = SessionFactory::createByRequest(
                $user->id,
                Yii::$app->params['user.session.duration'],
                Yii::$app->params['user.session.refreshTokenDuration'],
                Yii::$app->getRequest()
            );
            if (!$newSession->save()) {
                Yii::error($newSession->getErrors());
                throw new \RuntimeException('Unable to create new session');
            }

            // makes old session expires in a few time
            $oldSession = $this->getSession();
            $now = time();
            $oldSession->expire_time = $now + Yii::$app->params['user.session.durationAfterRefresh'];
            $oldSession->refresh_token_expire_time = $now - 1; // expire old refresh token right now
            if (!$newSession->save()) {
                Yii::error($newSession->getErrors());
                throw new \RuntimeException('Unable to update old session');
            }

            $transaction->commit();

            return [
                'token' => $newSession->token,
                'expires_in' => $newSession->getExpiresIn(),
                'refresh_token' => $newSession->refresh_token,
                'refresh_token_expire_in' => $newSession->getRefreshTokenExpiresIn(),
            ];
        } catch (\Throwable $e) {
            $transaction->rollBack();
            throw $e;
        }
    }

    protected function getSession(): ?Session
    {
        $user = $this->getUser();
        return $user->session;
    }
}
