<?php

require "./vendor/autoload.php";

use Popcorn\Beans\Payload;
use Popcorn\Beans\Consumer;
use Popcorn\Beans\Producer;
use xobotyi\beansclient\Connection;

//Beans Client Connection Object
$connection = new Connection('127.0.0.1', 11300, 2, true);

//--Consumer Example
$consumer = new Consumer($connection);
echo gettype($consumer->countJobs('myTube'));
//--Producer Example
// $producer = new Producer($connection);
//$job = $producer->useTube('myTube')->put(new Payload([1, 2, 3, 4]));
