<?php

namespace App\Lucy\CrudGenerator\Commands;

use App\Models\Module;
use Illuminate\Support\Composer;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Console\GeneratorCommand as BaseGeneratorCommand;

abstract class GeneratorCommand extends BaseGeneratorCommand
{
    /**
     * The Composer instance.
     * 
     * @var \Illuminate\Support\Composer
     */
    protected $composer;

    /**
     * The Module instance.
     *
     * @var \App\Models\Module
     */
    protected $module;

    /**
     * Create a new generator command instance.
     * 
     * @param  \Illuminate\Filesystem\Filesystem  $filesystem
     * @param  \Illuminate\Support\Composer  $composer
     * @return void
     */
    public function __construct(Filesystem $filesystem, Composer $composer)
    {
        parent::__construct($filesystem);

        $this->composer = $composer;
    }

    /**
     * {@inheritDoc}
     */
    protected function getArguments()
    {
        //
    }

    /**
     * Save the file path to database.
     *
     * @param  null|string  $path
     * @return void
     */
    protected function saveFilePath($path = null)
    {
        if (! $id = $this->option('module')) {
            $this->error('Please specify the module.');
            exit();
        }

        $module = ($this->module = Module::findOrFail($id));
        $module->files()->create([
            'path' => $path ? $path : $this->getPath($this->parseName($this->getNameInput())),
        ]);
    }

    /**
     * {@inheritDoc}
     */
    public function fire()
    {
        $this->saveFilePath();

        parent::fire();
    }
}
