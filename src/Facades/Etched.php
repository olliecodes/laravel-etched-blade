<?php

namespace OllieCodes\Etched\Facades;

use Illuminate\Support\Facades\Facade;
use OllieCodes\Etched\Theme;

/**
 * Etched Facade
 *
 * @method static Theme theme(string|null $name = null)
 * @method static string render(string $content, string|null $themeName = null)
 *
 * @package OllieCodes\Etched\Facades
 */
class Etched extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \OllieCodes\Etched\Etched::class;
    }
}