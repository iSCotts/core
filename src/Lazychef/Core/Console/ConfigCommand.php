<?php namespace Lazychef\Core\Console;

use Config, File;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class ConfigCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'lazychef:cofig';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Publishes the lazychef config.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return void
	 */
	public function fire()
	{
		$this->call('config:publish', array('package' => 'lazychef/core'));
	}
}
