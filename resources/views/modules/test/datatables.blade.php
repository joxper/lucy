@extends('layouts.app')

@section('header')
    {!! Html::style('bower_components/metronic/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') !!}
    {!! Html::style('bower_components/metronic/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') !!}
    {!! Html::style('bower_components/metronic/assets/global/plugins/datatables/plugins/buttons/css/buttons.dataTables.css') !!}
    <style>
        .center-align {
            text-align: center;
        }
    </style>
@endsection

@section('content')
                       <div class="col-md-12">
                            <!-- Begin: life time stats -->
                            <div class="portlet light portlet-fit portlet-datatable bordered">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-settings font-green"></i>
                                        <span class="caption-subject font-green sbold uppercase">Trigger Tools From Dropdown Menu</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="table-container">
                                         {!! $dataTable->table(['class' => 'table table-striped table-bordered table-hover table-checkable order-column dataTable no-footer']) !!}
                                    </div>
                                </div>
                            </div>
                            <!-- End: life time stats -->
                        </div>


@endsection

@section('scripts')

    <!-- BEGIN PAGE LEVEL PLUGINS -->
    {!! Html::script('bower_components/metronic/assets/global/scripts/datatable.js') !!}
    {!! Html::script('bower_components/metronic/assets/global/plugins/datatables/datatables.min.js') !!}
    {!! Html::script('bower_components/metronic/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') !!}
    {!! Html::script('bower_components/metronic/assets/pages/scripts/table-datatables-managed.min.js') !!}
    {!! Html::script('bower_components/metronic/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') !!}
    <!-- END PAGE LEVEL PLUGINS -->
    {!! Html::script('bower_components/metronic/assets/pages/scripts/table-datatables-buttons.min.js') !!}
<script src="/vendor/datatables/buttons.server-side.js"></script>

{!! $dataTable->scripts() !!}
@endsection




