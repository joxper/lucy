@extends('layouts.view-dash')

@section('title', trans('lucy.word.view').' - Clients')

@section('page-header', '<div class="page-title"><h1>'.$client['name'].'<small>'.trans('lucy.word.view').'</small> </h1></div>')

@section('header')
{!! Html::style('bower_components/metronic/assets/global/plugins/morris/morris.css') !!}

<!-- BEGIN PAGE LEVEL PLUGINS -->
{!! Html::style('bower_components/metronic/assets/global/plugins/datatables/datatables.min.css') !!}
{!! Html::style('bower_components/metronic/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') !!}
{!! Html::style('bower_components/metronic/assets/layouts/layout4/css/custom.css') !!}
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
    @foreach($tabs as $tab)
    <li class="">
        <a href="#{{$tab}}" data-toggle="tab" aria-expanded="false" onclick="{{$tab}}DataTables()"> {{$tab}} </a>
    </li>
    @endforeach
@endsection

@section('actions')
    @access('clientsadmins.create')
        @if (count($NotAssignedAdmins) > 1)
        <button id="attach_btn" class="btn btn-circle btn-icon-only btn-default" data-id="{{$client['id']}}">
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
    @foreach($tabs as $tab)
        @php( $blade = 'modules.clients.tabs.'.$tab )
        @include($blade, ['tab' => $tab])
    @endforeach
@endsection
@section('attachForm')
    {{ Form::open(['method' => 'POST',
               'action' => [
                    'Modules\ClientController@attachUser',
                    'id' => $client['id']
                    ],
               'id'     => 'attachForm',
               'style'  => 'display:none;',
               'title'  => trans('modules.clients.attachAdmin')
               ]) }}
    {!! Form::group('select', 'user_id', 'Staff', 'Staff', ['options' => $NotAssignedAdmins]) !!}
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
    <script src="/vendor/datatables/buttons.server-side.js"></script>

        {!! $dataTable->scripts() !!}

    @include('layouts.delete-modal-datatables')
    @include('layouts.detach-modal')
    @include('layouts.attachModal')
    @yield('dataTablesScripts')
@endsection



