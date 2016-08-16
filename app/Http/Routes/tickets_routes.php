<?php

/*
|--------------------------------------------------------------------------
| Tickets Routes
|--------------------------------------------------------------------------
|
| Here is where all tickets routes generated by CRUD Generator.
*/

LucyRoute::get('tickets', 'Modules\TicketController@index', 'tickets.view');
LucyRoute::get('tickets/datatables', 'Modules\TicketController@datatables', 'tickets.view');
LucyRoute::get('tickets/create', 'Modules\TicketController@create', 'tickets.create');
LucyRoute::post('tickets', 'Modules\TicketController@store', 'tickets.create');
LucyRoute::get('tickets/{id}/edit', 'Modules\TicketController@edit', 'tickets.edit');
LucyRoute::put('tickets/{id}', 'Modules\TicketController@update', 'tickets.edit');
LucyRoute::get('tickets/{id}', 'Modules\TicketController@show', 'tickets.view');
LucyRoute::delete('tickets/{id}', 'Modules\TicketController@destroy', 'tickets.delete');