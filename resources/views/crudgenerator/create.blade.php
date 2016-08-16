@extends('layouts.app')

@section('title', trans('lucy.word.create').' - '.trans('lucy.app.crud-generator'))

@section('header')
    {!! Html::style('bower_components/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css') !!}
    {!! Html::style('bower_components/sweetalert/dist/sweetalert.css') !!}
    {!! Html::style('bower_components/fontawesome-iconpicker/dist/css/fontawesome-iconpicker.min.css') !!}

    <style>
        .center-align {
            text-align: center;
        }
    </style>
@endsection

@section('page-header', trans('lucy.app.crud-generator').' <small>'.trans('lucy.word.create').'</small>')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{!! action('DashboardController@index') !!}"><i class="fa fa-cogs"></i> {{ trans('lucy.app.home') }}</a></li>
        <li><a href="{!! action('CrudGeneratorController@index') !!}">{{ trans('lucy.app.crud-generator') }}</a></li>
        <li class="active">{{ trans('lucy.word.create') }}</li>
    </ol>
@endsection

@section('content')
        <div class="col-md-12">

            <!-- BEGIN FORM PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject font-dark sbold uppercase">{{ trans('lucy.word.create') }}</span>
                    </div>
                </div>                
                <div class="portlet-body form">
                        {!! Form::horizontal_2($form) !!}
                        <div class="form-body">
                            @include('flash::message')
                        <fieldset>
                            <legend>{{ trans('lucy.app.general') }}</legend>
                            {!! Form::group2('text', 'name', trans('lucy.form.name'), null) !!}
                            {!! Form::group2('textarea', 'description', trans('lucy.form.description'), null) !!}
                            {!! Form::group2('text', 'icon', trans('lucy.form.icon'), null, ['readonly' => 'readonly', 'placeholder' => trans('lucy.message.select-icon')]) !!}
                        </fieldset>
                        <fieldset>
                            <legend>Table</legend>
                            {!! Form::group2('text', 'table', trans('lucy.app.table-name'), null, ['help_block' => trans('lucy.message.table-help-block')]) !!}

                            <div class="alert alert-warning alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4>{{ trans('lucy.word.attention') }}!</h4>
                                <p>{!! nl2br(trans('lucy.message.dont-add-id')) !!}</p>
                            </div>

                            <table class="table table-bordered table-hover" id="columns-table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th>
                                            Length <span class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('lucy.app.length-column-tooltip') }}">
                                        </th>
                                        <th>
                                            Default <span class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('lucy.app.default-values-tooltip') }}"></span>
                                        </th>
                                        <th>Nullable?</th>
                                        <th>Comment</th>
                                        <th>Relationship</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @for ($i = 0; $i < 20; $i++)
                                        <tr>
                                            <td>
                                                {!! Form::text('columns['.$i.'][name]', null, ['class' => 'form-control', 'id' => 'columns_'.$i.'_name']) !!}
                                            </td>
                                            <td>
                                                {!! Form::select('columns['.$i.'][type]', $dropdownColumns, null, ['class' => 'form-control', 'id' => 'columns_'.$i.'_type']) !!}
                                            </td>
                                            <td>
                                                {!! Form::text('columns['.$i.'][length_values]', null, ['class' => 'form-control', 'id' => 'columns_'.$i.'_length_values']) !!}
                                            </td>
                                            <td>
                                                {!! Form::text('columns['.$i.'][default]', null, ['class' => 'form-control', 'id' => 'columns_'.$i.'_default']) !!}
                                            </td>
                                            <td align="center">
                                                {!! Form::checkbox('columns['.$i.'][nullable]', true, false, ['class' => 'switch', 'data-on-text' => trans('lucy.word.yes'), 'data-off-text' => trans('lucy.word.no'), 'id' => 'columns_'.$i.'_nullable']) !!}
                                            </td>
                                            <td>
                                                {!! Form::text('columns['.$i.'][comment]', null, ['class' => 'form-control', 'id' => 'columns_'.$i.'_comment']) !!}
                                            </td>
                                            <td align="center">
                                                {!! Form::hidden('columns['.$i.'][on]', null, ['id' => 'columns_'.$i.'_on']) !!}
                                                {!! Form::hidden('columns['.$i.'][references]', null, ['id' => 'columns_'.$i.'_references']) !!}
                                                {!! Form::hidden('columns['.$i.'][relationship]', null, ['id' => 'columns_'.$i.'_relationship']) !!}
                                                <button type="button" class="btn btn-success relationship" data-id="{{ $i }}" id="relationship_{{ $i }}"><i class="fa fa-plus" id="relationship_icon_{{ $i }}"></i></button>
                                            </td>
                                        </tr>
                                    @endfor
                                </tbody>
                            </table>
                        </fieldset>
                        </div>
                        <div class="form-actions right1">
                            <a href="{!! action('CrudGeneratorController@index') !!}" title="{{ trans('lucy.word.back') }}" class="btn btn-default">{{ trans('lucy.word.back') }}</a> 
                            {!! Form::submit(trans('lucy.word.save'), ['class' => 'btn green', 'title' => trans('lucy.word.save')]) !!}
                        </div>                        
                        {!! Form::close() !!}
                </div>
            </div>
        </div>    
    <div class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" id="relationship_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="{{ trans('lucy.word.cancel') }}"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">{{ trans('lucy.app.add-relationship') }}</h4>
                </div>
                <div class="modal-body">
                    <form action="#" accept-charset="utf-8" class="form-horizontal">
                        {!! Form::hidden('column_id', null, ['id' => 'table_id']) !!}
                        {!! Form::group2('static', strtolower(trans('lucy.word.column')), trans('lucy.word.column')) !!}
                        {!! Form::group2('select', strtolower(trans('lucy.word.table')), trans('lucy.word.table'), null, ['options' => $dropdownTables, 'id' => 'table_on']) !!}
                        {!! Form::group2('select', strtolower(trans('lucy.word.references')), trans('lucy.word.references'), null, ['options' => [], 'id' => 'table_references']) !!}
                        {!! Form::group2('select', strtolower(trans('lucy.word.relationship')), trans('lucy.word.relationship'), null, ['options' => $dropdownRelationship, 'id' => 'table_relationship']) !!}
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('lucy.word.cancel') }}</button>
                    <button type="button" class="btn btn-primary" id="relationship_btn">{{ trans('lucy.word.save') }}</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {!! Html::script('bower_components/bootstrap-switch/dist/js/bootstrap-switch.min.js') !!}
    {!! Html::script('bower_components/sweetalert/dist/sweetalert.min.js') !!}
    {!! Html::script('bower_components/fontawesome-iconpicker/dist/js/fontawesome-iconpicker.min.js') !!}
    <script src="{!! url('vendor/jsvalidation/js/jsvalidation.js')!!}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\CreateCrudRequest') !!}

    <script>
        $(document).ready(function () {

            function get_columns_by_table(table) {
                $.ajax({
                    url: '{!! action('CrudGeneratorController@columns') !!}',
                    data: {table: table},
                    dataType: 'json',
                    type: 'POST',
                    success: function (result) {
                        $('#table_references').empty();

                        $.each(result, function (key, value) {
                            $('#table_references').append('<option value="'+key+'">'+value+'</option>');
                        });
                    }
                });
            }

            $('[data-toggle="tooltip"]').tooltip();

            $('.switch').bootstrapSwitch({
                size: 'small'
            });

            $('#icon').iconpicker({
                placement: 'bottomLeft',
                hideOnSelect: true
            });

            $('.relationship').click(function (event) {
                var id = $(this).attr('data-id');

                if ($(this).hasClass('btn-success')) {
                    var column = $('#columns_'+id+'_name').val();

                    if (! column.length) {
                        swal('Oops...', '{!! addslashes(trans('lucy.app.fill-the-column-first')) !!}', 'error');
                        return false;
                    }

                    $('.form-control-static').empty().append(column);
                    $('#table_id').val(id);
                    $('#relationship_modal').modal('show');
                    get_columns_by_table($('#table_on').val());
                } else {
                    $('#columns_'+id+'_on').val(null);
                    $('#columns_'+id+'_references').val(null);
                    $('#columns_'+id+'_relationship').val(null);
                    $('#relationship_'+id).removeClass('btn-danger').addClass('btn-success');
                    $('#relationship_icon_'+id).removeClass('fa-remove').addClass('fa-plus');
                }
            });

            $('#table_on').change(function () {
                get_columns_by_table($(this).val());
            });

            $('#relationship_btn').click(function () {
                var id = $('#table_id').val();

                if ('integer' != $('#columns_'+id+'_type').val()) {
                    swal('Oops...', '{!! addslashes(trans('lucy.app.must-integer')) !!}', 'error');
                    return false;
                }

                var on = $('#table_on').val();
                var references = $('#table_references').val();
                var relationship = $('#table_relationship').val();

                $('#columns_'+id+'_on').val(on);
                $('#columns_'+id+'_references').val(references);
                $('#columns_'+id+'_relationship').val(relationship);
                $('#relationship_'+id).removeClass('btn-success').addClass('btn-danger');
                $('#relationship_icon_'+id).removeClass('fa-plus').addClass('fa-remove');

                $('#relationship_modal').modal('hide');
            });

        });
    </script>
@endsection