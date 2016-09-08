<?php

namespace App\DataTables;

use App\Models\User;
use Sentinel;
use App\Lucy\Guard;
use Yajra\Datatables\Services\DataTable;

class UsersDataTable extends DataTable
{

    protected $datatablesPermissions = [
        'edit' => 'users.edit',
        'delete' => 'users.delete',
    ];

    /**
     * Display ajax response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        $permissions = $this->datatablesPermissions;

        return $this->datatables
            ->eloquent($this->query())
            ->addColumn('action', function ($data) use($permissions) {
                $action = '';
                if (isset($permissions['edit']) && $permissions['edit'] && Guard::hasAccess($permissions['edit']) && ! Sentinel::findById($data->id)->roles[0]->is_admin) {

                    $action .= '<a href="' . action('Lucy\UserController@edit', ['id' => $data->id]) . '" class="btn btn-icon-only green" title="Edit"><i class="fa fa-edit"></i></a>&nbsp;';
                }
                    $action .= '<a href="' . action('Lucy\UserController@show', ['id' => $data->id]) .'" class="btn btn-icon-only purple" title="View"><i class="fa fa-eye"></i></a>';

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
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        $query = User::query()
            ->where('client_id', $this->client);

        return $this->applyScopes($query);

    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\Datatables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->ajax('')
                    ->addAction(['width' => '140px', 'class' => 'center-align'])
                    ->parameters($this->getBuilderParameters());
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'id',
            'username',
            'email',
            'created_at',
            'updated_at',
        ];
    }

    public function forClient($cli) {
        $this->client = $cli;
        return $this;
    }


    /**
     * Get parameters.
     *
     * @return array
     */
    protected function getBuilderParameters()
    {
        return [
            'dom'          => 'Bfrtip',
            'buttons'      => ['export', 'print', 'reset', 'reload'],
            'language'     => [
                                'processing' => '<div></div><div></div><div></div><div></div><div></div>'
            ],
            'initComplete' => "function () {
                            this.api().columns().every(function () {
                                var column = this;
                                var input = document.createElement(\"input\");
                                $(input).appendTo($(column.footer()).empty())
                                .on('change', function () {
                                    column.search($(this).val(), false, false, true).draw();
                                });
                            });
                        }",
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'usersdatatables_' . time();
    }
}

