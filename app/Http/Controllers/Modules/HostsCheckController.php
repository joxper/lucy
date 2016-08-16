<?php

namespace App\Http\Controllers\Modules;

use App\Lucy\Controller;
use App\Models\Modules\HostsCheck as Model;
use App\Http\Requests\Modules\HostsCheckRequest as Request;

class HostsCheckController extends Controller
{
    /**
     * {@inheritDoc}
     */
    protected $datatablesPermissions = [
        'edit' => 'hostschecks.edit',
        'delete' => 'hostschecks.delete',
    ];

    /**
     * {@inheritDoc}
     */
    public function __construct(Model $model)
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
        return view('modules.hosts_checks.index', ['createPermission' => 'hostschecks.create']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->createEdit([
            'host_id' => null,
            'name' => null,
            'type' => null,
            'port' => null,
            'monitoring' => null,
            'email' => null,
            'sms' => null,
            'status' => null,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Modules\HostsCheckRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->transaction(function () use ($request) {
            $data = $this->model->create($request->all());

            lucy_log('Created a new HostsCheck where ID: '.$data->id.'.');
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
        return view('modules.hosts_checks.view', $this->prepareShow($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->createEdit($this->model->findOrFail($id)->toArray(), $id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Modules\HostsCheckRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $this->transaction(function () use ($request, $id) {
            $data = $this->model->findOrFail($id);
            $data->update($request->all());

            lucy_log('Updated a HostsCheck where ID: '.$data->id.'.');
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
        return $this->transaction(function () use ($id) {
            $data = $this->model->findOrFail($id);

            lucy_log('Deleted a HostsCheck where ID: '.$data->id.'.');

            $data->delete();
        });
    }

    /**
     * {@inheritDoc}
     */
    protected function createEdit($dataToBind, $id = 0)
    {
        return view('modules.hosts_checks.form', $this->prepareCreateEdit($dataToBind, $id));
    }
}
