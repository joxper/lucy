<?php

namespace App\Http\Controllers\Modules;

use App\Lucy\Controller;
use App\Models\Modules\Asset as Model;
use App\Http\Requests\Modules\AssetRequest as Request;

class AssetController extends Controller
{
    /**
     * {@inheritDoc}
     */
    protected $datatablesPermissions = [
        'edit' => 'assets.edit',
        'delete' => 'assets.delete',
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
        return view('modules.assets.index', ['createPermission' => 'assets.create']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->createEdit([
            'category_id' => null,
            'admin_id' => null,
            'client_id' => null,
            'user_id' => null,
            'model_id' => null,
            'supplier_id' => null,
            'status_id' => null,
            'purchase_date' => null,
            'warranty_months' => null,
            'tag' => null,
            'name' => null,
            'serial' => null,
            'notes' => null,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Modules\AssetRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->transaction(function () use ($request) {
            $data = $this->model->create($request->all());

            lucy_log('Created a new Asset where ID: '.$data->id.'.');
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
        return view('modules.assets.view', $this->prepareShow($id));
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
     * @param  \App\Http\Requests\Modules\AssetRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $this->transaction(function () use ($request, $id) {
            $data = $this->model->findOrFail($id);
            $data->update($request->all());

            lucy_log('Updated a Asset where ID: '.$data->id.'.');
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

            lucy_log('Deleted a Asset where ID: '.$data->id.'.');

            $data->delete();
        });
    }

    /**
     * {@inheritDoc}
     */
    protected function createEdit($dataToBind, $id = 0)
    {
        return view('modules.assets.form', $this->prepareCreateEdit($dataToBind, $id));
    }

    /**
     * Datatables resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function datatables()
    {
       return Controller::datatables()
                ->make(true);
    }


}
