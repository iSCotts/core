<?php namespace Lazychef\Core\Facades;

use Config, App, View;
use Illuminate\Auth\Guard;
use Illuminate\Auth\EloquentUserProvider;
use Lazychef\Core\Repositories\PostRepositoryInterface;

class Lazychef {

	/**
	 * The post repository implementation.
	 *
	 * @var Lazychef\PostRepositoryInterface
	 */
	protected $postsRepo;

	/**
	 * Create a new lazychef facade instance.
	 *
	 * @param \Lazychef\Facades\Lazychef\PostRepositoryInterface|\Lazychef\Repositories\PostRepositoryInterface $postsRepo
	 *
	 * @return \Lazychef\Facades\Lazychef
	 */
	public function __construct(PostRepositoryInterface $postsRepo)
	{
		$this->postsRepo = $postsRepo;
	}

	/**
	 * Fetch Posts
	 *
	 * @param array $params
	 * @return Posts
	 */
	public function posts($params = array())
	{
		$per_page = isset($params['per_page']) ? $params['per_page'] : Config::get('core::lazychef.per_page');

		return $this->postsRepo->active($per_page);
	}

	/**
	 * Fetch all tags
	 */
	public function tags()
	{
		return $this->postsRepo->allTags();
	}

	public function setupViews()
	{
		View::addLocation(public_path().'/'.Config::get('core::lazychef.theme_dir'));
		foreach (Config::get('core::lazychef.view_dirs') as $dir) {
			View::addLocation($dir);
		}
	}

	public function getLazychefAuth()
	{
		$provider = $this->createEloquentProvider();

		$guard = new Guard($provider, App::make('session.store'));

		$guard->setCookieJar(App::make('cookie'));

		return $guard;
	}

	protected function createEloquentProvider()
	{
		$model = 'Lazychef\Core\Models\User';

		return new EloquentUserProvider(App::make('hash'), $model);
	}

}
