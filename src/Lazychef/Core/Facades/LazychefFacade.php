<?php namespace Lazychef\Core\Facades;

use Illuminate\Support\Facades\Facade;

class LazychefFacade extends Facade {

		/**
		 * Get the registered name of the component.
		 *
		 * @return string
		 */
		protected static function getFacadeAccessor() { return 'Lazychef'; }

}
