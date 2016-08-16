<?php

namespace App\Http\Controllers;

use Artisan;
use Closure;
use Validator;
use App\Models\Role;
use App\Models\Module;
use LucyGuard as Guard;
use App\Models\Permission;
use App\Lucy\TableChecker;
use Illuminate\Http\Request;
use App\Http\Requests\CreateCrudRequest;
use App\Lucy\CrudGenerator\CrudCommandBuilder;
use App\Lucy\CrudGenerator\CrudCommandExecutor;

class CrudGeneratorController extends Controller
{
    /**
     * The Module instance.
     *
     * @var \App\Models\Module
     */
    protected $module;

    /**
     * The TableChecker instance.
     *
     * @var \App\Lucy\TableChecker
     */
    protected $tableChecker;

    /**
     * Permissions for datatables.
     *
     * @var array
     */
    protected $datatablesPermissions = [
        'edit' => 'crud.edit',
        'delete' => 'crud.delete',
    ];

    /**
     * Create a new controller instance.
     *
     * @param  \App\Models\Module  $module
     * @param  \App\Lucy\TableChecker  $tableChecker
     * @return void
     */
    public function __construct(Module $module, TableChecker $tableChecker)
    {
        $this->module = $module;
        $this->tableChecker = $tableChecker;
    }

    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('crudgenerator.index');
    }

    /**
     * Show the form for creating a new resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'dropdownColumns' => collect(config('lucy.columns'))->sort()->toArray(),
            'form' => [
                'url' => action(route_action($this, 'store')),
            ],
            'dropdownTables' => $this->getTables(),
            'dropdownRelationship' => config('lucy.relationship'),
        ];

        return view('crudgenerator.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CreateCrudRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCrudRequest $request)
    {
        // Check if the table's columns is empty...
        $columns = $this->prepareColumns($request->input('columns'));

        if ($columns->isEmpty()) {
            return back_with_message(trans('lucy.message.columns-empty'));
        }

        // Make sure the table's columns have no duplicate values...
        $validation = Validator::make($request->all(), ['columns.*.name' => 'distinct|not_in:id,ID,Id,iD,created_at,updated_at']);

        if ($validation->fails()) {
            return back_with_message(trans('lucy.message.columns-distinct-id'));
        }

        // Check if table is exists...
        if ($this->isTableExists($request->input('table'))) {
            return back_with_message(trans('lucy.message.table-exists'));
        }

        return $this->transaction(function () use ($request, $columns) {
            $permissions = $this->createPermissions($request);

            $module = $this->module->create([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'table_name' => $request->input('table'),
                'create_permission' => $permissions['create'],
                'delete_permission' => $permissions['delete'],
                'edit_permission' => $permissions['edit'],
                'show_permission' => $permissions['view'],
                'user_id' => user_info('id'),
                'icon' => $request->input('icon'),
                'url' => snake_case($request->input('name')),
            ]);

            foreach ($this->prepareModuleTables($columns->all())->all() as $column) {
                $module->tables()->create($column);
            }

            $executor = $this->newCrudExecutor($this->newCrudBuilder($module));
            $executor->call();

            lucy_log(trans('lucy.log.create-module', ['module' => $module->name]));
        });
    }

    /**
     * Get all tables.
     * 
     * @return array
     */
    protected function getTables()
    {
        return $this->tableChecker->tables(true);
    }

    /**
     * Check if given table is exists.
     *
     * @param  string  $table
     * @return bool
     */
    protected function isTableExists($table)
    {
        return $this->tableChecker->isExists($table);
    }

    /**
     * Get all columns by given table.
     * 
     * @param  string  $table
     * @return array
     */
    protected function getColumnsByTable($table)
    {
        return $this->tableChecker->columns($table, true);
    }

    /**
     * Return json encoded columns by given table.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function columns(Request $request)
    {
        return response()->json($this->getColumnsByTable($request->input('table')));
    }

    /**
     * Prepare the table's columns.
     * 
     * @param  array  $columns
     * @return \Illuminate\Support\Collection
     */
    protected function prepareColumns(array $columns)
    {
        return collect($columns)->filter(function ($column) {
            if (! empty($column['name'])) {
                return $column;
            }
        });
    }

    /**
     * Create a new CrudCommandBuilder instance.
     * 
     * @param  \App\Models\Module  $module
     * @return \App\Lucy\CrudGenerator\CrudCommandBuilder
     */
    protected function newCrudBuilder(Module $module)
    {
        return new CrudCommandBuilder($module);
    }

    /**
     * Create a new CrudCommandExecutor instance.
     * 
     * @param  \App\Lucy\CrudGenerator\CrudCommandBuilder  $builder
     * @return \App\Lucy\CrudGenerator\CrudCommandExecutor
     */
    protected function newCrudExecutor(CrudCommandBuilder $builder)
    {
        return new CrudCommandExecutor($builder);
    }

    /**
     * Execute callback in a database transaction.
     * 
     * @param  \Closure       $callback
     * @param  \Closure|null  $callbackIfFail
     * @return \Illuminate\Http\Response
     */
    protected function transaction(Closure $callback, Closure $callbackIfFail = null)
    {
        transaction($callback, $callbackIfFail);

        return redirect_action(route_action($this, 'index'));
    }

    /**
     * Create permissions for module.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function createPermissions($request)
    {
        $viewPermission = Permission::create([
            'name' => str_slug($request->input('name'), '_').'.view',
            'display_name' => 'View '.str_slug($request->input('name'), ' ').'(s)',
            'description' => null,
            'is_removable' => false,
        ]);

        $createPermission = Permission::create([
            'name' => str_slug($request->input('name'), '_').'.create',
            'display_name' => 'Create a new '.str_slug($request->input('name'), ' '),
            'description' => null,
            'is_removable' => false,
        ]);

        $editPermission = Permission::create([
            'name' => str_slug($request->input('name'), '_').'.edit',
            'display_name' => 'Edit a '.str_slug($request->input('name'), ' '),
            'description' => null,
            'is_removable' => false,
        ]);

        $deletePermission = Permission::create([
            'name' => str_slug($request->input('name'), '_').'.delete',
            'display_name' => 'Delete a '.str_slug($request->input('name'), ' '),
            'description' => null,
            'is_removable' => false,
        ]);

        return [
            'view' => $viewPermission->id,
            'create' => $createPermission->id,
            'edit' => $editPermission->id,
            'delete' => $deletePermission->id,
        ];
    }

    /**
     * Prepare to save the table of the module.
     *
     * @param  array  $columns
     * @return \Illuminate\Support\Collection
     */
    protected function prepareModuleTables(array $columns)
    {
        return collect($columns)->transform(function ($column) {
            return [
                'column' => $column['name'],
                'method' => $column['type'],
                'arguments' => ($column['length_values']) ?: null,
                'default' => ($column['default']) ?: null,
                'unsigned' => ($column['on']) ? true : false,
                'nullable' => isset($column['nullable']),
                'comment' => ($column['comment']) ?: null,
                'is_foreign' => ($column['on']) ? true : false,
                'table_foreign' => ($column['on']) ?: null,
                'references_foreign' => ($column['references']) ?: null,
                'relationship_foreign' => ($column['relationship']) ?: null,
                'caption' => ucwords(str_replace('_', ' ', $column['name'])),
            ];
        });
    }

    /**
     * Datatables resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function datatables()
    {
        $permissions = $this->datatablesPermissions;

        return datatables($this->module->datatables())
                ->addColumn('action', function ($data) use ($permissions) {
                    $action = '';

                    if (Guard::hasAccess($data->showPermission->name)) {
                        $action .= ' <a href="'.url(snake_case($data->name)).'" class="btn btn-icon-only green" title="'.trans('lucy.app.go-to-module').'"><i class="fa fa-external-link fa-fw"></i></a>';
                    }

                    if (isset($permissions['delete']) && $permissions['delete'] && Guard::hasAccess($permissions['delete'])) {
                        if ((is_null($data->is_removable)) || (! is_null($data->is_removable) && $data->is_removable)) {
                            $action .= ' <a href="#" class="btn btn-icon-only red" title="'.trans('lucy.word.delete').'" data-id="'.$data->id.'" data-button="delete"><i class="fa fa-trash-o fa-fw"></i></a>';
                        }
                    }

                    return $action;
                })
                ->make(true);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ((bool) lucy_config('APP_DEMO')) {
            return back_with_message(trans('lucy.message.demo-mode'), 'warning', false);
        }

        $module = $this->module->findOrFail($id);

        if ($this->isTableExists($module->table_name)) {
            return back_with_message(trans('lucy.message.drop-table-first'));
        }

        return $this->transaction(function () use ($id, $module) {
            $name = $module->name;

            foreach ($module->files as $file) {
                if (str_contains($file->path, 'resources/views/modules')) {
                    if (is_dir($dir = dirname($file->path))) {
                        if (! isset($viewDir)) {
                            $viewDir = $dir;
                        }
                    }
                }

                @unlink($file->path);
            }

            if (isset($viewDir)) {
                @rmdir($viewDir);
            }

            foreach (['createPermission', 'deletePermission', 'editPermission', 'showPermission'] as $permission) {
                $permission = $module->{$permission};

                Role::deletePermissions($permission->name);

                $permission->delete();
            }

            Artisan::call('lucy:route', [
                'name' => $name,
                '--only-update' => true,
            ]);

            lucy_log(trans('lucy.log.delete-module', ['module' => $name]));
        });
    }
}
