<?php

$lazychefControllers = 'Lazychef\Core\Controllers\\';
//Route::get('/login', array('uses' => $lazychefControllers.'LoginController@create', 'as' => 'lazychef.admin.login'));
Route::group(Config::get('core::routes.blog_group_rules'), function() use ($lazychefControllers)
{
	Route::get('/', array('uses' => $lazychefControllers.'HomeController@index', 'as' => 'lazychef.index'));

	Route::get('post/{slug}', array('uses' => $lazychefControllers.'PostController@show', 'as' => 'lazychef.posts.show'));
	Route::get('post/preview/{id}', array('uses' => $lazychefControllers.'PostController@preview', 'as' => 'lazychef.posts.preview'));
	Route::get('tag/{tag}', array('uses' => $lazychefControllers.'PostController@tag', 'as' => 'lazychef.posts.tags'));
	Route::get('archive', array('uses' => $lazychefControllers.'PostController@index', 'as' => 'lazychef.posts.archive'));
        Route::get('about', array('uses' => $lazychefControllers.'PostController@about', 'as' => 'lazychef.posts.about'));

	Route::controller('rss', $lazychefControllers.'RssController');
});

Route::group(Config::get('core::routes.admin_group_rules'), function() use ($lazychefControllers)
{
	Route::get('/', array('uses' => $lazychefControllers.'AdminController@index', 'as' => 'lazychef.admin.index'));
	Route::get('logout', array('uses' => $lazychefControllers.'LoginController@destroy', 'as' => 'lazychef.admin.logout'));
	Route::get('login', array('uses' => $lazychefControllers.'LoginController@create', 'as' => 'lazychef.admin.login'));
	Route::post('login', array('uses' => $lazychefControllers.'LoginController@store'));
});

Route::group(Config::get('core::routes.api_group_rules'), function() use ($lazychefControllers)
{
	Route::get('/', array('as' => 'lazychef.api.index'));
	Route::resource('post', $lazychefControllers.'Api\PostController');
	Route::resource('tag', $lazychefControllers.'Api\TagController');
	Route::resource('user', $lazychefControllers.'Api\UserController');
	Route::controller('dropzone', $lazychefControllers.'Api\DropzoneController');
});

if (Config::get('core::lazychef.handles_404')) {
	App::missing(function($exception)
	{
		View::addLocation(public_path().'/'.Config::get('core::lazychef.theme_dir'));
		return Response::view(theme_view('404'), array(), 404);
	});
}

/**
 * Allows themes complete control to over ride routes or add new ones.
 */

if (file_exists($theme_routes = public_path().'/'.Config::get('core::lazychef.theme_dir').'/'.Config::get('core::lazychef.theme').'/routes.php'))
{
  include $theme_routes;
}
