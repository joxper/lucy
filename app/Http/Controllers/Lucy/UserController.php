<?php

namespace App\Http\Controllers\Lucy;

use Sentinel;
use Activation;
use App\Models\Role;
use App\Models\User;
use LucyGuard as Guard;
use App\Lucy\Controller;
use App\Http\Requests\Lucy\UserRequest as Request;

class UserController extends Controller
{
    /**
     * {@inheritDoc}
     */
    protected $datatablesPermissions = [
        'edit' => 'users.edit',
        'delete' => 'users.delete',
    ];

    /**
     * {@inheritDoc}
     */
    public function __construct(User $model)
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
        return view('lucy.users.index', ['createPermission' => 'users.create']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->createEdit([
            'email' => null,
            'username' => null,
            'avatar' => null,
            'first_name' => null,
            'last_name' => null,
            'is_banned' => false,
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
        $data = $request->except('_token', 'avatar', 'role');
        $data['full_name'] = $request->input('first_name').' '.$request->input('last_name');

        return $this->transaction(function () use ($data, $request) {
            if ($request->hasFile('avatar')) {
                if ($avatar = save_avatar($request->file('avatar'))) {
                    $data['avatar'] = $avatar;
                }
            }

            if (! isset($data['is_banned'])) {
                $data['is_banned'] = false;
            }

            $regActivate = (bool) lucy_config('REG_ACTIVATE');
            $registerMethod = ($regActivate) ? 'register' : 'registerAndActivate';

            $user = Sentinel::{$registerMethod}($data);
            $role = Sentinel::findRoleById($request->input('role'));
            $role->users()->attach($user);

            if ($regActivate) {
                Activation::removeExpired();

                $activation = (Activation::exists($user)) ? Activation::exists($user) : Activation::create($user);

                mail_send('auth.activation', ['code' => $activation->code, 'user' => $user], function ($m) use ($user) {
                    $m->to($user->email, $user->full_name)->subject('Activate your account!');
                });
            }

            lucy_log(trans('lucy.log.create-user', ['user' => $data['full_name']]));
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
        return view('lucy.users.view', $this->prepareShow($id));
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->except('_token', 'avatar', 'role');
        $data['full_name'] = $request->input('first_name').' '.$request->input('last_name');

        return $this->transaction(function () use ($data, $request, $id) {
            $user = Sentinel::findById($id);

            if ($request->hasFile('avatar')) {
                if ($avatar = save_avatar($request->file('avatar'), $user->avatar)) {
                    $data['avatar'] = $avatar;
                }
            }

            if (! isset($data['is_banned'])) {
                $data['is_banned'] = false;
            }

            $user->update($data);

            $role = Sentinel::findRoleById($user->roles[0]->id);
            $role->users()->detach($user);

            $role = Sentinel::findRoleById($request->input('role'));
            $role->users()->attach($user);

            lucy_log(trans('lucy.log.update-user', ['user' => $data['full_name']]));
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
        $user = Sentinel::findById($id);
        $useFlash = true;

        if ($user->roles[0]->is_admin) {
            flash()->error(trans('lucy.message.data-can-not-be-deleted'));
            $useFlash = false;
        }

        return $this->transaction(function () use ($user, $useFlash) {
            if (! $useFlash) {
                return false;
            }

            delete_avatar($user->avatar);
            lucy_log(trans('lucy.log.delete-user', ['user' => $user->full_name]));

            $user->delete();
        }, null, $useFlash);
    }

    /**
     * Datatables resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function datatables()
    {
        $permissions = $this->datatablesPermissions;
        
        return datatables($this->model->datatables())
                ->addColumn('role', function ($data) {
                    return Sentinel::findById($data->id)->roles[0]->name;
                })
                ->addColumn('action', function ($data) use ($permissions) {
                    $action = '';

                    if (isset($permissions['edit']) && $permissions['edit'] && Guard::hasAccess($permissions['edit']) && ! Sentinel::findById($data->id)->roles[0]->is_admin) {
                        $action .= '<a href="'.action(route_action($this, 'edit'), $data->id).'" class="btn btn-icon-only green" title="Edit"><i class="fa fa-edit"></i></a>&nbsp;';
                    }

                    $action .= '<a href="'.action(route_action($this, 'show'), $data->id).'" class="btn btn-icon-only purple" title="View"><i class="fa fa-eye"></i></a>';

                    if (isset($permissions['delete']) && $permissions['delete'] && Guard::hasAccess($permissions['delete'])) {
                        if ((is_null($data->is_removable)) || (! is_null($data->is_removable) && $data->is_removable)) {
                            if (! Sentinel::findById($data->id)->roles[0]->is_admin) {
                                $action .= '&nbsp;<a href="#" class="btn btn-icon-only red" title="Delete" data-id="'.$data->id.'" data-button="delete"><i class="fa fa-trash-o"></i></a>';
                            }
                        }
                    }

                    return $action;
                })
                ->make(true);
    }

    /**
     * {@inheritDoc}
     */
    protected function createEdit($dataToBind, $id = 0)
    {
        $dataToBind['dropdown'] = Role::dropdown()->toArray();
        $dataToBind['role'] = null;
        $dataToBind['readonly'] = [];

        if ($id) {
            $dataToBind['role'] = Sentinel::findById($id)->roles[0]->id;
            $dataToBind['readonly'] = ['readonly' => 'readonly'];
        }

        return view('lucy.users.form', $this->prepareCreateEdit($dataToBind, $id));
    }

    /**
     * {@inheritDoc}
     */
    protected function prepareShow($id)
    {
        $data = parent::prepareShow($id);
        $data['data']['role'] = Sentinel::findById($id)->roles[0]->name;

        return $data;
    }
}
