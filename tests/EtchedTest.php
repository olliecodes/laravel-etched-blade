<?php

namespace OllieCodes\Etched\Tests;

use OllieCodes\Etched\Etched;
use OllieCodes\Etched\EtchedServiceProvider;
use Orchestra\Testbench\TestCase;

class EtchedTest extends TestCase
{
    public function getPackageProviders($app): array
    {
        return [
            EtchedServiceProvider::class
        ];
    }

    protected function defineEnvironment($app): void
    {
        $app['config']->set('etched', require __DIR__.'/../config/etched.php');
    }

    /**
     * @test
     */
    public function testsSomething(): void
    {
        $etched  = $this->app->make(Etched::class);
        $content = file_get_contents(__DIR__ . '/Fixtures/markdown/simple-test.md');

        dd($etched->render($content));
    }

    /**
     * @test
     */
    public function testsSomethingTailwind(): void
    {
        $etched  = $this->app->make(Etched::class);
        $content = file_get_contents(__DIR__ . '/Fixtures/markdown/tailwind-test.md');

        dd($etched->render($content));
    }
}