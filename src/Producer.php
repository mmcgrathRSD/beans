<?php

namespace Popcorn\Beans;

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
}
