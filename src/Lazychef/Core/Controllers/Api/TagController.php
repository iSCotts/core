<?php namespace Lazychef\Core\Controllers\Api;

use Lazychef\Core\Controllers\BaseController;

use Response;
use Lazychef\Core\Tag;
use Lazychef\Core\Repositories\PostRepositoryInterface;

class TagController extends BaseController {

	/**
	 * The post repository implementation.
	 *
	 * @var \Lazychef\PostRepositoryInterface  $posts
	 */
	protected $posts;

	/**
	 * Create a new API Tag controller.
	 *
	 * @param PostRepositoryInterface $posts
	 *
	 * @return ApiTagController
	 */
	public function __construct(PostRepositoryInterface $posts)
	{
		parent::__construct();

		$this->posts = $posts;

		$this->beforeFilter('lazychef.auth');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return Response::json($this->posts->allTags());
	}

}
