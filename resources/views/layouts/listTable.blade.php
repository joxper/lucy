    <div class="table-toolbar">
        <div class="row">
            <div class="col-md-6">
                <div class="btn-group">
                    @access($createPermission)
                        <a class="btn sbold green" href="@yield('add-link')" title="{{ trans('lucy.word.create') }}"><i class="fa fa-plus fa-fw"></i> {{ trans('lucy.word.create') }}
                        </a>
                    @endaccess
                </div>
            </div>
        </div>
    </div>
    <table id="@yield('table-id')" class="table table-striped table-bordered table-hover table-checkable order-column" data-tables="true">
        <thead>
            <tr>
                @yield('table-th')
                <th width="18%">&nbsp;</th>
            </tr>
        </thead>
    </table>
