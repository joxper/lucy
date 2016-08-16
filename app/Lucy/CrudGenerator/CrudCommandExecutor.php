<?php

namespace App\Lucy\CrudGenerator;

use Artisan;

class CrudCommandExecutor
{
    /**
     * The CrudCommandBuilder instance.
     * 
     * @var \App\Lucy\CrudGenerator\CrudCommandBuilder
     */
    protected $builder;

    /**
     * Create a new excecutor instance.
     * 
     * @param  \App\Lucy\CrudGenerator\CrudCommandBuilder  $builder
     * @return void
     */
    public function __construct(CrudCommandBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Call all the commands.
     *
     * @return void
     */
    public function call()
    {
        foreach (config('lucy.crud') as $type) {
            if ($this->builder->getAttribute($type)) {
                $method = 'call'.ucfirst(strtolower($type));

                $this->{$method}();
            }
        }
    }

    /**
     * Call the migration command and migrate the table.
     * 
     * @return void
     */
    public function callMigration()
    {
        Artisan::call('lucy:migration', $this->builder->getAttribute('migration'));

        Artisan::call('migrate');
    }

    /**
     * Call the model command.
     * 
     * @return void
     */
    public function callModel()
    {
        Artisan::call('lucy:model', $this->builder->getAttribute('model'));
    }

    /**
     * Call the request command.
     * 
     * @return void
     */
    public function callRequest()
    {
        Artisan::call('lucy:request', $this->builder->getAttribute('request'));
    }

    /**
     * Call the controller command.
     * 
     * @return void
     */
    public function callController()
    {
        Artisan::call('lucy:controller', $this->builder->getAttribute('controller'));
    }

    /**
     * Call the view command.
     *
     * @return void
     */
    public function callView()
    {
        Artisan::call('lucy:view', $this->builder->getAttribute('view'));
    }

    /**
     * Call the route command.
     *
     * @return void
     */
    public function callRoute()
    {
        Artisan::call('lucy:route', $this->builder->getAttribute('route'));
    }
}
