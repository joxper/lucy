<?php

namespace App\Lucy\CrudGenerator\Commands;

use App\Models\Module;

class CrudRouteCommand extends GeneratorCommand
{
    /**
     * {@inheritDoc}
     */
    protected $signature = 'lucy:route {name : The module\'s name.}
            {--controller= : The controller class.}
            {--view= : The "view" permission.}
            {--create= : The "create" permission.}
            {--edit= : The "edit" permission.}
            {--delete= : The "delete" permission.}
            {--module= : The ID of the module.}
            {--only-update : Only run update `module_routes.php`.}';

    /**
     * {@inheritDoc}
     */
    protected $description = 'Create route file for the module.';

    /**
     * {@inheritDoc}
     */
    protected $type = 'Route';

    /**
     * The route file name.
     *
     * @var string
     */
    protected $route;

    /**
     * {@inheritDoc}
     */
    protected function getStub()
    {
        //
    }

    /**
     * Get the route stub file for the generator.
     *
     * @return string
     */
    protected function getRouteStub()
    {
        return __DIR__.'/../stubs/route.stub';
    }

    /**
     * Get the module routes stub file for the generator.
     *
     * @return string
     */
    protected function getModuleRoutesStub()
    {
        return __DIR__.'/../stubs/module_routes.stub';
    }

    /**
     * Get the destination route path.
     *
     * @return string
     */
    protected function getRoutePath()
    {
        return app_path(sprintf('Http/Routes/%s_routes.php', $this->route));
    }

    /**
     * Get the destination module routes path.
     *
     * @return string
     */
    protected function getModuleRoutesPath()
    {
        return app_path('Http/module_routes.php');
    }

    /**
     * {@inheritDoc}
     */
    public function fire()
    {
        $this->route = snake_case($this->argument('name'));
        if (! empty($this->module->url)) {
            $this->route = $this->module->url;
        }

        if (! $this->option('only-update')) {
            $this->fireRoute();
        }
        
        $this->fireModuleRoutes();

        $this->info($this->type.' created successfully.');
    }

    /**
     * {@inheritDoc}
     */
    protected function alreadyExists($rawName)
    {
        return $this->files->exists($rawName);
    }

    /**
     * Execute the route command.
     *
     * @return bool|null
     */
    protected function fireRoute()
    {
        $path = $this->getRoutePath();

        if ($this->alreadyExists($path)) {
            $this->error('Route already exists!');

            return false;
        }

        $this->files->put($path, $this->buildRoute());

        $this->saveFilePath($path);
    }

    /**
     * Execute the module routes command.
     *
     * @return bool|null
     */
    protected function fireModuleRoutes()
    {
        $path = $this->getModuleRoutesPath();

        if ($this->alreadyExists($path)) {
            @unlink($path);
        }

        $this->files->put($path, $this->buildModuleRoutes());
    }

    /**
     * Build the route.
     *
     * @return string
     */
    protected function buildRoute()
    {
        if (! $this->option('controller')) {
            $this->error('Please specify the controller.');
            exit();
        }

        $stub = $this->files->get($this->getRouteStub());

        $route = $this->route;
        $controller = sprintf('Modules\%sController', $this->option('controller'));
        foreach (['view', 'create', 'edit', 'delete'] as $permission) {
            if (! $this->option($permission)) {
                $this->error(sprintf('Please specify the %s permission.', $permission));

                return false;
            }

            $$permission = trim($this->option($permission));
        }

        $replace = "LucyRoute::get('{$route}', '{$controller}@index', '{$view}');".PHP_EOL."LucyRoute::get('{$route}/datatables', '{$controller}@datatables', '{$view}');".PHP_EOL."LucyRoute::get('{$route}/create', '{$controller}@create', '{$create}');".PHP_EOL."LucyRoute::post('{$route}', '{$controller}@store', '{$create}');".PHP_EOL."LucyRoute::get('{$route}/{id}/edit', '{$controller}@edit', '{$edit}');".PHP_EOL."LucyRoute::put('{$route}/{id}', '{$controller}@update', '{$edit}');".PHP_EOL."LucyRoute::get('{$route}/{id}', '{$controller}@show', '{$view}');".PHP_EOL."LucyRoute::delete('{$route}/{id}', '{$controller}@destroy', '{$delete}');";

        $stub = str_replace('{{Module}}', $this->argument('name'), $stub);
        $stub = str_replace('{{module}}', strtolower($this->argument('name')), $stub);

        return str_replace('{{routes}}', $replace, $stub);
    }

    /**
     * Build all the module routes.
     *
     * @return string
     */
    protected function buildModuleRoutes()
    {
        $replace = '';
        $stub = $this->files->get($this->getModuleRoutesStub());

        foreach ($this->getModuleRoutes() as $route) {
            $data = "require app_path('Http/Routes/{$route}');";

            if (strlen($replace)) {
                $replace .= PHP_EOL.$data;
            } else {
                $replace = $data;
            }
        }

        return str_replace('{{routes}}', $replace, $stub);
    }

    /**
     * Get all the module from database.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    protected function getModuleRoutes()
    {
        return Module::all()->transform(function ($module) {
            $routes = empty($module->url) ? snake_case($module->name) : $module->url;

            return $routes.'_routes.php';
        });
    }
}
