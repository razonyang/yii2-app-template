<?php
namespace App\Tests\Unit\Factory;

use App\Factory\SessionFactory;
use App\Model\Session;
use Codeception\Test\Unit;
use Yii;
use yii\web\Request;

class SessionFactoryTest extends Unit
{
    /**
     * @dataProvider dataCreate
     */
    public function testCreate(int $userId, int $duration, int $refeshDuration, Request $request): void
    {
        $session = SessionFactory::create($userId, $duration, $refeshDuration, $request);
        $this->assertSame($userId, $session->user_id);
        $this->assertTrue($duration + time() >= $session->expire_time);
        $this->assertTrue($refeshDuration + time() >= $session->refresh_token_expire_time);
        $this->assertEquals($request->getUserIP(), $session->ip_address);
        $this->assertEquals($request->getUserAgent(), $session->user_agent);
    }

    public function dataCreate(): array
    {
        return [
            [1, 2, 3, new \yii\web\Request()],
            [4, 5, 6, new \yii\web\Request()],
        ];
    }
}
