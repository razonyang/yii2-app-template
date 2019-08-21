<?php
namespace App\Tests\Unit\Console\Job;

use App\Console\Job\HelloJob;
use Codeception\Test\Unit;

class HelloJobTest extends Unit
{
    /**
     * @dataProvider dataRun
     */
    public function testRun(string $name): void
    {
        $job = new HelloJob([
            'name' => $name,
        ]);

        $method = new \ReflectionMethod(HelloJob::class, 'run');
        $method->setAccessible(true);
        ob_start();
        $method->invoke($job);
        $output = ob_get_contents();
        ob_end_flush();
        $this->assertContains($name, $output);
    }

    public function dataRun(): array
    {
        return [
            ['foo'],
            ['bar'],
        ];
    }
}
