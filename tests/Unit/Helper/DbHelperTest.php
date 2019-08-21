<?php
namespace App\Tests\Unit\Helper;

use App\Helper\DbHelper;
use Codeception\Test\Unit;

class DbHelperTest extends Unit
{
    /**
     * @dataProvider dataTransaction
     */
    public function testTransaction(\Closure $callback, array $parameters, bool $success): void
    {
        if (!$success) {
            $this->expectException(\Throwable::class);
        }
        DbHelper::transaction($callback, $parameters);
    }

    public function dataTransaction(): array
    {
        return [
            [function() {}, [], true],
            [function() {
                throw new \Exception('fail');
            }, [], false],
        ];
    }
}
