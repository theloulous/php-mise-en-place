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

    public function testIterator()
    {
        $testedInstance = new class('7.2') extends Configuration {
            public function __construct(string $version)
            {
                $this->rules = [
                    'rule_bool' => true,
                    'rule_string' => 'single',
                    'rule_array' => ['align' => 'equals', 'align_double_arrow' => true],
                ];
            }
        };

        $result = [];
        foreach ($testedInstance as $item => $value) {
            $result[$item] = $value;
        }

        self::assertSame('true', $result['rule_bool']);
        self::assertSame("'single'", $result['rule_string']);
        self::assertSame("['align' => 'equals','align_double_arrow' => true,]", $result['rule_array']);
    }
}