<?php

namespace App\Lucy\CrudGenerator\Commands;

class CrudMigrationCommand extends GeneratorCommand
{
    /**
     * {@inheritDoc}
     */
    protected $signature = 'lucy:migration {name : The table\'s name.}
            {--columns= : The columns of the table (example: column:method,argument,...|column:method).}
            {--pk=id : The primary key column.}
            {--fk= : The foreign key of the table (example: user_id:users,id|book_id:books,id).}
            {--default= : The default value of the column (example: column:value|column:value).}
            {--nullable= : The column that should be nullable (example: column|column).}
            {--unsigned= : The column that should be unsigned (example: column|column).}
            {--comment= : Set the comment for the column (example: column:comment|column:comment).}
            {--no-timestamps : Whether the migration should not be timestamps-ed.}
            {--module= : The ID of the module.}';

    /**
     * {@inheritDoc}
     */
    protected $description = 'Create a new migration file';

    /**
     * {@inheritDoc}
     */
    protected $type = 'Migration';

    /**
     * The columns that should unsigned.
     *  
     * @var array
     */
    protected $shouldUnsigned = [];

    /**
     * Collection of paired column and it's default value.
     * 
     * @var array
     */
    protected $defaultValues = [];

    /**
     * Collection of paired column and it's comment.
     * 
     * @var array
     */
    protected $columnsThatHasComment = [];

    /**
     * The columns that shouldn't use arguments.
     *
     * @var array
     */
    protected $dontGiveArguments = [
        'bigInteger', 'boolean', 'date', 'dateTime', 'float', 'integer', 'longText', 'mediumInteger', 'mediumText', 'smallInteger', 'tinyInteger', 'timestamp',
    ];

    /**
     * {@inheritDoc}
     */
    protected function getStub()
    {
        return __DIR__.'/../stubs/migration.stub';
    }

    /**
     * {@inheritDoc}
     */
    protected function getPath($name)
    {
        $name = strtolower(str_replace($this->laravel->getNamespace(), '', $name));

        return database_path('migrations/').$this->getPrefix().'_create_'.$name.'_table.php';
    }

    /**
     * Get the filename's prefix.
     * 
     * @return string
     */
    public function getPrefix()
    {
        return date('Y_m_d_His');
    }

    /**
     * {@inheritDoc}
     */
    protected function buildClass($name)
    {
        if (! $this->option('columns')) {
            $this->error('Please specify the columns of the table.');
            exit();
        }

        $stub = $this->files->get($this->getStub());

        $tableName = strtolower($this->argument('name'));
        $className = 'Create'.studly_case($tableName).'Table';

        $columns = explode('|', $this->option('columns'));
        $tableSchema = $this->buildTableSchema($columns);

        return $this->replaceTableName($stub, $tableName)->replaceColumns($stub, $tableSchema)->replaceClass($stub, $className);
    }

    /**
     * Replace the table's name.
     * 
     * @param  string $stub
     * @param  string $tableName
     * @return \App\Lucy\CrudGenerator\Commands\CrudMigrationCommand
     */
    protected function replaceTableName(&$stub, $tableName)
    {
        $stub = str_replace('{{table}}', $tableName, $stub);

        return $this;
    }

    /**
     * Replace the columns.
     * 
     * @param  string $stub
     * @param  string $columns
     * @return \App\Lucy\CrudGenerator\Commands\CrudMigrationCommand
     */
    protected function replaceColumns(&$stub, $columns)
    {
        $stub = str_replace('{{columns}}', $columns, $stub);

        return $this;
    }

    /**
     * Build table's schema from column arguments.
     * 
     * @param  array  $columns
     * @return string
     */
    protected function buildTableSchema(array $columns)
    {
        $schema = $this->buildPrimaryKey();

        foreach ($columns as $column) {
            $schema .= $this->buildColumn($column);
        }

        $schema .= $this->buildTimestamps().$this->buildForeignKey();

        return $schema;
    }

    /**
     * Build the primary key column.
     * 
     * @return string
     */
    protected function buildPrimaryKey()
    {
        $primaryKey = $this->option('pk');

        return "\$table->increments('{$primaryKey}');";
    }

    /**
     * Build the timestamps columns.
     * 
     * @return string
     */
    protected function buildTimestamps()
    {
        if ($this->option('no-timestamps')) {
            return '';
        }

        return PHP_EOL.str_repeat(' ', 16)."\$table->timestamps();";
    }

    /**
     * Build the table's column.
     * 
     * @param  string $column
     * @return string
     */
    protected function buildColumn($column)
    {
        list($field, $parameters) = explode(':', $column);

        $parameters = explode(',', $parameters);
        $method = $parameters[0];

        $arguments = implode(', ', array_map(function ($string) {
            return trim($string);
        }, array_except($parameters, 0)));

        return PHP_EOL.str_repeat(' ', 16)."\$table->{$method}('{$field}'".$this->buildArguments($field, $method, $arguments).")".$this->buildDefault($field, $method).$this->buildUnsigned($field).$this->buildNullable($field).$this->buildComment($field).";";
    }

    /**
     * Build arguments for the given column.
     * 
     * @param  string  $column
     * @param  string  $method
     * @param  string  $arguments
     * @return string
     */
    protected function buildArguments($column, $method, $arguments)
    {
        if (! $arguments || in_array($column, $this->shouldUnsigned) || in_array($method, $this->dontGiveArguments)) {
            return '';
        }

        return ', '.$arguments;
    }

    /**
     * Build the foreign keys of the table.
     * 
     * @return string
     */
    protected function buildForeignKey()
    {
        if (! $this->option('fk')) {
            return '';
        }

        $foreign = PHP_EOL;
        $foreignKeys = explode('|', $this->option('fk'));

        foreach ($foreignKeys as $foreignKey) {
            list($column, $arguments) = explode(':', $foreignKey);
            list($on, $references) = explode(',', $arguments);

            $foreign .= PHP_EOL.str_repeat(' ', 16)."\$table->foreign('{$column}')->references('{$references}')->on('{$on}')->onDelete('cascade');";
        }

        return $foreign;
    }

    /**
     * Build unsigned for the given column.
     * 
     * @param  string $column
     * @return string
     */
    protected function buildUnsigned($column)
    {
        if (in_array($column, $this->shouldUnsigned)) {
            return '->unsigned()';
        }

        return '';
    }

    /**
     * Set the $shouldUnsigned attributes.
     *
     * @return void
     */
    protected function setUnsignedColumns()
    {
        if (! $this->option('fk') && ! $this->option('unsigned')) {
            return;
        }

        $shouldUnsigned = [];

        if ($this->option('unsigned')) {
            $shouldUnsigned = explode('|', $this->option('unsigned'));
        }

        if ($this->option('fk')) {
            foreach (explode('|', $this->option('fk')) as $foreign) {
                $foreign = explode(':', $foreign);

                if (! in_array($foreign[0], $shouldUnsigned)) {
                    $shouldUnsigned[] = $foreign[0];
                }
            }
        }

        $this->shouldUnsigned = $shouldUnsigned;
    }

    /**
     * Set the $defaultValues attributes.
     *
     * @return void
     */
    protected function setDefaultValues()
    {
        if ($this->option('default')) {
            foreach (explode('|', $this->option('default')) as $default) {
                list($column, $value) = explode(':', $default);

                $this->defaultValues[$column] = $value;
            }
        }
    }

    /**
     * Build default value for the given column and column type.
     * 
     * @param  string $column
     * @param  mixed  $value
     * @return string
     */
    protected function buildDefault($column, $columnType)
    {
        if (isset($this->defaultValues[$column])) {
            $value = $this->defaultValues[$column];

            set_type_by_column_type($value, $columnType);

            if (is_string($value)) {
                $value = "'{$value}'";
            }

            if (is_bool($value)) {
                if ($value) {
                    $value = 'true';
                } else {
                    $value = 'false';
                }
            }

            return "->default({$value})";
        }

        return '';
    }

    /**
     * Build nullable attribute to the given column.
     * 
     * @param  string $column
     * @return string
     */
    protected function buildNullable($column)
    {
        $columnsThatShouldBeNullable = explode('|', $this->option('nullable'));

        if (! in_array($column, $columnsThatShouldBeNullable)) {
            return '';
        }

        return '->nullable()';
    }

    /**
     * Build the comment to the given column.
     * 
     * @param  string $column
     * @return string
     */
    protected function buildComment($column)
    {
        if (! isset($this->columnsThatHasComment[$column])) {
            return '';
        }

        $comment = addslashes($this->columnsThatHasComment[$column]);

        return "->comment('{$comment}')";
    }

    /**
     * Set the $columnsThatHasComment attribute.
     *
     * @return void
     */
    protected function setComments()
    {
        if (! $this->option('comment')) {
            return;
        }

        $comments = explode('|', $this->option('comment'));

        foreach ($comments as $comment) {
            list($column, $value) = explode(':', $comment);

            $this->columnsThatHasComment[$column] = $value;
        }
    }

    /**
     * {@inheritDoc}
     */
    public function fire()
    {
        $this->setUnsignedColumns();

        $this->setDefaultValues();

        $this->setComments();

        parent::fire();

        $this->composer->dumpAutoloads();
    }
}
