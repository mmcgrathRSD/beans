<?php

namespace Popcorn\Beans\Models;

use MongoDB\Client as MongoClient;
use Popcorn\Beans\Traits\MetaStampable;

class Model
{
	use MetaStampable;

	protected $database;
	protected $host;
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
		}

		if (isset($config['host'])) {
			$this->host = $config['host'];
		} else {
			$this->host = 'localhost';
		}

		if (isset($config['username']) && isset($config['password'])) {
			$this->username = $config['username'];
			$this->password = $config['password'];
		} else {
			$this->username = null;
			$this->password = null;
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
					(new MongoClient(
						"mongodb://{$this->host}/",
						['username' => "{$this->username}", 'password' => "{$this->password}", 'ssl' => false, 'authSource' => 'admin'],
					))->{$this->database}->{$this->collectionName},
					$function,
				],
				$arguments
			);
		}
	}
}
