@extends('layouts.app')

@section('title', trans('lucy.app.crud-generator'))

@section('header')
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    {!! Html::style('assets/global/plugins/datatables/datatables.min.css') !!}
    {!! Html::style('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') !!}
    <!-- END PAGE LEVEL PLUGINS -->
@endsection
 

@section('page-header')
    <!-- BEGIN PAGE TITLE -->
    <div class="page-title">
        <h1>{{ trans('lucy.app.crud-generator') }}
            <small>{{ trans('lucy.word.list') }}</small>
        </h1>
    </div>
    <!-- END PAGE TITLE -->
@endsection

@section('breadcrumb')
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="{!! action('DashboardController@index') !!}">{{ trans('lucy.app.home') }}</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span class="active">{{ trans('lucy.app.crud-generator') }}</span>
        </li>
    </ul>
@endsection

@section('content')

    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="fa fa-cogs"></i>
                    <span class="caption-subject bold uppercase"> {{ trans('lucy.app.crud-generator-list') }}</span>
                </div>
            </div>
            <div class="portlet-body">
                @include('flash::message')
                <div class="table-toolbar">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="btn-group">
                            @access('crud.create')
                                <a class="btn sbold green" href="{!! action('CrudGeneratorController@create') !!}" title="{{ trans('lucy.word.create') }}"> Add New <i class="fa fa-plus"></i></a>
                            @endaccess                            
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="crud-table" data-tables="true">
                    <thead>
                        <tr>
                            <th class="center-align">Module</th>
                            <th class="center-align">Description</th>
                            <th class="center-align">Table Name</th>
                            <th width="12%">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>

@endsection

@section('scripts')

    <!-- BEGIN PAGE LEVEL PLUGINS -->
    {!! Html::script('assets/global/scripts/datatable.js') !!}
    {!! Html::script('assets/global/plugins/datatables/datatables.min.js') !!}
    {!! Html::script('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') !!}
    {!! Html::script('assets/pages/scripts/table-datatables-managed.min.js') !!}
    <!-- END PAGE LEVEL PLUGINS -->



    <script>
        $(document).ready(function() {
            $('#crud-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! action('CrudGeneratorController@datatables') !!}',
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'description', name: 'description'},
                    {data: 'table_name', name: 'table_name'},
                    {data: 'action', name: 'action', class: 'center-align', searchable: false, orderable: false}
                ],
                paging: true,
                lengthChange: true,
                searching: true,
                ordering: true,
                info: true,
                autoWidth: false,
                pagingType: 'bootstrap_extended'
            });
        });
    </script>
    @include('layouts.delete-modal-datatables')
@endsection