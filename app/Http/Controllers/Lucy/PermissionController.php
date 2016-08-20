<?php

namespace App\Http\Controllers\Lucy;

use App\Models\Role;
use App\Lucy\Controller;
use App\Models\Permission;
use App\Http\Requests\Lucy\PermissionRequest as Request;

class PermissionController extends Controller
{
    /**
     * {@inheritDoc}
     */
    protected $datatablesPermissions = [
        'edit' => 'permissions.edit',
        'delete' => 'permissions.delete',
    ];

    /**
     * {@inheritDoc}
     */
    public function __construct(Permission $model)
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
        return view('lucy.permissions.index', ['createPermission' => 'permissions.create']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->createEdit([
            'name' => null,
            'display_name' => null,
            'description' => null,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->transaction(function () use ($request) {
            $this->model->create($request->except('_token'));

            lucy_log(trans('lucy.log.create-permission', ['permission' => $request->input('display_name')]));
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
        return view('lucy.permissions.view', $this->prepareShow($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->createEdit($this->model->findOrFail($id), $id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $this->transaction(function () use ($request, $id) {
            $permission = $this->model->findOrFail($id);

            Role::changePermissionsName($permission->name, $request->input('name'));

            $permission->update($request->except('_token', '_method'));

            lucy_log(trans('lucy.log.update-permission', ['permission' => $request->input('display_name')]));
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
        $permission = $this->model->findOrFail($id);
        $useFlash = true;

        if (! $permission->is_removable) {
            flash()->error(trans('lucy.message.data-can-not-be-deleted'));
            $useFlash = false;
        }

        return $this->transaction(function () use ($permission, $useFlash) {
            if (! $useFlash) {
                return false;
            }

            Role::deletePermissions($permission->name);
            lucy_log(trans('lucy.log.delete-permission', ['permission' => $permission->display_name]));

            $permission->delete();
        }, null, $useFlash);
    }

    /**
     * {@inheritDoc}
     */
    protected function createEdit($dataToBind, $id = 0)
    {
        $dataToBind['readonly'] = [];

        if ($id) {
            $dataToBind['readonly'] = ['readonly' => 'readonly'];
        }

        return view('lucy.permissions.form', $this->prepareCreateEdit($dataToBind, $id));
    }

    public function datatables()
    {
        return Controller::datatables()
            ->make(true);
    }

}
