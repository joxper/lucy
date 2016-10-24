<?php

namespace App\Lucy;

use Closure;
use App\Http\Controllers\Controller as BaseController;

abstract class Controller extends BaseController
{
    /**
     * The model associated with the controller.
     * 
     * @var \App\Lucy\ModelInterface
     */
    protected $model;

    /**
     * Permissions for datatables.
     * 
     * @var array
     */
    protected $datatablesPermissions = [];

    /**
     * Create a new controller instance.
     *
     * @param  \App\Lucy\ModelInterface $model
     * @return void
     */
    public function __construct(ModelInterface $model)
    {
        $this->model = $model;
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
                ->addColumn('action', function ($data) use ($permissions) {
                    $action = '';

                    if (isset($permissions['edit']) && $permissions['edit'] && Guard::hasAccess($permissions['edit'])) {
                        $action .= '<a href="'.action(route_action($this, 'edit'), $data->id).'" class="btn btn-icon-only green" title="'.trans('lucy.word.edit').'"><i class="fa fa-pencil-square-o fa-fw"></i></a>&nbsp;';
                    }

                    $action .= '<a href="'.action(route_action($this, 'show'), $data->id).'" class="btn btn-icon-only purple" title="'.trans('lucy.word.view').'"><i class="fa fa-eye fa-fw"></i></a>';

                    if (isset($permissions['delete']) && $permissions['delete'] && Guard::hasAccess($permissions['delete'])) {
                        if ((is_null($data->is_removable)) || (! is_null($data->is_removable) && $data->is_removable)) {
                            $action .= '&nbsp;<a href="#" class="btn btn-icon-only red" title="'.trans('lucy.word.delete').'" data-id="'.$data->id.'" data-button="delete"><i class="fa fa-trash-o fa-fw"></i></a>';
                        }
                    }

                    return $action;
                });
                
    }

    /**
     * Prepare data for createEdit().
     * 
     * @param  array|object  $dataToBind
     * @param  int           $id
     * @return array
     */
    protected function prepareCreateEdit($dataToBind, $id = 0)
    {
        $data = [
            'title' => trans('lucy.word.create'),
            'form' => [
                'url' => action(route_action($this, 'store')),
                'files' => true,
            ],
            'data' => $dataToBind,
            'back' => action(route_action($this, 'index')),
        ];

        if ($id) {
            $data['title'] = trans('lucy.word.edit');
            $data['form']['url'] = action(route_action($this, 'update'), $id);
            $data['form']['method'] = 'PUT';
        }

        return $data;
    }

    /**
     * Prepare data for show().
     * 
     * @param  int   $id
     * @return array
     */
    protected function prepareShow($id)
    {
        return [
            'back' => action(route_action($this, 'index')),
            'data' => $this->model->findOrFail($id),
        ];
    }

    /**
     * Execute callback in a database transaction.
     * 
     * @param  \Closure       $callback
     * @param  \Closure|null  $callbackIfFail
     * @param  bool           $useFlash
     * @return \Illuminate\Http\Response
     */
    protected function transaction(Closure $callback, Closure $callbackIfFail = null, $useFlash = true)
    {
        transaction($callback, $callbackIfFail, $useFlash);

        return redirect_action(route_action($this, 'index'));
    }

    /**
     * Handle create and edit method.
     *
     * @param  array  $datatoBind
     * @param  int    $id
     * @return \Illuminate\Http\Response
     */
    abstract protected function createEdit($dataToBind, $id = 0);
}
