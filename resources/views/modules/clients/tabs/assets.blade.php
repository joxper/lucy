<div class="tab-pane" id="assets">
        @section('table-name', 'Assets List')

        @section('add-link', action('Modules\AssetController@create'))

        @section('table-id', 'assets-table')

        @section('table-th')
            <th class="center-align">ID</th>
            <th class="center-align">Name</th>
        @endsection

        @section('ajax-datatables', action('Modules\ClientController@datatables'))

        @section('datatables-columns')
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
        @endsection

        @include('layouts.listTable')
</div>





