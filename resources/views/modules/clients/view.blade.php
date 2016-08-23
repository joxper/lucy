@extends('layouts.view-dash')

@section('title', trans('lucy.word.view').' - Clients')

@section('page-header', '<div class="page-title"><h1>'.$client['data']['name'].'<small>'.trans('lucy.word.view').'</small> </h1></div>')

@section('header')
{!! Html::style('bower_components/metronic/assets/global/plugins/morris/morris.css') !!}

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

@section('breadcrumb')
    <ul class="breadcrumb page-breadcrumb">
        <li><a href="{!! action('DashboardController@index') !!}"> {{ trans('lucy.app.home') }}</a><i class="fa fa-circle"></i></li>
        <li><a href="{!! action('Modules\ClientController@index') !!}">{{ trans('modules.Clients') }}</a></li>
        <li><span class="active">{{ trans('lucy.word.view') }}</span></li>        
    </ul>

@endsection

@section('tabs')
    <li class="active">
        <a href="#summary" data-toggle="tab" aria-expanded="true"> Summary </a>
    </li>
    <li class="">
        <a href="#assets" data-toggle="tab" aria-expanded="false"> Assets </a>
    </li>
    <li class="">
        <a href="#licenses" data-toggle="tab" aria-expanded="false"> Licenses </a>
    </li>
    <li class="">
        <a href="#projects" data-toggle="tab" aria-expanded="false"> Projects </a>
    </li>    
    <li class="">
        <a href="#issues" data-toggle="tab" aria-expanded="false"> Issues </a>
    </li>
    <li class="">
        <a href="#tickets" data-toggle="tab" aria-expanded="false"> Tickets </a>
    </li>
    <li class="">
        <a href="#credentials" data-toggle="tab" aria-expanded="false"> Credentials </a>
    </li>  
    <li class="">
        <a href="#users" data-toggle="tab" aria-expanded="false"> Users </a>
    </li>
    <li class="">
        <a href="#files" data-toggle="tab" aria-expanded="false"> Files </a>
    </li>  
@endsection

@section('actions')
    @access('clientsadmins.create')
        @if (count($admins) > 1)
        <button id="attach_btn" class="btn btn-circle btn-icon-only btn-default" data-id="{{$client['data']['id']}}">
            <i class="icon-user-follow"></i>
        </button>
        @endif
    @endaccess
    <button id="tables" class="btn btn-circle btn-icon-only btn-default">
        <i class="icon-wrench"></i>
    </button>
    <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
        <i class="icon-trash"></i>
    </a>
@endsection

@section('tab-content')
	@include('modules.clients.tabs.summary')
	@include('modules.clients.tabs.assets')
	@include('modules.clients.tabs.licenses')
	@include('modules.clients.tabs.projects')
	@include('modules.clients.tabs.issues')
	@include('modules.clients.tabs.tickets')
    @include('modules.clients.tabs.credentials')
    @include('modules.clients.tabs.users')
    @include('modules.clients.tabs.files')
@endsection
@section('attachForm')
    {{ Form::open(['method' => 'POST',
               'action' => [
                    'Modules\ClientController@attachUser',
                    'id' => $client['data']['id']
                    ],
               'id'     => 'attachForm',
               'style'  => 'display:none;',
               'title'  => trans('modules.clients.attachAdmin')
               ]) }}
    {!! Form::group('select', 'user_id', 'Staff', 'Staff', ['options' => $admins]) !!}
@endsection
@section('scripts')
    {!! Html::script('bower_components/metronic/assets/global/plugins/counterup/jquery.waypoints.min.js') !!}
    {!! Html::script('bower_components/metronic/assets/global/plugins/counterup/jquery.counterup.min.js') !!}
    {!! Html::script('bower_components/metronic/assets/global/plugins/morris/morris.min.js') !!}
    {!! Html::script('bower_components/metronic/assets/global/plugins/morris/raphael-min.js') !!}
    {!! Html::script('bower_components/metronic/assets/pages/scripts/charts-morris.js') !!}

    <!-- BEGIN PAGE LEVEL PLUGINS -->
    {!! Html::script('bower_components/metronic/assets/global/scripts/datatable.js') !!}
    {!! Html::script('bower_components/metronic/assets/global/plugins/datatables/datatables.min.js') !!}
    {!! Html::script('bower_components/metronic/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') !!}
    {!! Html::script('bower_components/metronic/assets/pages/scripts/table-datatables-managed.min.js') !!}
    <!-- END PAGE LEVEL PLUGINS -->

    <script>
        $(window).load(function(){
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
        $('button#tables').on('click', function(){


        });
    });

    </script>
    @include('layouts.delete-modal-datatables')
    @include('layouts.detach-modal')
    @include('layouts.attachModal')

@endsection

