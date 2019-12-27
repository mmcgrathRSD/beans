<?php

require "./vendor/autoload.php";

use Popcorn\Beans\Consumer;
use Popcorn\Beans\Payload;
use Popcorn\Beans\Producer;
use xobotyi\beansclient\Connection;

//Connection to be passed to both types
$connection = new Connection('127.0.0.1', 11300, 2, true);

//Make a consumer
$producer = new Producer($connection);
$job = $producer->useTube('myTube')->put(new Payload([1, 2, 3, 4]));
