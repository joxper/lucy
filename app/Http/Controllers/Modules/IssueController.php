<?php

namespace App\Http\Controllers\Modules;

use App\Lucy\Controller;
use App\Models\Modules\Issue as Model;
use App\Http\Requests\Modules\IssueRequest as Request;

class IssueController extends Controller
{
    /**
     * {@inheritDoc}
     */
    protected $datatablesPermissions = [
        'edit' => 'issues.edit',
        'delete' => 'issues.delete',
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
        return view('modules.issues.index', ['createPermission' => 'issues.create']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->createEdit([
            'client_id' => null,
            'asset_id' => null,
            'project_id' => null,
            'user_id' => null,
            'issue_type' => null,
            'priority' => null,
            'status' => null,
            'name' => null,
            'description' => null,
            'duedate' => null,
            'timespent' => null,
            'dateadded' => null,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Modules\IssueRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->transaction(function () use ($request) {
            $data = $this->model->create($request->all());

            lucy_log('Created a new Issue where ID: '.$data->id.'.');
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
        return view('modules.issues.view', $this->prepareShow($id));
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
     * @param  \App\Http\Requests\Modules\IssueRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $this->transaction(function () use ($request, $id) {
            $data = $this->model->findOrFail($id);
            $data->update($request->all());

            lucy_log('Updated a Issue where ID: '.$data->id.'.');
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

            lucy_log('Deleted a Issue where ID: '.$data->id.'.');

            $data->delete();
        });
    }

    /**
     * {@inheritDoc}
     */
    protected function createEdit($dataToBind, $id = 0)
    {
        return view('modules.issues.form', $this->prepareCreateEdit($dataToBind, $id));
    }
}
