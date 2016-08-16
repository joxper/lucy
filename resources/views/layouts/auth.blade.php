<!DOCTYPE html>
<html>
    <head>
        {!! Html::meta(null, null, ['charset' => 'utf-8']) !!}
        {!! Html::meta(null, 'IE=edge,chrome=1', ['http-equiv' => 'X-UA-Compatible']) !!}
        {!! Html::meta('robots', 'noindex, nofollow') !!}
        {!! Html::meta('product', lucy_config('APP_NAME')) !!}
        {!! Html::meta('description', lucy_config('APP_DESC')) !!}
        {!! Html::meta('author', 'Roni Yusuf Manalu') !!}
        {!! Html::meta('viewport', 'width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no') !!}

        <title>@yield('title') - {{ lucy_config('APP_NAME') }}</title>

        {!! Html::style('bower_components/AdminLTE/bootstrap/css/bootstrap.min.css') !!}
        {!! Html::style('bower_components/font-awesome/css/font-awesome.min.css') !!}
        {!! Html::style('bower_components/AdminLTE/dist/css/AdminLTE.min.css') !!}
        {!! Html::style('bower_components/AdminLTE/plugins/iCheck/square/blue.css') !!}

        <link rel="icon" type="image/png" sizes="32x32" href="{!! asset('favicon.png') !!}">
    </head>
    <body class="login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href="{!! action('DashboardController@index') !!}"><b>{{ lucy_config('APP_NAME') }}</b></a>
            </div>

            <div class="login-box-body">
                @yield('content')
            </div>
        </div>

        {!! Html::script('bower_components/AdminLTE/plugins/jQuery/jQuery-2.2.0.min.js') !!}
        {!! Html::script('bower_components/AdminLTE/bootstrap/js/bootstrap.min.js') !!}
        {!! Html::script('bower_components/AdminLTE/plugins/iCheck/icheck.min.js') !!}

        <script>
            $(document).ready(function() {
                $('input').iCheck({
                    checkboxClass: 'icheckbox_square-blue'
                });
            });
        </script>

        @yield('scripts')
    </body>
</html>