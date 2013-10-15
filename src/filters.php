<?php

Route::filter('lazychef.auth', function()
{
	$auth = Lazychef::getLazychefAuth();

	if ($auth->guest())
	{
		if (Request::ajax()) return Response::make('Unauthorized', 401);

		return Redirect::guest(route('lazychef.admin.login', null, false));
	}
});
