<?php

namespace App\Http\Controllers\Modules;
use App\Models\Modules\Client;
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
        $assigned =         Model::findOrFail($id)->users();

        $assignedList  =    $assigned
                                ->lists('user_id');
        $users =            Sentinel::findRoleById(2)
                                ->users()
                                ->whereNotIn('id', $assignedList)
                                ->with('roles')
                                ->get();
        $usersList =        ['' => ''];
        $usersList =        $usersList + $users->lists('first_name','id')->all();
        $admins =           ['' => ''];
        $admins =           $admins + Sentinel::findRoleById(1)
                                ->users()
                                ->whereNotIn('id', $assignedList)
                                ->with('roles')
                                ->lists('first_name','id')->all();

        $assignedAdmins =   Sentinel::findRoleById(1)
                                ->users()
                                ->whereIn('id', $assignedList)
                                ->with('roles')
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
                                        'categories'        => $categories,
                                        'assignedList'      => $assignedList,
                                        'usersList'         => $usersList,
                                        'createPermission'  => 'assets.create'
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
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */

    public function attachUser(Request $request, $id)
    {
        $this->transaction(function () use ($request, $id) {
            $client = $this->model->find($id);

            $user = $request->only('user_id');
            $client->users()->sync([$user['user_id']],false);

            lucy_log(trans('lucy.log.add-role', ['role' => $user['user_id']]));
        });

        return back_with_message(trans('lucy.message.success-add'), 'success');
    }

    public function detachUser($client, $id)
    {
        $this->transaction(function () use ($client, $id) {
            $client = $this->model->find($client);
            $client->users()->detach($id);

            lucy_log('Detach user where '.$id.' from Client where ID: '.$client.'.');
        });

        return back_with_message(trans('lucy.message.success-delete'), 'success');
    }
}

