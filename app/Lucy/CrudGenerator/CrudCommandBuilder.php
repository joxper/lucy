<?php

namespace App\Lucy\CrudGenerator;

use App\Models\Module;

class CrudCommandBuilder
{
    /**
     * The Module instance.
     * 
     * @var \App\Models\Module
     */
    protected $module;

    /**
     * The class name.
     * 
     * @var string
     */
    protected $class;

    /**
     * The table's name.
     * 
     * @var string
     */
    protected $table;

    /**
     * The columns of the table.
     * 
     * @var \Illuminate\Database\Eloquent\Collection
     */
    protected $columns;

    /**
     * The primary key of the table.
     * 
     * @var string
     */
    protected $primaryKey;

    /**
     * The arguments for migration command.
     * 
     * @var array
     */
    protected $migration;

    /**
     * The arguments for model command.
     * 
     * @var array
     */
    protected $model;

    /**
     * The arguments for request command.
     * 
     * @var array
     */
    protected $request;

    /**
     * The arguments for controller command.
     * 
     * @var array
     */
    protected $controller;

    /**
     * The arguments for view command.
     *
     * @var array
     */
    protected $view;

    /**
     * The arguments for route command.
     *
     * @var array
     */
    protected $route;

    /**
     * Create a new Builder instance.
     * 
     * @param  \App\Models\Module  $module
     * @param  bool  $rebuild
     * @return void
     */
    public function __construct(Module $module, $rebuild = false)
    {
        $this->init($module);

        foreach (config('lucy.crud') as $type) {
            $method = ($rebuild ? 're' : '').'build'.ucfirst(strtolower($type));

            $this->{$method}();
        }
    }

    /**
     * Initialize the builder.
     * 
     * @param  \App\Models\Module  $module
     * @return void
     */
    protected function init(Module $module)
    {
        $this->module = $module;
        $this->class = str_singular(studly_case($module->table_name));
        $this->table = $module->table_name;
        $this->columns = $module->tables;
        $this->primaryKey = $module->primary_key;
    }

    /**
     * Get the attribute's value.
     * 
     * @param  string  $attribute
     * @return array|string
     */
    public function getAttribute($attribute)
    {
        return $this->{$attribute};
    }

    /**
     * Build arguments for migration command.
     * 
     * @return void
     */
    protected function buildMigration()
    {
        $columns = [];
        $fk = [];
        $default = [];
        $nullable = [];
        $comment = [];

        foreach ($this->columns as $column) {
            $col = $column->column.':'.$column->method;

            if ($column->arguments) {
                $col .= ','.$column->arguments;
            }

            $columns[] = $col;

            if ($column->default) {
                $default[] = $column->column.':'.$column->default;
            }

            if ($column->comment) {
                $comment[] = $column->column.':'.$column->comment;
            }

            if ($column->is_foreign) {
                $fk[] = $column->column.':'.$column->table_foreign.','.$column->references_foreign;
            }

            if ($column->nullable) {
                $nullable[] = $column->column;
            }
        }

        $columns = ($columns) ? implode('|', $columns) : '';
        $fk = ($fk) ? implode('|', $fk) : '';
        $default = ($default) ? implode('|', $default) : '';
        $nullable = ($nullable) ? implode('|', $nullable) : '';
        $comment = ($comment) ? implode('|', $comment) : '';

        $migration = [
            'name' => $this->table,
            '--pk' => $this->primaryKey,
            '--module' => $this->module->id,
        ];

        foreach (['columns', 'fk', 'default', 'nullable', 'comment'] as $argument) {
            if (! empty($$argument)) {
                $migration['--'.$argument] = $$argument;
            }
        }

        $this->migration = $migration;
    }

    /**
     * Build arguments for model command.
     * 
     * @return void
     */
    protected function buildModel()
    {
        $columns = collect($this->columns)->pluck('column')->implode('|');
        $foreigns = $this->module->tables->where('is_foreign', true);

        $this->model = [
            'name' => $this->class,
            '--table' => $this->table,
            '--columns' => $columns,
            '--pk' => $this->primaryKey,
            '--module' => $this->module->id,
        ];

        if ($foreigns->count()) {
            $this->model['--relationships'] = $foreigns->transform(function ($foreign) {
                return $foreign->column.':'.$foreign->table_foreign;
            })->implode('|');
        }
    }

    /**
     * Build arguments for request command.
     * 
     * @return void
     */
    protected function buildRequest()
    {
        $rules = collect($this->columns)->pluck('column')->transform(function ($rule) {
            return $rule.':required';
        })->implode('|');

        $this->request = [
            'name' => $this->class,
            '--rules' => $rules,
            '--module' => $this->module->id,
        ];
    }

    /**
     * Build arguments for controller command.
     * 
     * @return void
     */
    protected function buildController()
    {
        $columns = collect($this->columns)->pluck('column')->implode('|');

        $permissions = [
            'create:'.$this->module->createPermission->name,
            'edit:'.$this->module->editPermission->name,
            'delete:'.$this->module->deletePermission->name,
        ];

        $this->controller = [
            'name' => $this->class,
            '--model' => $this->class,
            '--request' => $this->class.'Request',
            '--permissions' => implode('|', $permissions),
            '--view-folder' => snake_case($this->module->name),
            '--fields' => $columns,
            '--module' => $this->module->id,
        ];
    }

    /**
     * Build arguments for view command.
     *
     * @return void
     */
    protected function buildView()
    {
        $table = $this->columns;

        $columns = $table->map(function ($column) {
            return $column->column.':'.$column->method.','.$column->caption;
        })->implode('|');

        $dropdown = $table->filter(function ($column) {
            return true == $column->is_foreign;
        })->transform(function ($column) {
            return $column->column.':'.$column->table_foreign;
        })->implode('|');

        $this->view = [
            'name' => $this->module->name,
            '--columns' => $columns,
            '--controller' => $this->class,
            '--request' => $this->class,
            '--module' => $this->module->id,
            '--dropdown' => $dropdown,
            '--icon' => $this->module->icon,
        ];
    }

    /**
     * Build arguments for route command.
     *
     * @return void
     */
    protected function buildRoute()
    {
        $module = $this->module;

        $this->route = [
            'name' => $module->name,
            '--controller' => $this->class,
            '--view' => $module->showPermission->name,
            '--create' => $module->createPermission->name,
            '--edit' => $module->editPermission->name,
            '--delete' => $module->deletePermission->name,
            '--module' => $module->id,
        ];
    }
}
