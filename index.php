<?php

require "./vendor/autoload.php";

use Popcorn\Beans\Consumer;
use xobotyi\beansclient\Connection;

//Connection to be passed to both types
$connection = new Connection('127.0.0.1', 11300, 2, true);

//Make a consumer
$consumer = new Consumer($connection);

$jobs = $consumer->getJobs('myTube');
echo 'Hello';
print_r($jobs);
