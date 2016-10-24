@extends('layouts.form')

@section('title', $title.' - Licenses')

@section('page-header', '<div class="page-title"><h1>'.trans('modules.Licenses').'<small>'.$title.'</small> </h1></div>')

@section('breadcrumb')
    <ul class="breadcrumb page-breadcrumb">
        <li><a href="{!! action('DashboardController@index') !!}"> {{ trans('lucy.app.home') }}</a><i class="fa fa-circle"></i></li>
        <li><a href="{!! action('Modules\LicenseController@index') !!}">{{ trans('modules.Licenses') }}</a></li>
        <li><span class="active">{{ $title }}</span></li>        
    </ul>
@endsection

@section('form')
    {!! Form::group('select', 'client_id', 'Client Id', $data['client_id'], ['options' => DB::table('clients')->orderBy('id')->lists('id', 'id')]) !!}
    {!! Form::group('select', 'label_id', 'Label Id', $data['label_id'], ['options' => DB::table('labels')->orderBy('id')->lists('id', 'id')]) !!}
    {!! Form::group('select', 'category_id', 'Category Id', $data['category_id'], ['options' => DB::table('license_categories')->orderBy('id')->lists('id', 'id')]) !!}
    {!! Form::group('select', 'supplier_id', 'Supplier Id', $data['supplier_id'], ['options' => DB::table('suppliers')->orderBy('id')->lists('id', 'id')]) !!}
    {!! Form::group('text', 'tag', 'Tag', $data['tag']) !!}
    {!! Form::group('text', 'name', 'Name', $data['name']) !!}
    {!! Form::group('text', 'serial', 'Serial', $data['serial']) !!}
    {!! Form::group('textarea', 'notes', 'Notes', $data['notes']) !!}
@endsection

@section('scripts')
    <script src="{!! url('vendor/jsvalidation/js/jsvalidation.js')!!}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Modules\LicenseRequest') !!}
@endsection