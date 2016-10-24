@extends('layouts.listTable')

        @section('tabName-devices', 'devices')

        @section('table-name-devices', 'devices List')

        @section('add-link-devices', action('Modules\DeviceController@create'))

        @section('table-id-devices', 'devicesDataTables')

        @section('table-th-assets')
            <th class="center-align">Tag</th>
            <th class="center-align">Name</th>
            <th class="center-align">Serial Number</th>
            <th class="center-align">Category</th>
            <th class="center-align">Label</th>
        @endsection

        @section('ajax-datatables-devices', action('Modules\ClientController@devicesTableService', ['id' => $client['id']]))

        @section('datatables-columns-devices')
            {data: 'tag', name: 'tag'},
            {data: 'name', name: 'name'},
            {data: 'serial', name: 'serial'},
            {data: 'category.name', name: 'category.name'},
            {data: 'label.name', name: 'label.name', class: 'center-align'},
            {data: 'action', name: 'action', class: 'center-align', searchable: false, orderable: false},
        @endsection