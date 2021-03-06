<?php

/*
|--------------------------------------------------------------------------
| Licenses Routes
|--------------------------------------------------------------------------
|
| Here is where all licenses routes generated by CRUD Generator.
*/

LucyRoute::get('licenses', 'Modules\LicenseController@index', 'licenses.view');
LucyRoute::get('licenses/datatables', 'Modules\LicenseController@datatables', 'licenses.view');
LucyRoute::get('licenses/create', 'Modules\LicenseController@create', 'licenses.create');
LucyRoute::post('licenses', 'Modules\LicenseController@store', 'licenses.create');
LucyRoute::get('licenses/{id}/edit', 'Modules\LicenseController@edit', 'licenses.edit');
LucyRoute::put('licenses/{id}', 'Modules\LicenseController@update', 'licenses.edit');
LucyRoute::get('licenses/{id}', 'Modules\LicenseController@show', 'licenses.view');
LucyRoute::delete('licenses/{id}', 'Modules\LicenseController@destroy', 'licenses.delete');
