<?php

namespace App\Http\Controllers\Modules;
use Sentinel;
use DB;
use App\Lucy\Controller;
use App\Models\Modules\Client as Model;
use App\Http\Queries\Queries;
use App\DataTables\Client\AssetsDataTable;
use App\DataTables\Client\UsersDataTable;
use App\DataTables\Client\LicensesDataTable;
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
    public function show(AssetsDataTable $dataTable, $id)
    {
        $client             =           $this->model->findOrFail($id);

        $assets             =           (new Queries)->get('assets','client_id', $id);
        $licenses           =           (new Queries)->get('licenses','client_id', $id);
        $projects           =           (new Queries)->get('projects','client_id', $id);
        $issues             =           (new Queries)->get('issues','client_id', $id);
        $tickets            =           (new Queries)->get('tickets','client_id', $id);
        $credentials        =           (new Queries)->get('credentials','client_id', $id);

        $clientUsers        =           $client->users()->with('roles')->get();

        $assignedList       =           $clientUsers->pluck('id')->all();

        $NotAssignedAdmins  =           ['' => ''] +
                                        (new Queries)->getUsers('1',$assignedList, false)
                                            ->lists('first_name','id')->all();

        $assignedAdmins     =           (new Queries)->getUsers('1',$assignedList, true);


        $categories =                   DB::table('asset_categories')->get();

        $tabs               =           ["assets","licenses","projects","issues","tickets","credentials","users","files"];
        $tabsBlade          =           ["modules.clients.tabs.assets","modules.clients.tabs.licenses","modules.clients.tabs.projects","modules.clients.tabs.issues","modules.clients.tabs.tickets","modules.clients.tabs.credentials","modules.clients.tabs.users","modules.clients.tabs.files"];


        return  $dataTable->forClient($id)->render('modules.clients.view', [
                                        'client'            => $client,
                                        'assets'            => $assets,
                                        'licenses'          => $licenses,
                                        'projects'          => $projects,
                                        'issues'            => $issues,
                                        'tickets'           => $tickets,
                                        'credentials'       => $credentials,
                                        'clientUsers'       => $clientUsers,
                                        'assignedAdmins'    => $assignedAdmins,
                                        'categories'        => $categories,
                                        'NotAssignedAdmins' => $NotAssignedAdmins,
                                        'tabs'              => $tabs,
                                        'tabsBlade'         => $tabsBlade,
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
                    $count = (new Queries)->count('licenses','client_id', $data->id);
                    $badge = '<span class="badge badge-danger">'.$count.'</span>';                    
                    return $badge;
                })
                ->addColumn('assets', function ($data) {
                    $count = (new Queries)->count('assets','client_id', $data->id);
                    $badge = '<span class="badge badge-success">'.$count.'</span>';                    
                    return $badge;
                })
                ->addColumn('projects', function ($data) {
                    $count = (new Queries)->count('projects','client_id', $data->id);
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


    public function assetsTableService(AssetsDataTable $dataTable, $cli)
    {
        return $dataTable->forClient($cli)
                         ->render('modules.test', ["client_id" => $cli]);
    }

    public function usersTableService(UsersDataTable $dataTable, $cli)
    {
        return $dataTable->forClient($cli)
                         ->render('modules.client.datatables', ["client_id" => $cli]);
    }

    public function licenseTableService(LicensesDataTable $dataTable, $cli)
    {
        return $dataTable->forClient($cli)
                         ->render('modules.client.datatables', ["client_id" => $cli]);
    }

    public function assetsTables($id)
    {

        return Controller::datatables($this->model->assetsTables($id))
            ->editColumn('label.name', function ($data) {
                $badge = '<span class="badge badge-roundless bg-'.$data->label->color.' bg-font-'.$data->label->color.'">'.$data->label->name.'</span>';
                return $badge;
            })
            ->make(true);
    }
}
