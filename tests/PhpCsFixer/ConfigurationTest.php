<?php

namespace App\PhpCsFixer;

use PHPUnit\Framework\TestCase;

class ConfigurationTest extends TestCase
{
    public function testGetRule()
    {
        $testedInstance = new Configuration('7.0');

        self::assertInstanceOf(Configuration::class, $testedInstance);
        self::assertTrue($testedInstance->getRule('@PSR2'));
        self::assertNull($testedInstance->getRule('@PHP70Migration'));

        $testedInstance = new Configuration('7.1');

        self::assertInstanceOf(Configuration::class, $testedInstance);
        self::assertTrue($testedInstance->getRule('@PSR2'));
        self::assertTrue($testedInstance->getRule('@PHP70Migration'));
    }
}