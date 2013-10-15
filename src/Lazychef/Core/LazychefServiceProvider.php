<?php namespace Lazychef\Core;

use Illuminate\Support\ServiceProvider;
use Config;

class LazychefServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('lazychef/core');
		$this->setConnection();
		$this->bindRepositories();
		$this->bootCommands();

		require __DIR__.'/../../themeHelpers.php';
		require __DIR__.'/../../routes.php';
		require __DIR__.'/../../filters.php';
	}

	/**
	 * Bind repositories.
	 *
	 * @return  void
	 */
	protected function bindRepositories()
	{
		$this->app->singleton('Lazychef\Core\Repositories\PostRepositoryInterface', 'Lazychef\Core\Repositories\DbPostRepository');

		$this->app->singleton('Lazychef\Core\Repositories\UserRepositoryInterface', 'Lazychef\Core\Repositories\DbUserRepository');

		$this->app->bind('Lazychef', function()
		{
			return new \Lazychef\Core\Facades\Lazychef(new Repositories\DbPostRepository);
		});
	}

	protected function bootCommands()
	{
		$this->app['lazychef.console.theme'] = $this->app->share(function($app)
        {
            return new Console\ThemeCommand;
        });
        $this->app['lazychef.console.config'] = $this->app->share(function($app)
        {
            return new Console\ConfigCommand;
        });
        $this->app['lazychef.console.migrate'] = $this->app->share(function($app)
        {
            return new Console\MigrateCommand;
        });
        $this->app['lazychef.console.user'] = $this->app->share(function($app)
        {
            return new Console\UserCommand;
        });

        $this->commands('lazychef.console.theme', 'lazychef.console.config', 'lazychef.console.migrate', 'lazychef.console.user');
	}

	public function register()
	{

	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

	public function setConnection()
	{
		$connection = Config::get('core::database.default');

		if ($connection !== 'default') {
			$lazychefConfig = Config::get('core::database.connections.'.$connection);
		} else {
			$connection = Config::get('database.default');
			$lazychefConfig = Config::get('database.connections.'.$connection);
		}

		Config::set('database.connections.lazychef', $lazychefConfig);
	}

}
