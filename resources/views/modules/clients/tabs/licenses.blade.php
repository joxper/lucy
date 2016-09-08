@extends('layouts.listTable')

    @section('tabName-licenses', 'licenses')

    @section('table-name-licenses', 'Assets List')

    @section('add-link-licenses', action('Modules\LicenseController@create'))

    @section('table-id-licenses', 'licensesDataTables')

    @section('table-th-licenses')
        <th class="center-align">Id</th>
        <th class="center-align">Username</th>
        <th class="center-align">FirstName</th>
        <th class="center-align">LastName</th>
    @endsection

    @section('ajax-datatables-licenses', action('Modules\ClientController@usersTableService', ['id' => $client['id']]))

    @section('datatables-columns-licenses')
        {data: 'id', name: 'id'},
        {data: 'username', name: 'username'},
        {data: 'first_name', name: 'first_name'},
        {data: 'last_name', name: 'last_name'},
        {data: 'action', name: 'action', class: 'center-align', searchable: false, orderable: false},
    @endsection