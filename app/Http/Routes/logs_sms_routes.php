<?php

/*
|--------------------------------------------------------------------------
| LogsSms Routes
|--------------------------------------------------------------------------
|
| Here is where all logssms routes generated by CRUD Generator.
*/

LucyRoute::get('logs_sms', 'Modules\LogsSmController@index', 'logssms.view');
LucyRoute::get('logs_sms/datatables', 'Modules\LogsSmController@datatables', 'logssms.view');
LucyRoute::get('logs_sms/create', 'Modules\LogsSmController@create', 'logssms.create');
LucyRoute::post('logs_sms', 'Modules\LogsSmController@store', 'logssms.create');
LucyRoute::get('logs_sms/{id}/edit', 'Modules\LogsSmController@edit', 'logssms.edit');
LucyRoute::put('logs_sms/{id}', 'Modules\LogsSmController@update', 'logssms.edit');
LucyRoute::get('logs_sms/{id}', 'Modules\LogsSmController@show', 'logssms.view');
LucyRoute::delete('logs_sms/{id}', 'Modules\LogsSmController@destroy', 'logssms.delete');