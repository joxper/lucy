<?php

namespace App\Http\Controllers\Modules;
use Sentinel;
use DB;
use App\Lucy\Controller;
use App\Models\Modules\Client as Model;
use App\Models\Modules\ClientsAdmin as AdminModel;
use App\Http\Requests\Modules\ClientRequest as Request;

class ClientController extends Controller
{
    /**
     * {@inheritDoc}
     */
    protected $datatablesPermissions = [
        'edit' => 'clients.edit',
        'delete' => 'clients.delete',
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
        return view('modules.clients.index', ['createPermission' => 'clients.create']);
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
            'asset_tag_prefix' => null,
            'license_tag_prefix' => null,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Modules\ClientRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->transaction(function () use ($request) {
            $data = $this->model->create($request->all());

            lucy_log('Created a new Client where ID: '.$data->id.'.');
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
        $client =           $this->prepareShow($id);
        $assets =           DB::table('assets')
                                ->where('client_id', $id)
                                ->get();
        $licenses =         DB::table('licenses')
                                ->where('client_id', $id)
                                ->get();
        $projects =         DB::table('projects')
                                ->where('client_id', $id)
                                ->get();
        $issues =           DB::table('issues')
                                ->where('client_id', $id)
                                ->get();
        $tickets =          DB::table('tickets')
                                ->where('client_id', $id)
                                ->orderBy('id', 'desc')                                
                                ->get();
        $credentials =      DB::table('credentials')
                                ->where('client_id', $id)
                                ->get();
        $users =            Sentinel::findRoleById(2)
                                ->users()
                                ->where('client_id', $id)
                                ->with('roles')
                                ->get();
        $admins =           Sentinel::findRoleById(1)
                                ->users()
                                ->with('roles')
                                ->get();

        $assignedAdmins =   AdminModel::where('client_id', $id)
                                ->with('user')
                                ->get();

        $categories =       DB::table('asset_categories')
                                ->get();

        return view('modules.clients.view', [
                                        'client'            => $client,
                                        'assets'            => $assets,
                                        'licenses'          => $licenses,
                                        'projects'          => $projects,
                                        'issues'            => $issues,
                                        'tickets'           => $tickets,
                                        'credentials'       => $credentials,
                                        'users'             => $users,
                                        'admins'            => $admins,
                                        'assignedAdmins'    => $assignedAdmins,
                                        'categories'        => $categories
        ]);
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
     * @param  \App\Http\Requests\Modules\ClientRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $this->transaction(function () use ($request, $id) {
            $data = $this->model->findOrFail($id);
            $data->update($request->all());

            lucy_log('Updated a Client where ID: '.$data->id.'.');
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

            lucy_log('Deleted a Client where ID: '.$data->id.'.');

            $data->delete();
        });
    }

    /**
     * {@inheritDoc}
     */
    protected function createEdit($dataToBind, $id = 0)
    {
        return view('modules.clients.form', $this->prepareCreateEdit($dataToBind, $id));
    }

    /**
     * Datatables resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function datatables()
    {
       return Controller::datatables()
                ->addColumn('licenses', function ($data) {
                    $count = DB::table('licenses')
                                        ->where('client_id', $data->id)
                                        ->count();
                    $badge = '<span class="badge badge-danger">'.$count.'</span>';                    
                    return $badge;
                })
                ->addColumn('assets', function ($data) {
                    $count = DB::table('assets')
                                        ->where('client_id', $data->id)
                                        ->count();
                    $badge = '<span class="badge badge-success">'.$count.'</span>';                    
                    return $badge;
                })
                ->addColumn('projects', function ($data) {
                    $count = DB::table('projects')
                                        ->where('client_id', $data->id)
                                        ->count();
                    $badge = '<span class="badge purple">'.$count.'</span>';                    
                    return $badge;
                })                                
                ->make(true);
    }


    /**
     * Add admin tu the client.
     *
     * @param  \App\Http\Requests\Modules\ClientRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function assignStaff(Request $request)
    {
        return $this->transaction(function () use ($request) {
            $client_id = $this->model->find(1)->id;

            $data = $request->only('admin_id') + compact('client_id');

            AdminModel::create($data);

            lucy_log(trans('lucy.log.create-role', ['role' => $data['admin_id']]));
        });
    }  

}
