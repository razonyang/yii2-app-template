<?php
namespace App\Tests\Unit\Factory;

use App\Factory\SessionFactory;
use App\Model\Session;
use Codeception\Test\Unit;
use Yii;

class SessionFactoryTest extends Unit
{
    /**
     * @dataProvider dataCreate
     */
    public function testCreate(int $userId, int $duration, int $refeshDuration, Request $request): void
    {
        $session = SessionFactory::create($userId, $duration, $refeshDuration, $request);
        $this->assertSame($userId, $session->user_id);
    }

    public function dataCreate(): array
    {
        return [
            [1, 3600, 7200, Yii::$app->getRequest()],
            [2, 3600, 7200, Yii::$app->getRequest()],
        ];
    }
}
