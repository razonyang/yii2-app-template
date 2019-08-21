<?php
namespace App\Tests\Validator;

use App\Validator\UrlValidator;
use Codeception\Test\Unit;

class UrlValidatorTest extends Unit
{
    /**
     * @dataProvider dataProviderUrl
     */
    public function testValidateValue(string $url, bool $valid, array $config = []): void
    {
        $validator = new UrlValidator($config);
        $method = new \ReflectionMethod(UrlValidator::class, 'validateValue');
        $method->setAccessible(true);
        $result = $method->invoke($validator, $url);
        if ($valid) {
            $this->assertNull($result);
        } else {
            $this->assertTrue(is_array($result));
            $this->assertCount(2, $result);
        }
    }

    public function dataProviderUrl(): array
    {
        return [
            ['http://localhost', true],
            ['http://localhost:8080', true],
            ['localhost:8080', false],
            ['ftp://localhost:8080', false],
        ];
    }
}
