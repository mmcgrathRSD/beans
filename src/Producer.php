<?php

namespace Popcorn\Beans;

use xobotyi\beansclient\Connection;
use xobotyi\beansclient\BeansClient;
use xobotyi\beansclient\Serializer\JsonSerializer;

class Producer extends BeansClient
{
	public function __construct(Connection $connection)
	{
		parent::__construct($connection, new JsonSerializer());
	}
}
