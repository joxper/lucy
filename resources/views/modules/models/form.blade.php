@extends('layouts.form')

@section('title', $title.' - Models')

@section('page-header', '<div class="page-title"><h1>'.trans('modules.Models').'<small>'.$title.'</small> </h1></div>')

@section('breadcrumb')
    <ul class="breadcrumb page-breadcrumb">
        <li><a href="{!! action('DashboardController@index') !!}"> {{ trans('lucy.app.home') }}</a><i class="fa fa-circle"></i></li>
        <li><a href="{!! action('Modules\ModelController@index') !!}">{{ trans('modules.Models') }}</a></li>
        <li><span class="active">{{ $title }}</span></li>        
    </ul>
@endsection

@section('form')
    {!! Form::group('select', 'manufacturer_id', 'Manufacturer Id', $data['manufacturer_id'], ['options' => DB::table('manufacturers')->orderBy('id')->lists('id', 'id')]) !!}
    {!! Form::group('text', 'name', 'Name', $data['name']) !!}
@endsection

@section('scripts')
    <script src="{!! url('vendor/jsvalidation/js/jsvalidation.js')!!}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Modules\ModelRequest') !!}
@endsection