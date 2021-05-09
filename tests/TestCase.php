<?php

namespace Dcolsay\XML\Tests;

use Dcolsay\XML\XMLServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    public function setUp(): void
    {
        parent::setUp();
        // additional setup
    }

    protected function getPackageProviders($app)
    {
        return [
            XMLServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        // perform environment setup
    }

    public function getStubPath(string $name): string
    {
        return __DIR__."/stubs/{$name}";
    }
}
