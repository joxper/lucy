<?php

/*
|--------------------------------------------------------------------------
| Suppliers Routes
|--------------------------------------------------------------------------
|
| Here is where all suppliers routes generated by CRUD Generator.
*/

LucyRoute::get('suppliers', 'Modules\SupplierController@index', 'suppliers.view');
LucyRoute::get('suppliers/datatables', 'Modules\SupplierController@datatables', 'suppliers.view');
LucyRoute::get('suppliers/create', 'Modules\SupplierController@create', 'suppliers.create');
LucyRoute::post('suppliers', 'Modules\SupplierController@store', 'suppliers.create');
LucyRoute::get('suppliers/{id}/edit', 'Modules\SupplierController@edit', 'suppliers.edit');
LucyRoute::put('suppliers/{id}', 'Modules\SupplierController@update', 'suppliers.edit');
LucyRoute::get('suppliers/{id}', 'Modules\SupplierController@show', 'suppliers.view');
LucyRoute::delete('suppliers/{id}', 'Modules\SupplierController@destroy', 'suppliers.delete');
