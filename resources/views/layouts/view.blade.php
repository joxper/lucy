@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">{{ trans('lucy.word.view') }}</h3>
                </div>
                {!! Form::open(['class' => 'form-horizontal']) !!}
                    <div class="box-body">
                        @yield('form') 
                    </div>
                    <div class="box-footer">
                        <a href="{!! $back !!}" title="{{ trans('lucy.word.back') }}" class="btn btn-primary pull-right">{{ trans('lucy.word.back') }}</a>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    @yield('extra')
@endsection