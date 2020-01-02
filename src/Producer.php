<?php

namespace Popcorn\Beans;

use Exception;
use Popcorn\Beans\Models\QueueTask;
use xobotyi\beansclient\Connection;
use xobotyi\beansclient\BeansClient;
use xobotyi\beansclient\Serializer\JsonSerializer;

class Producer extends BeansClient
{
	protected $tubeName;

	public function __construct(Connection $connection, $tubeName = null)
	{
		parent::__construct($connection, new JsonSerializer());

		if (!is_null($tubeName)) {
			$this->useTube($tubeName);
		}
	}

	/**
	 * Create a task record in mongo
	 *
	 * @param string $taskName
	 * @param array|int $ids
	 * @param array $meta
	 * @return void
	 */
	public function createMongoRecord($taskName, $ids, $meta)
	{
		$qt = new QueueTask(['database' => 'rally-local']);

		$record = [
			'created' => [
				'time' => time(),
			],
			'title' => $meta['title'],
			'task' => $taskName,
			'batch' => $meta['batch'],
			'identifier' => $meta['identifier'],
			'sales_channel' => 'rally-sport-use',
			'arguments' => [$ids],
		];

		try {
			$qt->insertOne($record);
		} catch (Exception $exception) {
			echo $exception->getMessage();
		}

		return 'ok';
	}
}
