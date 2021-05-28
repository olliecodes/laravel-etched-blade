<?php

namespace OllieCodes\Etched;

use Illuminate\Contracts\View\Engine;
use Illuminate\Filesystem\Filesystem;

class EtchedEngine implements Engine
{
    /**
     * @var \OllieCodes\Etched\Etched
     */
    private $etched;

    /**
     * The filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;

    /**
     * Create a new etched engine instance.
     *
     * @param \OllieCodes\Etched\Etched         $etched
     * @param \Illuminate\Filesystem\Filesystem $files
     */
    public function __construct(Etched $etched, Filesystem $files)
    {
        $this->etched = $etched;
        $this->files  = $files;
    }

    /**
     * Get the evaluated contents of the view.
     *
     * @param string $path
     * @param array  $data
     *
     * @return string
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function get($path, array $data = []): string
    {
        return $this->etched->render($this->files->get($path), $data['theme'] ?? null);
    }
}