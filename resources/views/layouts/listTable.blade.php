<div class="tab-pane" id="@yield(isset($tab) ? "tabName-$tab" : 'tabName')">
    <div class="table-toolbar">
        <div class="row">
            <div class="col-md-6" id="buttons">
                <div class="btn-group">
                    @access($createPermission)
                        <a class="btn sbold green" href="@yield(isset($tab) ? "add-link-$tab" : 'add-link')" title="{{ trans('lucy.word.create') }}"><i class="fa fa-plus fa-fw"></i> {{ trans('lucy.word.create') }}
                        </a>
                    @endaccess
                </div>
            </div>
        </div>
    </div>
    <table id="@yield(isset($tab) ? "table-id-$tab" : 'table-id')" class="table table-striped table-bordered table-hover table-checkable order-column" data-tables="true">
        <thead>
            <tr>
                @yield(isset($tab) ? "table-th-$tab" : 'table-th')
                <th width="18%">&nbsp;</th>
            </tr>
        </thead>
    </table>
</div>
@section('dataTablesScripts')
    <script>
        function @yield(isset($tab) ? "table-id-$tab" : 'table-id')() {
            if (!$.fn.dataTable.isDataTable('#@yield(isset($tab) ? "table-id-$tab" : 'table-id')')) {
                $('#@yield(isset($tab) ? "table-id-$tab" : 'table-id')').DataTable({
                    // Internationalisation. For more info refer to http://datatables.net/manual/i18n
                    processing: true,
                    serverSide: true,
                    ajax: '@yield(isset($tab) ? "ajax-datatables-$tab" : 'ajax-datatables')',
                    columns: [
                        @yield(isset($tab) ? "datatables-columns-$tab" : 'datatables-columns')
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
                            "previous": "Prev",
                            "next": "Next",
                            "last": "Last",
                            "first": "First"
                        },
                        "processing" : "<div></div><div></div><div></div><div></div><div></div>"
                    },
                    "dom": "Bfrtip",
                    "buttons": [
                            "export",
                        { extend: 'print', className: 'btn dark btn-outline' },
                        { extend: 'print', className: 'btn dark btn-outline' },
                        { extend: 'copy', className: 'btn red btn-outline' },
                        { extend: 'pdf', className: 'btn green btn-outline' },
                        { extend: 'excel', className: 'btn yellow btn-outline ' },
                        { extend: 'csv', className: 'btn purple btn-outline ' },
                    ],
                    "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

                    "columnDefs": [{
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
            }

        }
        @yield(isset($tab) ? "table-id-$tab" : 'table-id').buttons().container()
                .appendTo( $('#buttons .col-md-6:eq(0)' ) );
    </script>
@append
