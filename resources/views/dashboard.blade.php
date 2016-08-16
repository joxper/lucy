@extends('layouts.app')

@section('title', trans('lucy.app.dashboard'))

@section('header')
    {!! Html::style('bower_components/AdminLTE/plugins/morris/morris.css') !!}
@endsection

@section('page-header', trans('lucy.app.dashboard'))

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-tachometer"></i> Home</a></li>
        <li class="active">{{ trans('lucy.app.dashboard') }}</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{ $totalUsers }}</h3>
                    <p>{{ trans('lucy.app.total-users') }}</p>
                </div>
                <div class="icon">
                    <i class="fa fa-users"></i>
                </div>
                <a href="{!! action('Lucy\UserController@index') !!}" class="small-box-footer">
                    {{ trans('lucy.app.more-info') }}
                    <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>{{ $userBanned }}</h3>
                    <p>{{ trans('lucy.app.banned-users') }}</p>
                </div>
                <div class="icon">
                    <i class="fa fa-user-times"></i>
                </div>
                <a href="{!! action('Lucy\UserController@index') !!}" class="small-box-footer">
                    {{ trans('lucy.app.more-info') }}
                    <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>{{ $totalModules }}</h3>
                    <p>{{ trans('lucy.app.total-modules') }}</p>
                </div>
                <div class="icon">
                    <i class="fa fa-cubes"></i>
                </div>
                <a href="{!! action('CrudGeneratorController@index') !!}" class="small-box-footer">
                    {{ trans('lucy.app.more-info') }}
                    <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">{{ trans('lucy.app.registration-history') }} ({{ $year }})</h3>
                </div>
                <div class="box-body">
                    <div id="chart-area"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {!! Html::script('bower_components/raphael/raphael.min.js') !!}
    {!! Html::script('bower_components/AdminLTE/plugins/morris/morris.min.js') !!}

    <script>
        $(document).ready(function() {
            Morris.Area({
                element: 'chart-area',
                data: {!! $chart !!},
                xkey: 'y',
                ykeys: ['a'],
                labels: ['Total'],
                dateFormat: function(date) {
                    date = new Date(date);

                    return date.toLocaleString('en-us', {month: 'long'});
                },
                xLabelFormat: function(x) {
                    return x.toLocaleString('en-us', {month: 'short'});
                },
                yLabelFormat: function(y) {
                    var add = '';

                    if (y > 1) {
                        add = 's';
                    }

                    return y+' User'+add;
                }
            });
        });
    </script>
@endsection