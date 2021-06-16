<?php

namespace OllieCodes\Etched\Tests;

use OllieCodes\Etched\EtchedServiceProvider;
use OllieCodes\Etched\Tests\Fixtures\LoadsContentForTests;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    use LoadsContentForTests;

    public function getPackageProviders($app): array
    {
        return [
            EtchedServiceProvider::class,
        ];
    }

    protected function defineEnvironment($app): void
    {
        $app['config']->set('etched', require __DIR__ . '/../config/etched.php');
        $app['view']->addNamespace('fixtures', __DIR__.'/Fixtures/content/views');
    }
}