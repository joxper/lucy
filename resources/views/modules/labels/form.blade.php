@extends('layouts.form')

@section('title', $title.' - Labels')

@section('page-header', '<div class="page-title"><h1>'.trans('modules.Labels').'<small>'.$title.'</small> </h1></div>')

@section('breadcrumb')
    <ul class="breadcrumb page-breadcrumb">
        <li><a href="{!! action('DashboardController@index') !!}"> {{ trans('lucy.app.home') }}</a><i class="fa fa-circle"></i></li>
        <li><a href="{!! action('Modules\LabelController@index') !!}">{{ trans('modules.Labels') }}</a></li>
        <li><span class="active">{{ $title }}</span></li>        
    </ul>
@endsection

@section('form')
    {!! Form::group('text', 'name', 'Name', $data['name']) !!}
    <div class="container">
        <table>
            <tr>
                <td style="padding-right:5px;">
                    <div id="preview" class="swatch {!! (is_null($data['color'])) ? '' : 'bg-' . $data['color'] !!}" style="background-color:{!! (is_null($data['color'])) ? ' #3598DC' : $data['color'] !!}" ></div>
                </td>
                <td>
                    <input id="color" name="color" value="{{ $data['color'] }}" style="display:none;">
                    <div class="dropdown">
                        <a class="dropdown-toggle btn btn-default" data-toggle="dropdown" href="#" style="color:#000;">Pick Color</a>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                            <div class="table-responsive">
                            <table class="table swatch-table" id="swatch-table">
                                <tr>
                                    <td><div id="white" class="swatch swatch-clickable" style="background-color:#FFFFFF"></div></td>
                                    <td><div id="grey-cararra" class="swatch swatch-clickable" style="background-color:#FAFAFA"></div></td>
                                    <td><div id="default" class="swatch swatch-clickable" style="background-color:#E1E5EC"></div></td>  
                                    <td><div id="grey" class="swatch swatch-clickable" style="background-color:#E5E5E5"></div></td>                              
                                    <td><div id="grey-steel" class="swatch swatch-clickable" style="background-color:#E9EDEF"></div></td>
                                    <td><div id="grey-gallery" class="swatch swatch-clickable" style="background-color:#555555"></div></td>
                                    <td><div id="grey-cascade" class="swatch swatch-clickable" style="background-color:#95A5A6"></div></td>
                                    <td><div id="grey-silver" class="swatch swatch-clickable" style="background-color:#BFBFBF"></div></td>
                                    <td><div id="grey-salsa" class="swatch swatch-clickable" style="background-color:#ACB5C3"></div></td>
                                    <td><div id="grey-salt" class="swatch swatch-clickable" style="background-color:#BFCAD1"></div></td>
                                    <td><div id="blue-oleo" class="swatch swatch-clickable" style="background-color:#94A0B2"></div></td>
                                    <td><div id="grey-mint" class="swatch swatch-clickable" style="background-color:#525E64"></div></td>
                                </tr><tr>    
                                    <td><div id="dark" class="swatch swatch-clickable" style="background-color:#2F353B"></div></td>
                                    <td><div id="blue" class="swatch swatch-clickable" style="background-color:#3598DC"></div></td>
                                    <td><div id="blue-madison" class="swatch swatch-clickable" style="background-color:#578EBE"></div></td>
                                    <td><div id="blue-chambray" class="swatch swatch-clickable" style="background-color:#2C3E50"></div></td>
                                    <td><div id="blue-ebonyclay" class="swatch swatch-clickable" style="background-color:#22313F"></div></td>
                                    <td><div id="blue-hoki" class="swatch swatch-clickable" style="background-color:#67809F"></div></td>
                                    <td><div id="blue-steel" class="swatch swatch-clickable" style="background-color:#4B77BE"></div></td>
                                    <td><div id="blue-soft" class="swatch swatch-clickable" style="background-color:#4C87B9"></div></td>
                                    <td><div id="blue-dark" class="swatch swatch-clickable" style="background-color:#5E738B"></div></td>
                                    <td><div id="blue-sharp" class="swatch swatch-clickable" style="background-color:#5C9BD1"></div></td>
                                    <td><div id="green" class="swatch swatch-clickable" style="background-color:#32C5D2"></div></td>  
                                    <td><div id="green-sharp" class="swatch swatch-clickable" style="background-color:#2AB4C0"></div></td>
                                </tr><tr>              
                                    <td><div id="green-meadow" class="swatch swatch-clickable" style="background-color:#1BBC9B"></div></td>
                                    <td><div id="green-seagreen" class="swatch swatch-clickable" style="background-color:#1BA39C"></div></td>
                                    <td><div id="green-turquoise" class="swatch swatch-clickable" style="background-color:#36D7B7"></div></td>
                                    <td><div id="green-haze" class="swatch swatch-clickable" style="background-color:#44B6AE"></div></td>
                                    <td><div id="green-jungle" class="swatch swatch-clickable" style="background-color:#26C281"></div></td>
                                    <td><div id="green-soft" class="swatch swatch-clickable" style="background-color:#3FABA4"></div></td>
                                    <td><div id="green-dark" class="swatch swatch-clickable" style="background-color:#4DB3A2"></div></td>                       
                                    <td><div id="yellow-soft" class="swatch swatch-clickable" style="background-color:#C8D046"></div></td>  
                                    <td><div id="yellow" class="swatch swatch-clickable" style="background-color:#C49F47"></div></td>
                                    <td><div id="yellow-haze" class="swatch swatch-clickable" style="background-color:#C5BF66"></div></td>
                                    <td><div id="yellow-mint" class="swatch swatch-clickable" style="background-color:#C5B96B"></div></td>  
                                    <td><div id="yellow-saffron" class="swatch swatch-clickable" style="background-color:#F4D03F"></div></td>
                                </tr><tr> 
                                    <td><div id="yellow-lemon" class="swatch swatch-clickable" style="background-color:#F7CA18"></div></td> 
                                    <td><div id="yellow-crusta" class="swatch swatch-clickable" style="background-color:#F3C200"></div></td>  
                                    <td><div id="yellow-casablanca" class="swatch swatch-clickable" style="background-color:#F2784B"></div></td>
                                    <td><div id="yellow-gold" class="swatch swatch-clickable" style="background-color:#E87E04"></div></td>
                                    <td><div id="red" class="swatch swatch-clickable" style="background-color:#E7505A"></div></td>
                                    <td><div id="red-pink" class="swatch swatch-clickable" style="background-color:#E08283"></div></td>
                                    <td><div id="red-sunglo" class="swatch swatch-clickable" style="background-color:#E26A6A"></div></td>
                                    <td><div id="red-intense" class="swatch swatch-clickable" style="background-color:#E35B5A"></div></td>                          
                                    <td><div id="red-thunderbird" class="swatch swatch-clickable" style="background-color:#D91E18"></div></td>
                                    <td><div id="red-flamingo" class="swatch swatch-clickable" style="background-color:#EF4836"></div></td>
                                    <td><div id="red-soft" class="swatch swatch-clickable" style="background-color:#D05454"></div></td>
                                    <td><div id="red-haze" class="swatch swatch-clickable" style="background-color:#F36A5A"></div></td>                                
                                </tr><tr>       
                                    <td><div id="red-mint" class="swatch swatch-clickable" style="background-color:#E43A45"></div></td>
                                    <td><div id="purple" class="swatch swatch-clickable" style="background-color:#8E44AD"></div></td>
                                    <td><div id="purple-plum" class="swatch swatch-clickable" style="background-color:#8775A7"></div></td>
                                    <td><div id="purple-medium" class="swatch swatch-clickable" style="background-color:#BF55EC"></div></td>
                                    <td><div id="purple-studio" class="swatch swatch-clickable" style="background-color:#8E44AD"></div></td>
                                    <td><div id="purple-wisteria" class="swatch swatch-clickable" style="background-color:#9B59B6"></div></td>
                                    <td><div id="purple-seance" class="swatch swatch-clickable" style="background-color:#9A12B3"></div></td>
                                    <td><div id="purple-sharp" class="swatch swatch-clickable" style="background-color:#796799"></div></td>
                                    <td><div id="purple-soft" class="swatch swatch-clickable" style="background-color:#8877A9"></div></td>
                                </tr>                                     
                            </table>
                            </div>
        </table>

        </ul>
    </div>
    </td>
    </table>
    </div>
@endsection

@section('scripts')
    <script src="{!! url('vendor/jsvalidation/js/jsvalidation.js')!!}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Modules\LabelRequest') !!}

    <script>

        $(".swatch-clickable").click(function() {
            $("#preview").attr('class','swatch bg-' + $(this).attr("id"));
            $("#color").val($(this).attr("id"));
        });
    </script>

@endsection