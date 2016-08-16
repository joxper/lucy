<?php

namespace App\Lucy\CrudGenerator\Commands;

class CrudControllerCommand extends GeneratorCommand
{
    /**
     * {@inheritDoc}
     */
    protected $signature = 'lucy:controller {name : The class name.}
            {--model= : The model\'s class name.}
            {--request= : The form request\'s class name.}
            {--permissions= : The permissions of the module.}
            {--view-folder= : The view folder.}
            {--fields= : The fields of the module.}
            {--module= : The ID of the module.}';

    /**
     * {@inheritDoc}
     */
    protected $description = 'Create a new controller class';

    /**
     * {@inheritDoc}
     */
    protected $type = 'Controller';

    /**
     * {@inheritDoc}
     */
    protected function getStub()
    {
        return __DIR__.'/../stubs/controller.stub';
    }

    /**
     * {@inheritDoc}
     */
    protected function getPath($name)
    {
        $name = str_replace('\\', '/', str_replace($this->laravel->getNamespace(), '', $name));

        return app_path($name.'Controller.php');
    }

    /**
     * {@inheritDoc}
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Http\Controllers\Modules';
    }

    /**
     * {@inheritDoc}
     */
    protected function buildClass($name)
    {
        $stub = $this->files->get($this->getStub());

        return $this->replaceModelClass($stub)->replaceRequestClass($stub)->replaceNamespace($stub, $name)->replacePermissions($stub)->replaceViewFiles($stub)->replaceDataToBind($stub)->replaceObject($stub)->replaceClass($stub, $name);
    }

    /**
     * Replace the model's class name.
     * 
     * @param  string  $stub
     * @return \App\Lucy\CrudGenerator\Commands\CrudControllerCommand
     */
    protected function replaceModelClass(&$stub)
    {
        if (! $this->option('model')) {
            $this->error('Please specify the model.');
            exit();
        }

        $stub = str_replace('ModelClass', $this->option('model'), $stub);

        return $this;
    }

    /**
     * Replace the form request's class name.
     * 
     * @param  string  $stub
     * @return \App\Lucy\CrudGenerator\Commands\CrudControllerCommand
     */
    protected function replaceRequestClass(&$stub)
    {
        if (! $this->option('request')) {
            $this->error('Please specify the form request.');
            exit();
        }

        $stub = str_replace('RequestClass', $this->option('request'), $stub);

        return $this;
    }

    /**
     * Replace all the permissions.
     * 
     * @param  string  $stub
     * @return \App\Lucy\CrudGenerator\Commands\CrudControllerCommand
     */
    protected function replacePermissions(&$stub)
    {
        if (! $this->option('permissions')) {
            $this->error('Please specify the permissions.');
            exit();
        }

        foreach (explode('|', $this->option('permissions')) as $permission) {
            $permission = explode(':', $permission);

            $stub = str_replace('{{permission.'.$permission[0].'}}', $permission[1], $stub);
        }

        return $this;
    }

    /**
     * Replace the view files.
     *
     * @param  string  $stub
     * @return \App\Lucy\CrudGenerator\Commands\CrudControllerCommand
     */
    protected function replaceViewFiles(&$stub)
    {
        if (! $this->option('view-folder')) {
            $this->error('Please specify the view folder.');
            exit();
        }

        $view = 'modules.'.$this->option('view-folder');

        $stub = str_replace('{{index.view}}', $view.'.index', $stub);
        $stub = str_replace('{{view.view}}', $view.'.view', $stub);
        $stub = str_replace('{{form.view}}', $view.'.form', $stub);

        return $this;
    }

    /**
     * Replace data to bind.
     *
     * @param  string  $stub
     * @return \App\Lucy\CrudGenerator\Commands\CrudControllerCommand
     */
    protected function replaceDataToBind(&$stub)
    {
        if (! $this->option('fields')) {
            $this->error('Please specify the fields.');
            exit();
        }

        foreach (explode('|', $this->option('fields')) as $field) {
            $field = "'{$field}' => null,";
            if (isset($replace)) {
                $replace .= PHP_EOL.str_repeat(' ', 12).$field;
            } else {
                $replace = $field;
            }
        }

        $stub = str_replace('{{data_to_bind}}', $replace, $stub);

        return $this;
    }

    /**
     * Replace the "object" string for logging.
     *
     * @param  string  $stub
     * @return \App\Lucy\CrudGenerator\Commands\CrudControllerCommand
     */
    protected function replaceObject(&$stub)
    {
        $stub = str_replace('{{ object }}', $this->option('model'), $stub);

        return $this;
    }
}
