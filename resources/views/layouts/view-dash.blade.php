@extends('layouts.app')

@section('content')

    <div class="portlet light bordered">
        <div class="portlet-title tabbable-line">
            <ul class="nav nav-tabs" style="float: left;">
            @yield('tabs')
            </ul>           
            <div class="actions">
                @yield('actions')
            </div>
        </div>
        <div class="portlet-body">
                <div class="tab-content">
                    @yield('tab-content')
                </div>
        </div>
    </div>

@endsection