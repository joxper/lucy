<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>@yield('title')</title>
    </head>
    <body>
        <table cellspacing="0" cellpadding="0" border="0" width="100%">
            <tr>
                <td align="center">
                    <!-- This setup makes the nav background stretch the whole width of the screen. -->
                    <table width="650px" cellspacing="0" cellpadding="3">
                        <tr>
                            <td colspan="4"><h3><a href="{!! action('DashboardController@index') !!}"><strong>{{ lucy_config('APP_NAME') }} - {{ lucy_config('APP_DESC') }}</strong></a></h3></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td bgcolor="#FFFFFF" align="center">
                    <table width="650px" cellspacing="0" cellpadding="3">
                        <tr>
                            <td>@yield('content')</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td bgcolor="#FFFFFF" align="center">
                    <table width="650px" cellspacing="0" cellpadding="3">
                        <tr>
                            <td>
                                <hr>
                                <p><strong>Copyright &copy; {{ date('Y') }} <a href="https://twitter.com/RYManalu" title="Roni Yusuf Manalu on Twitter" target="_blank">Roni Yusuf Manalu</a></strong>. All rights reserved.</p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
</html>