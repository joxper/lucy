<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('testing', function() {
    $assigned =         App\Models\Modules\Client::findOrFail(6);

    $users = $assigned->users()->get();



    return ['client' => $assigned,
            'users'  => $users
    ];

});
// Auth...
Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {
    // Native login / logout...
    Route::get('login', 'AuthController@getLogin');
    Route::post('login', 'AuthController@postLogin');
    Route::get('logout', 'AuthController@getLogout');

    // Socialite login...
    Route::get('socialite/redirect/{provider}', 'AuthController@getSocialiteRedirect');
    Route::get('socialite/login/{provider}', 'AuthController@getSocialiteLogin');

    // Register...
    Route::get('register', 'AuthController@getRegister');
    Route::post('register', 'AuthController@postRegister');

    // Activation
    Route::get('activate', 'AuthController@activate');

    // Forgot password...
    Route::get('forgot', 'AuthController@getForgotPassword');
    Route::post('forgot', 'AuthController@postForgotPassword');

    // Reset password...
    Route::get('reset', 'AuthController@getReset');
    Route::post('reset', 'AuthController@postReset');
});

Route::group(['middleware' => 'sentinel_auth'], function () {
    // Dashboard...
    Route::get('/', 'DashboardController@index');

    // Profile...
    Route::get('profile', 'ProfileController@index');
    Route::get('profile/settings', 'ProfileController@settings');
    Route::put('profile/{type}', 'ProfileController@update');

    // Crud Generator
    LucyRoute::get('crud', 'CrudGeneratorController@index', 'crud.view');
    LucyRoute::get('crud/create', 'CrudGeneratorController@create', 'crud.create');
    LucyRoute::post('crud', 'CrudGeneratorController@store', 'crud.create');
    LucyRoute::delete('crud/{id}', 'CrudGeneratorController@destroy', 'crud.delete');

    // Datatables...
    Route::group(['prefix' => 'datatables'], function () {
        LucyRoute::get('permissions', 'Lucy\PermissionController@datatables', 'permissions.view');
        LucyRoute::get('roles', 'Lucy\RoleController@datatables', 'roles.view');
        LucyRoute::get('users', 'Lucy\UserController@datatables', 'users.view');
        LucyRoute::get('crud', 'CrudGeneratorController@datatables', 'crud.view');
    });

    Route::group(['prefix' => 'ajax'], function () {
        LucyRoute::post('crud/columns', 'CrudGeneratorController@columns', 'crud.view');
    });

    Route::group(['prefix' => 'settings', 'namespace' => 'Settings'], function () {
        // General settings...
        LucyRoute::get('general', 'GeneralController@index', 'settings.general');
        LucyRoute::put('general', 'GeneralController@update', 'settings.general');

        // Socialite settings...
        LucyRoute::get('socialite', 'SocialiteController@index', 'settings.socialite');
        LucyRoute::put('socialite/facebook', 'SocialiteController@updateFacebook', 'settings.socialite');
        LucyRoute::put('socialite/google', 'SocialiteController@updateGoogle', 'settings.socialite');
        LucyRoute::put('socialite/twitter', 'SocialiteController@updateTwitter', 'settings.socialite');

        // Mail settings...
        LucyRoute::get('mail', 'MailController@index', 'settings.mail');
        LucyRoute::put('mail', 'MailController@update', 'settings.mail');

        // Authentication settings...
        LucyRoute::get('auth', 'AuthController@index', 'settings.auth');
        LucyRoute::put('auth', 'AuthController@update', 'settings.auth');

        // Registration settings...
        LucyRoute::get('reg', 'RegController@index', 'settings.reg');
        LucyRoute::put('reg', 'RegController@update', 'settings.reg');
    });

    Route::group(['prefix' => 'users-management', 'namespace' => 'Lucy'], function () {
        // Permissions Management...
        LucyRoute::get('permissions', 'PermissionController@index', 'permissions.view');
        LucyRoute::get('permissions/create', 'PermissionController@create', 'permissions.create');
        LucyRoute::post('permissions', 'PermissionController@store', 'permissions.create');
        LucyRoute::get('permissions/{id}', 'PermissionController@show', 'permissions.view');
        LucyRoute::get('permissions/{id}/edit', 'PermissionController@edit', 'permissions.edit');
        LucyRoute::put('permissions/{id}', 'PermissionController@update', 'permissions.edit');
        LucyRoute::delete('permissions/{id}', 'PermissionController@destroy', 'permissions.delete');

        // Roles Management...
        LucyRoute::get('roles', 'RoleController@index', 'roles.view');
        LucyRoute::get('roles/create', 'RoleController@create', 'roles.create');
        LucyRoute::post('roles', 'RoleController@store', 'roles.create');
        LucyRoute::get('roles/{id}', 'RoleController@show', 'roles.view');
        LucyRoute::get('roles/{id}/edit', 'RoleController@edit', 'roles.edit');
        LucyRoute::put('roles/{id}', 'RoleController@update', 'roles.edit');
        LucyRoute::delete('roles/{id}', 'RoleController@destroy', 'roles.delete');

        // Users Management...
        LucyRoute::get('users', 'UserController@index', 'users.view');
        LucyRoute::get('users/create', 'UserController@create', 'users.create');
        LucyRoute::post('users', 'UserController@store', 'users.create');
        LucyRoute::get('users/{id}', 'UserController@show', 'users.view');
        LucyRoute::get('users/{id}/edit', 'UserController@edit', 'users.edit');
        LucyRoute::put('users/{id}', 'UserController@update', 'users.edit');
        LucyRoute::delete('users/{id}', 'UserController@destroy', 'users.delete');

        // Logs...
        LucyRoute::get('logs', 'LogController@index', 'logs.view');
    });
});

// Documentation...
Route::get('docs/{page?}', 'DocsController@show');
