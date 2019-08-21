<?php
namespace App\Tests\Fixture;

use App\Model\User;
use yii\test\ActiveFixture;

class UserFixture extends ActiveFixture
{
    public $modelClass = User::class;
}
