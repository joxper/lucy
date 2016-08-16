<?php

/*
|--------------------------------------------------------------------------
| NotificationTemplates Routes
|--------------------------------------------------------------------------
|
| Here is where all notificationtemplates routes generated by CRUD Generator.
*/

LucyRoute::get('notification_templates', 'Modules\NotificationTemplateController@index', 'notificationtemplates.view');
LucyRoute::get('notification_templates/datatables', 'Modules\NotificationTemplateController@datatables', 'notificationtemplates.view');
LucyRoute::get('notification_templates/create', 'Modules\NotificationTemplateController@create', 'notificationtemplates.create');
LucyRoute::post('notification_templates', 'Modules\NotificationTemplateController@store', 'notificationtemplates.create');
LucyRoute::get('notification_templates/{id}/edit', 'Modules\NotificationTemplateController@edit', 'notificationtemplates.edit');
LucyRoute::put('notification_templates/{id}', 'Modules\NotificationTemplateController@update', 'notificationtemplates.edit');
LucyRoute::get('notification_templates/{id}', 'Modules\NotificationTemplateController@show', 'notificationtemplates.view');
LucyRoute::delete('notification_templates/{id}', 'Modules\NotificationTemplateController@destroy', 'notificationtemplates.delete');
