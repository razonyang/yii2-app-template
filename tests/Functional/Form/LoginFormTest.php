<?php

namespace App\Tests\Unit\Form;

use App\Tests\Fixture\UserFixture;
use App\Http\Api\Backend\Form\LoginForm;
use Codeception\Test\Unit;
use Yii;

/**
 * Login form test
 */
class LoginFormTest extends Unit
{
    /**
     * @return array
     */
    public function _fixtures()
    {
        return [
            'user' => [
                'class' => UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'user.php'
            ]
        ];
    }

    public function testLoginNoUser()
    {
        $model = new LoginForm([
            'username' => 'not_existing_username',
            'password' => 'not_existing_password',
        ]);

        $model->handle();
        $this->assertTrue($model->hasErrors());
        $this->assertArrayHasKey('password', $model->getErrors());
        $this->assertTrue(Yii::$app->user->isGuest);
    }

    public function testLoginWrongPassword()
    {
        $model = new LoginForm([
            'username' => 'bayer.hudson',
            'password' => 'wrong_password',
        ]);

        $model->handle();
        $this->assertTrue($model->hasErrors());
        $this->assertArrayHasKey('password', $model->getErrors());
        $this->assertTrue(Yii::$app->user->isGuest);
    }

    public function testLoginCorrect()
    {
        $model = new LoginForm([
            'username' => 'bayer.hudson',
            'password' => 'password_0',
        ]);
        
        $model->handle();
        $this->assertFalse($model->hasErrors());
        $this->assertFalse(Yii::$app->user->isGuest);
    }
}
