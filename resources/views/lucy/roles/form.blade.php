@extends('layouts.form')

@section('title', $title.' - '.trans('lucy.app.roles'))

@section('header')
    {!! Html::style('bower_components/AdminLTE/plugins/select2/select2.min.css') !!}
@endsection

@section('page-header', trans('lucy.app.roles').' <small>'.$title.'</small>')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{!! action('DashboardController@index') !!}"><i class="fa fa-user"></i> {{ trans('lucy.app.home') }}</a></li>
        <li><a href="#">{{ trans('lucy.app.user-management') }}</a></li>
        <li><a href="{!! action('Lucy\PermissionController@index') !!}">{{ trans('lucy.app.roles') }}</a></li>
        <li class="active">{{ $title }}</li>
    </ol>
@endsection

@section('form')
    {!! Form::group('text', 'slug', trans('lucy.form.slug'), $data['slug'], $data['readonly']) !!}
    {!! Form::group('text', 'name', trans('lucy.form.name'), $data['name']) !!}
    @if ($data['is_admin'])
        {!! Form::group('static', 'permissions', trans('lucy.app.permissions'), trans('lucy.message.all-permissions-granted')) !!}
    @else
        {!! Form::group('select', 'permissions[]', trans('lucy.app.permissions'), $data['permissions'], ['options' => $data['dropdown'], 'multiple' => 'multiple', 'class' => 'form-control select2', 'id' => 'permissions']) !!}
    @endif
@endsection

@section('scripts')
    {!! Html::script('bower_components/AdminLTE/plugins/select2/select2.min.js') !!}

    <script>
        $(document).ready(function () {
            $('#permissions').select2();
        });
    </script>

    <script src="{!! url('vendor/jsvalidation/js/jsvalidation.js')!!}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Lucy\RoleRequest') !!}
@endsection