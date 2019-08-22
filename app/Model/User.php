<?php
namespace App\Model;

use App\Behavior\TimestampBehavior;
use App\Http\Filter\LanguagePickerInterface;
use App\Http\User\LogoutInterface;
use Yii;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $name
 * @property string $first_name
 * @property string $last_name
 * @property string $avatar
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $verification_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $is_deleted
 * @property integer $create_time
 * @property integer $update_time
 * @property string $password write-only password
 */
class User extends ActiveRecord implements
    IdentityInterface,
    LogoutInterface,
    LanguagePickerInterface,
    StatusInterface,
    SoftDeleteInterface
{
    use StatusTrait, SoftDeleteTrait;

    public static function tableName()
    {
        return '{{%user}}';
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
            [
                [
                    'username', 'email', 'first_name', 'last_name', 'avatar', 'language',
                    'avatar',
                ],
                'string'
            ],
            ['status', 'default', 'value' => StatusInterface::STATUS_ACTIVE],
            [['avatar', 'auth_key'], 'default', 'value' => ''],
            [['language'], 'default', 'value' => Yii::$app->language],
            [
                [
                    'username', 'email', 'first_name', 'last_name',
                    'language', 'status', 'password_hash'
                ],
                'required'
            ],
            ['status', 'in', 'range' => [StatusInterface::STATUS_ACTIVE, StatusInterface::STATUS_INACTIVE]],
            [['password'], 'safe'],
            [['email', 'username'], 'unique'],
        ];
    }

    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => StatusInterface::STATUS_ACTIVE]);
    }

    /**
     * @var Session $session
     */
    public $session;

    public static function findIdentityByAccessToken($token, $type = null)
    {
        $token = trim(strval($token));
        if ($token === '') {
            return null;
        }

        $session = Session::findByToken($token);
        if (!$session) {
            Yii::error(sprintf('Session "%s" does not exists', $token), __METHOD__);
            return null;
        }
        if ($session->isExpired()) {
            Yii::error(sprintf('Session "%s" is expired', $token), __METHOD__);
            return null;
        }
        
        if (!$session->user) {
            Yii::error(sprintf('User #%s does not exists', $session->user_id), __METHOD__);
            return null;
        }
        if (!$session->user->isActive()) {
            Yii::error(sprintf('User #%s is inactive', $session->user_id), __METHOD__);
            return null;
        }
        if ($session->user->isDeleted()) {
            Yii::error(sprintf('User #%s was deleted', $session->user_id), __METHOD__);
            return null;
        }
        
        $session->user->session = $session;
        return $session->user;
    }

    public function logout(): bool
    {
        if ($this->session) {
            $this->session->delete();
        }

        return Yii::$app->getUser()->logout();
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => StatusInterface::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds user by verification email token
     *
     * @param string $token verify email token
     * @return static|null
     */
    public static function findByVerificationToken($token)
    {
        return static::findOne([
            'verification_token' => $token,
            'status' => StatusInterface::STATUS_INACTIVE
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    public function getId()
    {
        return $this->getPrimaryKey();
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $password = trim($password);
        // ignore empty password
        if ($password === '') {
            return;
        }

        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    public function generateEmailVerificationToken()
    {
        $this->verification_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    public function getLanguage()
    {
        return $this->language;
    }

    public function getName(): string
    {
        $parts = [$this->first_name, $this->last_name];

        return implode(' ', array_filter($parts));
    }

    public function fields()
    {
        return [
            'id',
            'username',
            'name',
            'first_name',
            'last_name',
            'avatar',
            'email',
            'language',
            'status',
            'create_time',
            'update_time',
        ];
    }
}
