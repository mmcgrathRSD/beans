<?php

namespace Popcorn\Beans\Models;

use MongoDB\Client as MongoClient;

class Model
{
	protected $database;
	protected $collectionName;

	/**
	 * Grab collection property from extending class and return a collection
	 *
	 * @param array $config
	 * @return void
	 */
	public function __construct(array $config = [])
	{
		if (isset($config['database'])) {
			$this->database = $config['database'];
		} else {
			$this->database = 'localhost';
		}
	}

	/**
	 * Proxy MongoDB\Collection calls to the underlying object
	 *
	 * @param Callable $function
	 * @param array $aruments
	 * @return void
	 */
	public function __call($function, $arguments)
	{
		if (method_exists('MongoDB\Collection', $function)) {
			return call_user_func_array(
				[
					(new MongoClient("mongodb://localhost:27017"))->{$this->database}->{$this->collectionName},
					$function,
				],
				$arguments
			);
		}
	}
}
