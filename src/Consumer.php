<?php

namespace Popcorn\Beans;

use Popcorn\Beans\Chainable;
use xobotyi\beansclient\Connection;
use xobotyi\beansclient\BeansClient;
use xobotyi\beansclient\Serializer\JsonSerializer;

class Consumer extends BeansClient
{
	/** @var \xobotyi\beansclient\BeansClient */
	protected $beansClient;

	public function __construct(Connection $connection)
	{
		parent::__construct($connection, new JsonSerializer());
	}

	//This function normalizes the output of the statstube command
	public function getJobs($tubeName)
	{
		if (is_array($this->statsTube($tubeName))) {
			return [
				'jobs' 			=> (int) $this->statsTube($tubeName)['total-jobs'],
				'jobs-ready' 	=> (int) $this->statsTube($tubeName)['current-jobs-ready'],
			];
		}
		return [
			'jobs' 			=> 0,
			'jobs-ready' 	=> 0,
		];
	}
}
