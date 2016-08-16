@extends('layouts.app')

@section('content')
        <div class="col-md-8 col-md-offset-2">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-green">
                    <i class="icon-pin font-green"></i>
                    <span class="caption-subject bold uppercase"> {{ $title }}</span>
                </div>
                <div class="actions">
                    <div class="btn-group">
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
                    </div>
                </div>
                <div class="portlet-body form">
                {!! Form::horizontal($form, $data) !!}
                    <div class="form-body">
                            @yield('form')     
                    </div>
                    <div class="form-actions noborder">
                        <a href="{!! $back !!}" title="{{ trans('lucy.word.back') }}" class="btn btn-default">{{ trans('lucy.word.back') }}</a> {!! Form::submit(trans('lucy.word.save'), ['class' => 'btn btn-primary pull-right', 'title' => trans('lucy.word.save')]) !!}
                    </div>                    
                {!! Form::close() !!}
            </div>
        </div>
@endsection
