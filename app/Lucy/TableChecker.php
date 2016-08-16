<?php

namespace App\Lucy;

use DB;
use InvalidArgumentException;

class TableChecker
{
    /**
     * The database driver.
     *
     * @var string
     */
    protected $driver;

    /**
     * Create a new instance.
     *
     * @return void
     *
     * @throws \InvalidArgumentException
     */
    public function __construct()
    {
        $this->driver = config('database.default');

        if (! in_array($this->driver, ['mysql', 'pgsql'])) {
            throw new InvalidArgumentException("Invalid database driver: {$this->driver}.");
        }
    }

    /**
     * Array of tables.
     *
     * @param  bool  $dropdown
     * @return array
     */
    public function tables($dropdown = false)
    {
        $query = $this->queryTable()->orderBy('table_name');

        if ($dropdown) {
            return $query->lists('table_name', 'table_name');
        }

        return $query->pluck('table_name');
    }

    /**
     * Check if given table is already exists.
     *
     * @param  string  $table
     * @return bool
     */
    public function isExists($table)
    {
        return ! empty($this->queryTable()->where('table_name', $table)->get());
    }

    /**
     * Get columns from given table.
     *
     * @param  string  $table
     * @param  bool  $dropdown
     * @return array
     */
    public function columns($table, $dropdown = false)
    {
        $query = $this->queryColumn($table)->orderBy('column_name');

        if ($dropdown) {
            return $query->lists('column_name', 'column_name');
        }

        return $query->pluck('column_name');
    }

    /**
     * Get query for check table(s).
     *
     * @return \Illuminate\Database\Query\Builder
     */
    protected function queryTable()
    {
        switch ($this->driver) {
            case 'mysql':
                return DB::table('information_schema.tables')->where('table_schema', env('DB_DATABASE', 'lucy'));
                break;
            case 'pgsql':
                return DB::table('information_schema.tables')->where('table_type', 'BASE TABLE')->whereNotIn('table_schema', ['pg_catalog', 'information_schema']);
                break;
        }
    }

    /**
     * Get query for check column(s).
     *
     * @param  string  $table
     * @return void
     */
    protected function queryColumn($table)
    {
        switch ($this->driver) {
            case 'mysql':
                $column = 'table_schema';
                break;
            case 'pgsql':
                $column = 'table_catalog';
                break;
        }

        return DB::table('information_schema.columns')->where($column, env('DB_DATABASE', 'lucy'))->where('table_name', $table);
    }
}
