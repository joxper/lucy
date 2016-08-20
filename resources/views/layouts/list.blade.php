@extends('layouts.app')

@section('header')
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    {!! Html::style('bower_components/metronic/assets/global/plugins/datatables/datatables.min.css') !!}
    {!! Html::style('bower_components/metronic/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') !!}
    <!-- END PAGE LEVEL PLUGINS -->

    <style>
        .center-align {
            text-align: center;
        }
    </style>
@endsection

@section('content')
    <div class="col-md-12">
        <!-- BEGIN TABLE PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="fa @yield('icon')"></i>
                    <span class="caption-subject bold uppercase"> @yield('table-name')</span>
                </div>
                <div class="actions">
                    <div class="btn-group btn-group-devided" data-toggle="buttons">
                        <label class="btn btn-transparent dark btn-outline btn-circle btn-sm active">
                            <input type="radio" name="options" class="toggle" id="option1">Actions</label>
                        <label class="btn btn-transparent dark btn-outline btn-circle btn-sm">
                            <input type="radio" name="options" class="toggle" id="option2">Settings</label>
                    </div>
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-toolbar">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="btn-group">
                                @access($createPermission)
                                    <a class="btn sbold green" href="@yield('add-link')" title="{{ trans('lucy.word.create') }}"><i class="fa fa-plus fa-fw"></i> {{ trans('lucy.word.create') }}
                                    </a>
                                @endaccess                                                  
                            </div>
                        </div>
                    </div>
                </div>
                <table id="@yield('table-id')" class="table table-striped table-bordered table-hover table-checkable order-column" data-tables="true">
                    <thead>
                        <tr>
                            @yield('table-th')
                            <th width="18%">&nbsp;</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <!-- END TABLE PORTLET-->
    </div>


@endsection

@section('scripts')

        <!-- BEGIN PAGE LEVEL PLUGINS -->
        {!! Html::script('bower_components/metronic/assets/global/scripts/datatable.js') !!}
        {!! Html::script('bower_components/metronic/assets/global/plugins/datatables/datatables.min.js') !!}
        {!! Html::script('bower_components/metronic/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') !!}
        {!! Html::script('bower_components/metronic/assets/pages/scripts/table-datatables-managed.min.js') !!}
        <!-- END PAGE LEVEL PLUGINS -->


    <script>
        $(document).ready(function() {
            $('#@yield('table-id')').DataTable({
                // Internationalisation. For more info refer to http://datatables.net/manual/i18n
                processing: true,
                serverSide: true,
                ajax: '@yield('ajax-datatables')',
                columns: [
                    @yield('datatables-columns')
                ],
                "language": {
                    "aria": {
                        "sortAscending": ": activate to sort column ascending",
                        "sortDescending": ": activate to sort column descending"
                    },
                    "emptyTable": "No data available in table",
                    "info": "Showing _START_ to _END_ of _TOTAL_ records",
                    "infoEmpty": "No records found",
                    "infoFiltered": "(filtered1 from _MAX_ total records)",
                    "lengthMenu": "Show _MENU_",
                    "search": "Search:",
                    "zeroRecords": "No matching records found",
                    "paginate": {
                        "previous":"Prev",
                        "next": "Next",
                        "last": "Last",
                        "first": "First"
                    }
                },

                // Or you can use remote translation file
                //"language": {
                //   url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
                //},

                // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
                // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js). 
                // So when dropdowns used the scrollable div should be removed. 
                //"dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

                "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

                "columnDefs": [ {
                    "targets": 0,
                    "orderable": false,
                    "searchable": false
                }],

                "lengthMenu": [
                    [5, 15, 20, -1],
                    [5, 15, 20, "All"] // change per page values here
                ],
                // set the initial value
                "pageLength": 5,            
                "pagingType": "bootstrap_extended",
                "columnDefs": [{  // set default column settings
                    'orderable': false,
                    'targets': [0]
                }, {
                    "searchable": false,
                    "targets": [0]
                }],
                "order": [
                    [1, "asc"]
                ] // set first column as a default sort by asc
            });


        });





    </script>
    @include('layouts.delete-modal-datatables')
@endsection
 



