@extends('layouts.listTable')

        @section('tabName-assets', 'assets')

        @section('table-name-assets', 'Assets List')

        @section('add-link-assets', action('Modules\AssetController@create'))

        @section('table-id-assets', 'assetsDataTables')

        @section('table-th-assets')
            <th class="center-align">Tag</th>
            <th class="center-align">Name</th>
            <th class="center-align">Serial Number</th>
            <th class="center-align">Category</th>
            <th class="center-align">Label</th>
        @endsection

        @section('ajax-datatables-assets', action('Modules\ClientController@assetsTableService', ['id' => $client['id']]))

        @section('datatables-columns-assets')
            {data: 'tag', name: 'tag'},
            {data: 'name', name: 'name'},
            {data: 'serial', name: 'serial'},
            {data: 'category.name', name: 'category'},
            {data: 'label.name', name: 'label', class: 'center-align'},
            {data: 'action', name: 'action', class: 'center-align', searchable: false, orderable: false},
        @endsection