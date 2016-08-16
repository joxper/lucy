<?php

namespace App\Lucy\CrudGenerator\Commands;

class CrudModelCommand extends GeneratorCommand
{
    /**
     * {@inheritDoc}
     */
    protected $signature = 'lucy:model {name : The model\'s name.}
            {--table= : The table that associated with the model.}
            {--columns= : The column of the table that associated with the model (example: column|column).}
            {--pk=id : The primary key column.}
            {--soft-deletes : Whether the model should use soft deletes feature.}
            {--relationships= : The model\'s relationships (example: foreign_key:table|another_foreign_key:another_table).}
            {--module= : The ID of the module.}';

    /**
     * {@inheritDoc}
     */
    protected $description = 'Create a new Eloquent model class';

    /**
     * {@inheritDoc}
     */
    protected $type = 'Model';

    /**
     * {@inheritDoc}
     */
    protected function getStub()
    {
        return __DIR__.'/../stubs/model.stub';
    }

    /**
     * {@inheritDoc}
     */
    protected function getPath($name)
    {
        $name = str_replace('\\', '/', str_replace($this->laravel->getNamespace(), '', $name));

        return app_path($name.'.php');
    }

    /**
     * {@inheritDoc}
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Models\Modules';
    }

    /**
     * {@inheritDoc}
     */
    protected function parseName($name)
    {
        $name = studly_case($name);

        $rootNamespace = $this->laravel->getNamespace();

        if (starts_with($name, $rootNamespace)) {
            return $name;
        }

        if (str_contains($name, '/')) {
            $name = str_replace('/', '\\', $name);
        }

        return $this->parseName($this->getDefaultNamespace(trim($rootNamespace, '\\')).'\\'.$name);
    }

    /**
     * {@inheritDoc}
     */
    protected function buildClass($name)
    {
        $stub = $this->files->get($this->getStub());

        return $this->replaceTableName($stub)->replaceFillable($stub)->replaceSoftDeletes($stub)->replacePrimaryKey($stub)->replaceDatatables($stub)->replaceRelationships($stub)->replaceNamespace($stub, $name)->replaceClass($stub, $name);
    }

    /**
     * Replace the soft deletes.
     * 
     * @param  string  $stub
     * @return \App\Lucy\CrudGenerator\Commands\CrudModelCommand
     */
    protected function replaceSoftDeletes(&$stub)
    {
        if (! $this->option('soft-deletes')) {
            $stub = str_replace('{{softDeletes}}', '', $stub);
            $stub = str_replace('{{useSoftDeletes}}', '', $stub);
            $stub = str_replace('{{datesProperty}}', '', $stub);
        } else {
            $stub = str_replace('{{softDeletes}}', PHP_EOL.'use Illuminate\Database\Eloquent\SoftDeletes;', $stub);
            $stub = str_replace('{{useSoftDeletes}}', PHP_EOL.str_repeat(' ', 4).'use SoftDeletes;'.PHP_EOL, $stub);
            $stub = str_replace('{{datesProperty}}', $this->datesAttribute(), $stub);
        }

        return $this;
    }

    /**
     * Replace the primary key column.
     * 
     * @param  string  $stub
     * @return \App\Lucy\CrudGenerator\Commands\CrudModelCommand
     */
    protected function replacePrimaryKey(&$stub)
    {
        $stub = str_replace('{{pk}}', trim($this->option('pk')), $stub);

        return $this;
    }

    /**
     * Generate the $dates attribute for soft delete feature.
     * 
     * @return string
     */
    protected function datesAttribute()
    {
        return str_repeat(PHP_EOL, 2).str_repeat(' ', 4).'/**'.PHP_EOL.str_repeat(' ', 5).'* {@inheritDoc}'.PHP_EOL.str_repeat(' ', 5).'*/'.PHP_EOL.str_repeat(' ', 4)."protected \$dates = ['deleted_at'];";
    }

    /**
     * Replace the table's name.
     * 
     * @param  string  $stub
     * @return \App\Lucy\CrudGenerator\Commands\CrudModelCommand
     */
    protected function replaceTableName(&$stub)
    {
        if (! $this->option('table')) {
            $tableName = strtolower(str_plural($this->argument('name')));
        } else {
            $tableName = strtolower($this->option('table'));
        }

        $stub = str_replace('{{table}}', $tableName, $stub);

        return $this;
    }

    /**
     * Replace the datatables method.
     * 
     * @param  string  $stub
     * @return \App\Lucy\CrudGenerator\Commands\CrudModelCommand
     */
    protected function replaceDatatables(&$stub)
    {
        $stub = str_replace('{{datatables}}', '', $stub);

        return $this;
    }

    /**
     * Replace all relationships.
     * 
     * @param  string  $stub
     * @return \App\Lucy\CrudGenerator\Commands\CrudModelCommand
     */
    protected function replaceRelationships(&$stub)
    {
        $replace = '';

        if ($relationships = $this->option('relationships')) {
            $replace = $this->buildRelationships($relationships);
        }

        $stub = str_replace('{{relationship}}', $replace, $stub);

        return $this;
    }

    /**
     * Build the given relationships option.
     *
     * @param  string  $relationships
     * @return string
     */
    protected function buildRelationships($relationships)
    {
        $return = '';
        $format = str_repeat(PHP_EOL, 2).str_repeat(' ', 4)."public function %s()".PHP_EOL.str_repeat(' ', 4)."{".PHP_EOL.str_repeat(' ', 8)."return \$this->belongsTo(%s::class, '%s');".PHP_EOL.str_repeat(' ', 4)."}";

        foreach (explode('|', $relationships) as $column) {
            list($column, $table) = explode(':', $column);

            $class = studly_case(str_singular($table));
            $method = lcfirst(studly_case(str_replace('_id', '', $column)));

            $return .= sprintf($format, $method, $class, $column);
        }

        return $return;
    }

    /**
     * Replace the fillables.
     * 
     * @param  string  $stub
     * @return \App\Lucy\CrudGenerator\Commands\CrudModelCommand
     */
    protected function replaceFillable(&$stub)
    {
        if (! $this->option('columns')) {
            $this->error('Please specify the columns of the table.');
            exit();
        }

        $columns = explode('|', $this->option('columns'));
        $replace = '';

        foreach ($columns as $column) {
            $replace .= "'{$column}', ";
        }

        $stub = str_replace('{{fillable}}', trim($replace), $stub);

        return $this;
    }
}
