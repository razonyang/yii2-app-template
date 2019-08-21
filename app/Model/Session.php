<?php
namespace App\Model;

use App\Db\TimestampBehavior;
use Yii;

/**
 * This is the model class for table "t_user_session".
 *
 * @property string $id
 * @property int $user_id User ID
 * @property string $token Access Token
 * @property string $refresh_token Refresh Token
 * @property string $ip_address IP Address
 * @property string $user_agent User Agent
 * @property int $expire_time Expire Time
 * @property int $refresh_token_expire_time Refresh Token Expire Time
 * @property int $create_time Create Time
 * @property int $update_time Update Time
 *
 * @property User $user
 */
class Session extends ActiveRecord implements StatusInterface
{
    use StatusTrait;

    public static function tableName()
    {
        return '{{%session}}';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    public function rules()
    {
        return [
            [['ip_address', 'user_agent'], 'default', 'value' => ''],
            [['id', 'token', 'refresh_token', 'user_id', 'expire_time', 'refresh_token_expire_time'], 'required'],
            [['user_id', 'expire_time', 'create_time', 'update_time'], 'integer'],
            [['token'], 'string', 'max' => 32],
            [['ip_address'], 'string', 'max' => 45],
            [['user_agent'], 'string', 'max' => 255],
            [['token'], 'unique'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'token' => Yii::t('app', 'Access Token'),
            'user_id' => Yii::t('app', 'User ID'),
            'ip_address' => Yii::t('app', 'Ip Address'),
            'user_agent' => Yii::t('app', 'User Agent'),
            'expire_time' => Yii::t('app', 'Expire Time'),
            'create_time' => Yii::t('app', 'Create Time'),
            'update_time' => Yii::t('app', 'Update Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * Returns a bool value indicates whether the session is expired.
     *
     * @param int|null $now current timestamp.
     *
     * @return bool
     */
    public function isExpired(?int $now = null): bool
    {
        $now = $now ?? time();
        return $this->expire_time < $now;
    }

    public function getExpiresIn(?int $now = null): int
    {
        $now = $now ?? time();
        $remaining = $this->expire_time - $now;
        return $remaining > 0 ? $remaining : 0;
    }

    /**
     * Returns a bool value indicates whether the session is expired.
     *
     * @param int|null $now current timestamp.
     *
     * @return bool
     */
    public function isRefreshTokenExpired(?int $now = null): bool
    {
        $now = $now ?? time();
        return $this->refresh_token_expire_time < $now;
    }

    public function getRefreshTokenExpiresIn(?int $now = null): int
    {
        $now = $now ?? time();
        $remaining = $this->refresh_token_expire_time - $now;
        return $remaining > 0 ? $remaining : 0;
    }

    /**
     * Finds session by token.
     *
     * @param string $token access token.
     *
     * @return self|null
     */
    public static function findByToken(string $token): ?self
    {
        return static::findOne(['token' => $token]);
    }

    /**
     * Finds session by refresh token.
     *
     * @param string $token refresh token.
     *
     * @return self|null
     */
    public static function findByRefreshToken(string $token): ?self
    {
        return static::findOne(['refresh_token' => $token]);
    }
}
