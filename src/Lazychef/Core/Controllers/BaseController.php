<?php namespace Lazychef\Core\Controllers;

use Controller, Config, View, Validator, Lazychef;

class BaseController extends Controller {

	/**
	 * The default theme used by the blog.
	 *
	 * @var string
	 */
	protected $theme = 'default';

	protected $auth = 'default';

	/**
	 * Create the base controller instance.
	 *
	 * @return BaseController
	 */
	public function __construct()
	{
		$this->auth = Lazychef::getLazychefAuth();

		$this->theme = Config::get('core::lazychef.theme');

		Lazychef::setupViews();

		$presence = Validator::getPresenceVerifier();
		$presence->setConnection('lazychef');

		// Redirect to /install if in framework and not installed
		if (Config::get('core::lazychef.in_framework') === true) {

			if (Config::get("core::lazychef.installed") !== true)
			{
				header('Location: install');
				exit;
			}
		}
	}

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

}
