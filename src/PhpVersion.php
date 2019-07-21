<?php

namespace App;

class PhpVersion
{
    public const CURRENT_VERSIONS = [
        '5.6',
        '7.0',
        '7.1',
        '7.2',
        '7.3',
    ];

    /** @var string */
    private $version;

    /**
     * @throws PhpVersionException
     */
    public function __construct(string $version)
    {
        $this->shouldBeAValidVersion($version);
        $this->version = $version;
    }

    /**
     * @throws PhpVersionException
     */
    public function isGreaterThan(string $targetVersion) : bool
    {
        $this->shouldBeAValidVersion($targetVersion);
        return (float) $this->version > (float) $targetVersion;
    }

    /**
     * @param string $version
     * @throws PhpVersionException
     */
    private function shouldBeAValidVersion(string $version)
    {
        if (!\in_array($version, self::CURRENT_VERSIONS)) {
            throw new PhpVersionException('This version of php is not valid.');
        }
    }
}

class PhpVersionException extends \Exception
{
}
