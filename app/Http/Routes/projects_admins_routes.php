<?php

/*
|--------------------------------------------------------------------------
| ProjectsAdmins Routes
|--------------------------------------------------------------------------
|
| Here is where all projectsadmins routes generated by CRUD Generator.
*/

LucyRoute::get('projects_admins', 'Modules\ProjectsAdminController@index', 'projectsadmins.view');
LucyRoute::get('projects_admins/datatables', 'Modules\ProjectsAdminController@datatables', 'projectsadmins.view');
LucyRoute::get('projects_admins/create', 'Modules\ProjectsAdminController@create', 'projectsadmins.create');
LucyRoute::post('projects_admins', 'Modules\ProjectsAdminController@store', 'projectsadmins.create');
LucyRoute::get('projects_admins/{id}/edit', 'Modules\ProjectsAdminController@edit', 'projectsadmins.edit');
LucyRoute::put('projects_admins/{id}', 'Modules\ProjectsAdminController@update', 'projectsadmins.edit');
LucyRoute::get('projects_admins/{id}', 'Modules\ProjectsAdminController@show', 'projectsadmins.view');
LucyRoute::delete('projects_admins/{id}', 'Modules\ProjectsAdminController@destroy', 'projectsadmins.delete');
