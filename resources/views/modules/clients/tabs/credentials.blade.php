    <div class="tab-pane" id="credentials">
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
        {!! $dataTable->table(['style' => 'width: 100%;', 'class' => 'table table-striped table-bordered table-hover table-checkable order-column dataTable no-footer']) !!}

    </div>