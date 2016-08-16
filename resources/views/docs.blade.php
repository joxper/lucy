<!DOCTYPE html>
<html>
    <head>
        {!! Html::meta(null, null, ['charset' => 'utf-8']) !!}
        {!! Html::meta(null, 'IE=edge,chrome=1', ['http-equiv' => 'X-UA-Compatible']) !!}
        {!! Html::meta('robots', 'noindex, nofollow') !!}
        {!! Html::meta('csrf-token', csrf_token()) !!}
        {!! Html::meta('product', lucy_config('APP_NAME')) !!}
        {!! Html::meta('description', lucy_config('APP_DESC')) !!}
        {!! Html::meta('author', 'Roni Yusuf Manalu') !!}
        {!! Html::meta('viewport', 'width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no') !!}

        <title>{{ $title }} - {{ trans('lucy.app.docs') }} - {{ lucy_config('APP_NAME') }}</title>

        {!! Html::style('bower_components/AdminLTE/bootstrap/css/bootstrap.min.css') !!}
        {!! Html::style('bower_components/font-awesome/css/font-awesome.min.css') !!}

        @yield('header')

        {!! Html::style('bower_components/AdminLTE/dist/css/AdminLTE.min.css') !!}
        {!! Html::style('bower_components/AdminLTE/dist/css/skins/skin-'.$skin.'.min.css') !!}
        {!! Html::style('bower_components/AdminLTE/plugins/pace/pace.min.css') !!}

        <link rel="icon" type="image/png" sizes="32x32" href="{!! asset('favicon.png') !!}">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-{{ $skin }} hold-transition sidebar-mini">
        <div class="wrapper">
            <header class="main-header">
                <a href="{!! action('DashboardController@index') !!}" class="logo" title="{{ lucy_config('APP_NAME') }}">
                    <span class="logo-mini"><b>{{ lucy_config('APP_INITIAL') }}</b></span>
                    <span class="logo-lg"><b>{{ lucy_config('APP_NAME') }}</b></span>
                </a>

                <nav class="navbar navbar-static-top" role="navigation">
                    <a href="#"  class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                </nav>
            </header>
            <aside class="main-sidebar">
                <section class="sidebar">
                    {!! $index !!}
                </section>
            </aside>

            <div class="content-wrapper">
                <section class="content-header">
                    <h1>{{ $title }}</h1>

                    <ol class="breadcrumb">
                        <li><a href="{!! action('DashboardController@index') !!}"><i class="fa fa-book"></i> {{ trans('lucy.app.home') }}</a></li>
                        <li><a href="#">{{ trans('lucy.app.docs') }}</a></li>
                        <li class="active">{{ $title }}</li>
                    </ol>
                </section>

                <section class="content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box box-primary">
                                <div class="box-body">
                                    {!! $content !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <footer class="main-footer">
                <strong>Copyright &copy; {{ date('Y') }} <a href="https://twitter.com/RYManalu" title="Roni Yusuf Manalu on Twitter" target="_blank">Roni Yusuf Manalu</a></strong>. All rights reserved.
            </footer>
        </div>

        {!! Html::script('bower_components/AdminLTE/plugins/jQuery/jQuery-2.2.0.min.js') !!}
        {!! Html::script('bower_components/AdminLTE/bootstrap/js/bootstrap.min.js') !!}
        {!! Html::script('bower_components/AdminLTE/dist/js/app.min.js') !!}
        {!! Html::script('bower_components/AdminLTE/plugins/slimScroll/jquery.slimscroll.min.js') !!}
        {!! Html::script('bower_components/AdminLTE/plugins/pace/pace.min.js') !!}

        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).ajaxStart(function() {
                Pace.restart();
            });
        </script>

        @yield('scripts')
    </body>
</html>