@extends('layouts.app')

@section('title', trans('lucy.app.logs'))

@section('header')
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    {!! Html::style('bower_components/metronic/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') !!}
    <!-- END PAGE LEVEL PLUGINS -->

@endsection

@section('page-header')
    <!-- BEGIN PAGE TITLE -->
    <div class="page-title">
        <h1>{{ trans('lucy.app.logs') }}
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
            <a href="#">{{ trans('lucy.app.user-management') }}</a>
            <i class="fa fa-circle"></i>
        </li>        
        <li>
            <span class="active">{{ trans('lucy.app.logs') }}</span>
        </li>
    </ul>
@endsection

@section('content')
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="portlet light">
                {!! Form::horizontal($form, $data) !!}
                <div class="portlet-title">
                    <div class="portlet-body form">                

                        {!! Form::group('text', 'start_date', '', $data['start_date'], ['readonly' => true, 'class' => 'start_date']) !!}
                        {!! Form::group('text', 'end_date', '', $data['end_date'], ['readonly' => true, 'class' => 'end_date']) !!}

                        {!! Form::group('select', 'user', trans('lucy.app.user'), null, ['options' => $dropdown, 'placeholder' => trans('lucy.word.all')]) !!}

                    </div>
                </div>    
                <div class="portlet-body">

                    {!! Form::submit(trans('lucy.word.show'), ['class' => 'btn green-sharp btn-outline  btn-block sbold uppercase', 'title' => trans('lucy.word.show')]) !!}

                    {!! Form::close() !!}

                </div>    
            </div>    
        </div>    
    </div>
    <div class="row">
        @if (!count($logs))
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <h1>Nothing to show</h1>    
        </div>
        @endif
        @if (count($logs))
        <div class="col-md-12">
            <!-- BEGIN TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="fa @yield('icon')"></i>
                        <span class="caption-subject bold uppercase"> {{ trans('lucy.app.logs') }}</span>
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
                    @include('flash::message')
                    <div class="table-scrollable table-scrollable-borderless">
                    <table id="@yield('table-id')" class="table table-light table-hover order-column" data-tables="true">

                        <thead>
                            <tr>
                                <th>{{ trans('lucy.app.date-time') }}</th>
                                <th>{{ trans('lucy.app.user') }}</th>
                                <th>{{ trans('lucy.app.activity') }}</th>
                                <th>{{ trans('lucy.app.ip-address') }}</th>
                                <th>{{ trans('lucy.app.user-agent') }}</th>
                            </tr>
                        </thead>
                        @foreach ($logs as $log)
                        <tbody>
                            <tr>
                                <td align="center" width="15%">{{ $log->created_at }}</td>
                                <td width="20%">{{ $log->full_name }}</td>
                                <td width="20%">{{ $log->message }}</td>
                                <td align="center" width="15%">{{ $log->ip_address }}</td>
                                <td>{{ $log->user_agent }}</td>
                            </tr>
                        </tbody>    
                        @endforeach
                    </table>
                    </div>
                </div>
            </div>
            <!-- END TABLE PORTLET-->
        </div>
        @endif

@endsection

@section('scripts')

    <script>
        $(document).ready(function () {
            $('.start_date, .end_date').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd'
            });
        });
    </script>

    {!! Html::script('bower_components/metronic/assets/global/plugins/moment.min.js') !!}
    {!! Html::script('bower_components/metronic/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') !!}

    <script src="{!! url('vendor/jsvalidation/js/jsvalidation.js')!!}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Lucy\LogRequest') !!}
@endsection