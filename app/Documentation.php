<?php

namespace App;

use Cache;
use Illuminate\Filesystem\Filesystem;

class Documentation
{
    /**
     * The Filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;

    /**
     * Create a new documentation instance.
     *
     * @param  \Illuminate\Filesystem\Filesystem  $files
     * @return void
     */
    public function __construct(Filesystem $files)
    {
        $this->files = $files;
    }

    /**
     * Get the given documentation page.
     *
     * @param  string  $page
     * @return null|string
     */
    public function get($page = 'installation')
    {
        return Cache::remember('docs.'.$page, 5, function () use ($page) {
            $path = base_path('resources/docs/'.$page.'.md');

            if ($this->files->exists($path)) {
                return markdown($this->files->get($path));
            }

            return null;
        });
    }
}
