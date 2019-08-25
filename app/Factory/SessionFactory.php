<?php
namespace App\Factory;

use App\Model\Session;
use Ramsey\Uuid\Uuid;
use Yii;
use yii\web\Request;

class SessionFactory
{
    /**
     * Creates a session from request.
     *
     * @param int     $userId          user ID.
     * @param int     $duration        session duration
     * @param int     $refreshDuration session fresh duration
     * @param Request $request
     *
     * @return Session
     */
    public static function create(int $userId, int $duration, int $refeshDuration, Request $request): Session
    {
        $ip = $request->getUserIP();
        $userAgent = mb_substr($request->getUserAgent(), 0, 255);
        $token = static::generateToken($userId);
        $refeshToken = static::generateRefreshToken($userId);
        $now = time();
        return new Session([
            'id' => Uuid::uuid4()->toString(),
            'token' => $token,
            'refresh_token' => $refeshToken,
            'user_id' => $userId,
            'expire_time' => $now + $duration,
            'refresh_token_expire_time' => $now + $refeshDuration,
            'ip_address' => $ip,
            'user_agent' => $userAgent,
        ]);
    }

    /**
     * Generates access token.
     *
     * @param int $userId user ID.
     *
     * @return string
     */
    public static function generateToken(int $userId): string
    {
        return ($userId % 10) . Yii::$app->getSecurity()->generateRandomString(31);
    }

    /**
     * Generates refresh token.
     *
     * @param int $userId user ID.
     *
     * @return string
     */
    public static function generateRefreshToken(int $userId): string
    {
        return ($userId % 10) . Yii::$app->getSecurity()->generateRandomString(63);
    }
}
