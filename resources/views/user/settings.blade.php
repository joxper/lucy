@extends('user.layout')


@section('page-styles')
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    {!! Html::style('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') !!}
    <!-- END PAGE LEVEL PLUGINS -->
@endsection


@section('profile-content')
        <div class="profile-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light bordered">
                        <div class="portlet-title tabbable-line">
                            <div class="caption caption-md">
                                <i class="icon-globe theme-font hide"></i>
                                <span class="caption-subject font-blue-madison bold uppercase">Profile Account</span>
                            </div>
                            <ul class="nav nav-tabs">
                                <li{!! ('profile' == session('tab_active')) ? ' class="active"' : ''  !!}><a href="#tab-profile" data-toggle="tab">{{ trans('lucy.app.profile') }}</a></li>
                                <li{!! ('password' == session('tab_active')) ? ' class="active"' : ''  !!}><a href="#tab-password" data-toggle="tab">{{ trans('lucy.form.password') }}</a></li>
                                <li{!! ('privacy' == session('tab_active')) ? ' class="active"' : ''  !!}><a href="#tab-privacy" data-toggle="tab">{{ trans('Privacy') }}</a></li>         
                            </ul>
                        </div>
                        <div class="portlet-body">
                            <div class="tab-content">
                                <!-- PERSONAL INFO TAB -->
                                <div class="tab-pane active" id="tab-profile">
                                    {!! Form::horizontal($formProfile, $user) !!}
                                        <div class="row">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-8">
                                            @if ($user['avatar'] && file_exists(avatar_path($user['avatar'])))
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">                    
                                                <img src="{!! link_to_avatar($user['avatar']) !!}" alt="" lass="img-circle img-responsive"/> 
                                            </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                            @else
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"> </div>
                                            @endif
                                            </div> 
                                            <div>
                                                <span class="btn default btn-file">
                                                    <span class="fileinput-new"> Select image </span>
                                                    <span class="fileinput-exists"> Change </span>
                                                    <input type="file" name="avatar" id="avatar"> </span>
                                                <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="col-xs-12" style="height:50px;"></div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                {!! Form::group('text', 'first_name', trans('lucy.form.first_name'), $user['first_name']) !!}
                                            </div>
                                            <div class="col-md-6">
                                                {!! Form::group('text', 'last_name', trans('lucy.form.last_name'), $user['last_name']) !!}   
                                            </div>
                                        </div>                                                                                
                                        {!! Form::group('text', 'email', trans('lucy.form.email'), $user['email']) !!}
                                        {!! Form::group('text', 'username', trans('lucy.form.username'), $user['username']) !!}
{{--                                         {!! Form::group('phone', 'phone', trans('lucy.form.phone'), $user['phone']) !!}
                                        {!! Form::group('text', 'position', trans('lucy.form.position'), $user['position']) !!}   
                                        {!! Form::group('textarea', 'signature', trans('lucy.form.signature'), $user['signature']) !!}                                                                            --}}
                                        <div class="margiv-top-10">
                                            {!! Form::submit(trans('lucy.word.save'), ['class' => 'btn green']) !!}
                                        </div>
                                    {!! Form::close() !!}
                                </div>
                                <!-- END PERSONAL INFO TAB -->
                                <!-- CHANGE PASSWORD TAB -->
                                <div class="tab-pane" id="tab-password">
                                    {!! Form::horizontal($formPassword) !!}

                                        <div class="form-group form-md-line-input {{ Form::hasError('old_password') }}">
                                            {!! Form::password('old_password', ['class' => 'form-control']) !!}
                                            <span id="old_password" class="help-block help-block-error">{!! Form::errorMsg('old_password') !!}</span>
                                            {!! Form::label('old_password', trans('lucy.form.old-password'), ['class' => 'control-label']) !!}
                                        </div>
                                        <div class="form-group form-md-line-input {{ Form::hasError('password') }}">
                                            {!! Form::password('password', ['class' => 'form-control']) !!}
                                            <span id="password" class="help-block help-block-error">{!! Form::errorMsg('password') !!}</span>
                                            {!! Form::label('password', trans('lucy.form.new-password'), ['class' => 'control-label']) !!}
                                        </div>                                      
                                        <div class="form-group form-md-line-input {{ Form::hasError('password_confirmation') }}">
                                            {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                                            <span id="password_confirmation" class="help-block help-block-error">{!! Form::errorMsg('password_confirmation') !!}</span>
                                            {!! Form::label('password_confirmation', trans('lucy.form.confirm-password'), ['class' => 'control-label']) !!}
                                        </div>   
                                         <div class="margiv-top-10">
                                            {!! Form::submit(trans('lucy.word.save'), ['class' => 'btn green']) !!}
                                        </div>
                                    {!! Form::close() !!}                                       
                                </div>
                                <!-- END CHANGE PASSWORD TAB -->
                                <!-- PRIVACY SETTINGS TAB -->
                                <div class="tab-pane" id="tab-privacy">
                                    <form action="#">
                                        <table class="table table-light table-hover">
                                            <tr>
                                                <td> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus.. </td>
                                                <td>
                                                    <div class="mt-radio-inline">
                                                        <label class="mt-radio">
                                                            <input type="radio" name="optionsRadios1" value="option1" /> Yes
                                                            <span></span>
                                                        </label>
                                                        <label class="mt-radio">
                                                            <input type="radio" name="optionsRadios1" value="option2" checked/> No
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td> Enim eiusmod high life accusamus terry richardson ad squid wolf moon </td>
                                                <td>
                                                    <div class="mt-radio-inline">
                                                        <label class="mt-radio">
                                                            <input type="radio" name="optionsRadios11" value="option1" /> Yes
                                                            <span></span>
                                                        </label>
                                                        <label class="mt-radio">
                                                            <input type="radio" name="optionsRadios11" value="option2" checked/> No
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td> Enim eiusmod high life accusamus terry richardson ad squid wolf moon </td>
                                                <td>
                                                    <div class="mt-radio-inline">
                                                        <label class="mt-radio">
                                                            <input type="radio" name="optionsRadios21" value="option1" /> Yes
                                                            <span></span>
                                                        </label>
                                                        <label class="mt-radio">
                                                            <input type="radio" name="optionsRadios21" value="option2" checked/> No
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td> Enim eiusmod high life accusamus terry richardson ad squid wolf moon </td>
                                                <td>
                                                    <div class="mt-radio-inline">
                                                        <label class="mt-radio">
                                                            <input type="radio" name="optionsRadios31" value="option1" /> Yes
                                                            <span></span>
                                                        </label>
                                                        <label class="mt-radio">
                                                            <input type="radio" name="optionsRadios31" value="option2" checked/> No
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                        <!--end profile-settings-->
                                        <div class="margin-top-10">
                                            <a href="javascript:;" class="btn red"> Save Changes </a>
                                            <a href="javascript:;" class="btn default"> Cancel </a>
                                        </div>
                                    </form>
                                </div>
                                <!-- END PRIVACY SETTINGS TAB -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('page-scripts')
    <script src="{!! url('vendor/jsvalidation/js/jsvalidation.js')!!}"></script>
    {!! $profileValidator->selector('#form-profile') !!}
    {!! $passwordValidator->selector('#form-password') !!}

    <!-- BEGIN PAGE LEVEL PLUGINS -->
    {!! Html::script('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') !!}
    {!! Html::script('assets/global/plugins/jquery.sparkline.min.js') !!}
    <!-- END PAGE LEVEL PLUGINS -->
@endsection