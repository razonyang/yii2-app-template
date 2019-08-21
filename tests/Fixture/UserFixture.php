<?php
namespace App\Tests\Fixture;

use yii\test\ActiveFixture;
use App\Model\User;

class UserFixture extends ActiveFixture
{
    public $modelClass = User::class;
}
