<?php

namespace App\Http\Controllers\Lucy;

use App\Models\Role;
use App\Lucy\Controller;
use App\Models\Permission;
use App\Http\Requests\Lucy\RoleRequest as Request;

class RoleController extends Controller
{
    /**
     * {@inheritDoc}
     */
    protected $datatablesPermissions = [
        'edit' => 'roles.edit',
        'delete' => 'roles.delete',
    ];

    /**
     * {@inheritDoc}
     */
    public function __construct(Role $model)
    {
        parent::__construct($model);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('lucy.roles.index', ['createPermission' => 'roles.create']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->createEdit([
            'slug' => null,
            'name' => null,
            'permissions' => null,
            'is_admin' => false,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Lucy\RoleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->transaction(function () use ($request) {
            $permissions = $this->preparePermissions($request->input('permissions'));

            $data = $request->only('slug', 'name') + compact('permissions');

            $this->model->create($data);

            lucy_log(trans('lucy.log.create-role', ['role' => $data['name']]));
        });
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('lucy.roles.view', $this->prepareShow($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = ['permissions' => Role::getPermissionsByRoleId($id)] + $this->model->findOrFail($id)->toArray();

        return $this->createEdit($data, $id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Lucy\RoleRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $this->transaction(function () use ($request, $id) {
            $permissions = $this->preparePermissions($request->input('permissions'));

            $data = $request->only('slug', 'name') + compact('permissions');

            $this->model->findOrFail($id)->update($data);

            lucy_log(trans('lucy.log.update-role', ['role' => $data['name']]));
        });
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = $this->model->findOrFail($id);
        $useFlash = true;

        if (! $role->is_removable) {
            flash()->error(trans('lucy.message.data-can-not-be-deleted'));
            $useFlash = false;
        }

        return $this->transaction(function () use ($role, $useFlash) {
            if (! $useFlash) {
                return false;
            }

            lucy_log(trans('lucy.log.delete-role', ['role' => $role->name]));

            $role->delete();
        }, null, $useFlash);
    }

    /**
     * {@inheritDoc}
     */
    protected function createEdit($dataToBind, $id = 0)
    {
        $dataToBind['dropdown'] = Permission::dropdown()->toArray();
        $dataToBind['readonly'] = [];

        if ($id) {
            $dataToBind['readonly'] = ['readonly' => 'readonly'];
        }

        return view('lucy.roles.form', $this->prepareCreateEdit($dataToBind, $id));
    }

    /**
     * Prepare permissions array to save.
     * 
     * @param  array|null  $permissions
     * @return array
     */
    protected function preparePermissions($permissions)
    {
        $data = [];

        if (is_null($permissions)) {
            return $data;
        }

        foreach ($permissions as $key => $value) {
            $data[$value] = true;
        }

        return $data;
    }

    /**
     * {@inheritDoc}
     */
    protected function prepareShow($id)
    {
        $data = parent::prepareShow($id);

        if ($permissions = $data['data']->permissions) {
            foreach ($permissions as $key => $value) {
                $data['permissions'][] = Permission::getDisplayNameByName($key);
            }
        } else {
            $data['permissions'] = [];
        }

        return $data;
    }
    public function datatables()
    {
        return Controller::datatables()
            ->make(true);
    }


}
