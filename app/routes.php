<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/** ------------------------------------------
 *  Route model binding
 *  ------------------------------------------
 */
Route::model('user', 'User');
Route::model('comment', 'Comment');
Route::model('post', 'Post');
Route::model('operadora', 'Operadora');
Route::model('resp', 'Resp');
Route::model('admin', 'Admin');
Route::model('representante', 'Representante');
Route::model('role', 'Role');
Route::model('balancete', 'Lancamento');

/** ------------------------------------------
 *  Route constraint patterns
 *  ------------------------------------------
 */
Route::pattern('comment', '[0-9]+');
Route::pattern('post', '[0-9]+');
Route::pattern('user', '[0-9]+');
Route::pattern('role', '[0-9]+');
Route::pattern('token', '[0-9a-z]+');

/** ------------------------------------------
 *  Admin Routes
 *  ------------------------------------------
 */
Route::group(array('prefix' => 'admin', 'before' => 'auth'), function()
{

    # Comment Management
    Route::get('comments/{comment}/edit', 'AdminCommentsController@getEdit');
    Route::post('comments/{comment}/edit', 'AdminCommentsController@postEdit');
    Route::get('comments/{comment}/delete', 'AdminCommentsController@getDelete');
    Route::post('comments/{comment}/delete', 'AdminCommentsController@postDelete');
    Route::controller('comments', 'AdminCommentsController');

    /*# Blog Management
    Route::get('blogs/{post}/show', 'AdminBlogsController@getShow');
    Route::get('blogs/{post}/edit', 'AdminBlogsController@getEdit');
    Route::post('blogs/{post}/edit', 'AdminBlogsController@postEdit');
    Route::get('blogs/{post}/delete', 'AdminBlogsController@getDelete');
    Route::post('blogs/{post}/delete', 'AdminBlogsController@postDelete');
    Route::controller('blogs', 'AdminBlogsController');*/

    # Operadora Management
    Route::get( 'operadoras/{operadora}/exibir', 'AdminOperadorasController@getShow');
    Route::get( 'operadoras/{operadora}/editar', 'AdminOperadorasController@getEdit');
    Route::post('operadoras/{operadora}/editar', 'AdminOperadorasController@postEdit');
    Route::get('operadoras/{operadora}/remover', 'AdminOperadorasController@getDelete');
    Route::post('operadoras/{operadora}/remover','AdminOperadorasController@postDelete');
    Route::controller('operadoras',         'AdminOperadorasController');

    Route::controller('xml',         'AdminXmlController');

    # Representante Management
    Route::get( 'representantes/{representante}/exibir', 'AdminRepresentantesController@getShow');
    Route::get( 'representantes/{representante}/editar', 'AdminRepresentantesController@getEdit');
    Route::post('representantes/{representante}/editar', 'AdminRepresentantesController@postEdit');
    Route::get('representantes/{representante}/remover', 'AdminRepresentantesController@getDelete');
    Route::post('representantes/{representante}/remover','AdminRepresentantesController@postDelete');
    Route::controller('representantes',         'AdminRepresentantesController');

    # Responsáveis Management
    Route::get( 'resps/{resp}/exibir', 'AdminRespsController@getShow');
    Route::get( 'resps/{resp}/editar', 'AdminRespsController@getEdit');
    Route::post('resps/{resp}/editar', 'AdminRespsController@postEdit');
    Route::get( 'resps/{resp}/delete', 'AdminRespsController@getDelete');
    Route::post('resps/{resp}/delete','AdminRespsController@postDelete');
    Route::controller('resps',         'AdminRespsController');

    # Balancetes Management
    Route::get( 'balancetes/{balancete}/exibir', 'AdminBalancetesController@getShow');
    Route::get( 'balancetes/{balancete}/editar', 'AdminBalancetesController@getEdit');
    Route::post('balancetes/{balancete}/editar', 'AdminBalancetesController@postEdit');
    Route::get( 'balancetes/{balancete}/delete', 'AdminBalancetesController@getDelete');
    Route::post('balancetes/{balancete}/delete', 'AdminBalancetesController@postDelete');
    Route::controller('balancetes',         'AdminBalancetesController');

    # Admin Management
    Route::get( 'admins/{admin}/exibir', 'AdminAdminsController@getShow');
    Route::get( 'admins/{admin}/editar', 'AdminAdminsController@getEdit');
    Route::post('admins/{admin}/editar', 'AdminAdminsController@postEdit');
    Route::get('admins/{admin}/delete', 'AdminAdminsController@getDelete');
    Route::post('admins/{admin}/delete','AdminAdminsController@postDelete');
    Route::controller('admins',         'AdminAdminsController');

    # User Management
    Route::get('users/{user}/show', 'AdminUsersController@getShow');
    Route::get('users/{user}/edit', 'AdminUsersController@getEdit');
    Route::post('users/{user}/edit', 'AdminUsersController@postEdit');
    Route::get('users/{user}/delete', 'AdminUsersController@getDelete');
    Route::post('users/{user}/delete', 'AdminUsersController@postDelete');
    Route::controller('users', 'AdminUsersController');

    # User Role Management
    Route::get('roles/{role}/show', 'AdminRolesController@getShow');
    Route::get('roles/{role}/edit', 'AdminRolesController@getEdit');
    Route::post('roles/{role}/edit', 'AdminRolesController@postEdit');
    Route::get('roles/{role}/delete', 'AdminRolesController@getDelete');
    Route::post('roles/{role}/delete', 'AdminRolesController@postDelete');
    Route::controller('roles', 'AdminRolesController');

    # Admin Dashboard
    Route::controller('/', 'AdminDashboardController');
});


/** ------------------------------------------
 *  Frontend Routes
 *  ------------------------------------------
 */


// User reset routes
Route::get('user/reset/{token}', 'UserController@getReset');
// User password reset
Route::post('user/reset/{token}', 'UserController@postReset');
//:: User Account Routes ::
Route::post('user/{user}/edit', 'UserController@postEdit');

//:: User Account Routes ::
Route::post('user/login', 'UserController@postLogin');

# User RESTful Routes (Login, Logout, Register, etc)
Route::controller('user', 'UserController');

//:: Application Routes ::

# Filter for detect language
Route::when('contact-us','detectLang');

# Contact Us Static Page
Route::get('contact-us', function()
{
    // Return about us page
    return View::make('site/contact-us');
});

# Posts - Second to last set, match slug
Route::get('{postSlug}', 'BlogController@getView');
Route::post('{postSlug}', 'BlogController@postView');


Route::get('cidades/{estado}', 'EnderecoController@getCidades');

# Index Page - Last route, no matches
Route::get('/', array('before' => 'detectLang','uses' => 'BlogController@getIndex'));
