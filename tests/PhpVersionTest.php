<?php

namespace App;

use PHPUnit\Framework\TestCase;

class PhpVersionTest extends TestCase
{
    public function providerCurrentVersions()
    {
        return [
            ['5.6'],
            ['7.0'],
            ['7.1'],
            ['7.2'],
            ['7.3'],
        ];
    }

    /**
     * @dataProvider providerCurrentVersions
     */
    public function testCurrentVersions($version)
    {
        $testedInstance = new \App\PhpVersion($version);

        self::assertInstanceOf(PhpVersion::class, $testedInstance);
    }

    public function testGreaterThan()
    {
        $testedInstance = new \App\PhpVersion(7.1);

        self::assertFalse($testedInstance->isGreaterThan('7.3'));
        self::assertTrue($testedInstance->isGreaterThan('7.0'));
    }

    public function providerNotValidVersions()
    {
        return [
            ['5.4'],
            ['5.5'],
            ['7.4'],
            ['foo'],
        ];
    }

    /**
     * @dataProvider providerNotValidVersions
     */
    public function testVersionNotValid($version)
    {
        $this->expectException(\App\PhpVersionException::class);
        $this->expectExceptionMessage('This version of php is not valid.');

        new \App\PhpVersion($version);
    }
}
