<?php namespace Lazychef\Core\Controllers;

use View, Config;
use Lazychef\Core\Repositories\PostRepositoryInterface;

class HomeController extends BaseController {

	/**
	 * The post repository implementation.
	 *
	 * @var Lazychef\PostRepositoryInterface
	 */
	protected $posts;

	/**
	 * Create a new Home controller instance.
	 *
	 * @param PostRepositoryInterface $posts
	 *
	 * @return HomeController
	 */
	public function __construct(PostRepositoryInterface $posts)
	{
		parent::__construct();

		$this->posts = $posts;
	}

	/**
	 * Get the Lazychef index.
	 *
	 * @return Response
	 */
	public function index()
	{
		$posts = $this->posts->active(Config::get('core::lazychef.per_page'));

		return View::make($this->theme.'.index', compact('posts'));
	}

}
