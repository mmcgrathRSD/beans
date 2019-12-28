<?php

require "./vendor/autoload.php";

use Popcorn\Beans\Task;
use Popcorn\Beans\Payload;
use Popcorn\Beans\Consumer;
use Popcorn\Beans\Producer;
use Popcorn\Beans\Models\Product;
use xobotyi\beansclient\Connection;

//Beans Client Connection Object
$connection = new Connection('127.0.0.1', 11300, 2, true);

//--Consumer Example
// $consumer = new Consumer($connection);
// echo gettype($consumer->countJobs('myTube'));


//--Producer Example
// $producer = new Producer($connection, 'myTube');
// $job = $producer->put(new Payload([1, 2, 3, 4]));

// var_dump($producer->statsTube('myTube'));
$config = [
	'database' => 'rally-local',
];

$product = new Product($config);
var_dump($product->count());
