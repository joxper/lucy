<?php

namespace App\DataTables\Client;

use App\Models\Modules\Asset;
use Sentinel;
use App\Lucy\Guard;
use Yajra\Datatables\Services\DataTable;

class AssetsDataTable extends DataTable
{
    protected $datatablesPermissions = [
        'edit' => 'assets.edit',
        'delete' => 'assets.delete',
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
            ->editColumn('label.name', function ($data) {
                $badge = '<span class="badge badge-roundless bg-'.$data->label->color.' bg-font-'.$data->label->color.'">'.$data->label->name.'</span>';
                return $badge;
            })
            ->addColumn('action', function ($data) use($permissions) {
                $action = '';
                if (isset($permissions['edit']) && $permissions['edit'] && Guard::hasAccess($permissions['edit'])) {
                    $action .= '<a href="' . action('Modules\AssetController@edit', ['id' => $data->id]) . '" class="btn btn-icon-only green" title="Edit"><i class="fa fa-edit"></i></a>&nbsp;';
                }

                $action .= '<a href="' . action('Modules\AssetController@show', ['id' => $data->id]) .'" class="btn btn-icon-only purple" title="View"><i class="fa fa-eye"></i></a>';

                if (isset($permissions['delete']) && $permissions['delete'] && Guard::hasAccess($permissions['delete'])) {
                    if ((is_null($data->is_removable)) || (! is_null($data->is_removable) && $data->is_removable)) {
                        $action .= '&nbsp;<a href="#" class="btn btn-icon-only red" title="Delete" data-id="'.$data->id.'" data-button="delete"><i class="fa fa-trash-o"></i></a>';
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
        $query = Asset::query()
                ->with('category', 'supplier', 'label')
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
            // add your columns
            'tag',
            'name',
            'serial',
            'category.name',
            'tag',
            'label.name',
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'assets_' . time();
    }

    public function forClient($cli) {
        $this->client = $cli;
        return $this;
    }

    protected function getBuilderParameters()
    {
        return [
            'dom'          => 'Bfrtip',
            'buttons'      => ['export', 'reset'],

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
}
