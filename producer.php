<?php
require "./vendor/autoload.php";

use Popcorn\Beans\Consumer;
use Popcorn\Beans\Producer;
use xobotyi\beansclient\Connection;

//Connection to be passed to both types
$connection = new Connection('127.0.0.1', 11300, 2, true);

//Make A consumer 
$producer = new Producer($connection);
$producer->useTube('myTube')->put(json_encode(['key' => 'jobs payload']));
