<?php
namespace App\Http\Api\Backend\Form;

use App\Factory\SessionFactory;
use App\Http\Form\LoginForm as BaseLoginForm;
use Yii;

class LoginForm extends BaseLoginForm
{
    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    protected function handleInternal()
    {
        $transaction = Yii::$app->getDb()->beginTransaction();
        try {
            $user = $this->getUser();

            $session = SessionFactory::createByRequest(
                $user->id,
                Yii::$app->params['user.session.duration'],
                Yii::$app->params['user.session.refreshTokenDuration'],
                Yii::$app->getRequest()
            );
            if (!$session->save()) {
                Yii::error($session->getErrors(), __METHOD__);
                throw new \RuntimeException('Unable to save session' . \yii\helpers\VarDumper::dumpAsString($session->getErrors()));
            }

            Yii::$app->user->login($user, $this->rememberMe ? 3600 * 24 * 30 : 0);
            $transaction->commit();

            return [
                'id' => $user->id,
                'username' => $user->username,
                'email' => $user->email,
                'token' => $session->token,
                'expires_in' => $session->getExpiresIn(),
                'refresh_token' => $session->refresh_token,
                'refresh_token_expire_in' => $session->getRefreshTokenExpiresIn(),
            ];
        } catch (\Throwable $e) {
            $transaction->rollBack();
            throw $e;
        }
    }
}
