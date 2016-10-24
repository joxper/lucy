@extends('layouts.form')

@section('title', $title.' - Devices')

@section('header')
    {!! Html::style('bower_components/AdminLTE/plugins/datepicker/datepicker3.css') !!}
@endsection

@section('page-header', '<div class="page-title"><h1>'.trans('modules.Devices').'<small>'.$title.'</small> </h1></div>')

@section('breadcrumb')
    <ul class="breadcrumb page-breadcrumb">
        <li><a href="{!! action('DashboardController@index') !!}"> {{ trans('lucy.app.home') }}</a><i class="fa fa-circle"></i></li>
        <li><a href="{!! action('Modules\DeviceController@index') !!}">{{ trans('modules.Devices') }}</a></li>
        <li><span class="active">{{ $title }}</span></li>        
    </ul>
@endsection

@section('form')
    {!! Form::group('text', 'name', 'Name', $data['name']) !!}
    {!! Form::group('select', 'category_id', 'Category Id', $data['category_id'], ['options' => DB::table('device_category')->orderBy('id')->lists('id', 'id')]) !!}
    {!! Form::group('select', 'client_id', 'Client Id', $data['client_id'], ['options' => DB::table('clients')->orderBy('id')->lists('id', 'id')]) !!}
    {!! Form::group('select', 'user_id', 'User Id', $data['user_id'], ['options' => DB::table('users')->orderBy('id')->lists('id', 'id')]) !!}
    {!! Form::group('select', 'admin_id', 'Admin Id', $data['admin_id'], ['options' => DB::table('users')->orderBy('id')->lists('id', 'id')]) !!}
    {!! Form::group('select', 'supplier_id', 'Supplier Id', $data['supplier_id'], ['options' => DB::table('suppliers')->orderBy('id')->lists('id', 'id')]) !!}
    {!! Form::group('select', 'label_id', 'Label Id', $data['label_id'], ['options' => DB::table('labels')->orderBy('id')->lists('id', 'id')]) !!}
    {!! Form::group('text', 'purchase_date', 'Purchase Date', $data['purchase_date'], ['readonly' => true, 'class' => 'lucy-date']) !!}
    {!! Form::group('number', 'warranty_months', 'Warranty Months', $data['warranty_months']) !!}
    {!! Form::group('text', 'tag', 'Tag', $data['tag']) !!}
    {!! Form::group('text', 'serial', 'Serial', $data['serial']) !!}
    {!! Form::group('textarea', 'notes', 'Notes', $data['notes']) !!}
@endsection

@section('scripts')
    <script src="{!! url('vendor/jsvalidation/js/jsvalidation.js')!!}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Modules\DeviceRequest') !!}
    {!! Html::script('bower_components/AdminLTE/plugins/datepicker/bootstrap-datepicker.js') !!}

    <script>
        $(document).ready(function () {
            $('.lucy-date').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd'
            });
        });
    </script>
@endsection