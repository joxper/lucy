@extends('layouts.listTable')

    @section('tabName-licenses', 'licenses')

    @section('table-name-licenses', 'Licenses List')

    @section('add-link-licenses', action('Modules\LicenseController@create'))

    @section('table-id-licenses', 'licensesDataTables')

    @section('table-th-licenses')
        <th class="center-align">Id</th>
        <th class="center-align">Tag</th>
        <th class="center-align">Name</th>
        <th class="center-align">Category</th>
        <th class="center-align">Status</th>
    @endsection

    @section('ajax-datatables-licenses', action('Modules\ClientController@licenseTableService', ['id' => $client['id']]))

    @section('datatables-columns-licenses')
        {data: 'id', name: 'id'},
        {data: 'tag', name: 'tag'},
        {data: 'name', name: 'name'},
        {data: 'category.name', name: 'category.name'},
        {data: 'label.name', name: 'label.name', class: 'center-align'},
        {data: 'action', name: 'action', class: 'center-align', searchable: false, orderable: false},
    @endsection
