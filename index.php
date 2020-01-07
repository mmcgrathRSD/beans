<?php

require "./vendor/autoload.php";

use Popcorn\Beans\Models\QueueTask;
use Popcorn\Beans\Payload;
use Popcorn\Beans\Consumer;
use Popcorn\Beans\Producer;
use Popcorn\Beans\Models\Product;
use xobotyi\beansclient\Connection;

//Beans Client Connection Object
$connection = new Connection('127.0.0.1', 11300, 2, true);
$consumer = new Consumer($connection, 'newTube');
$newTasks = $consumer->checkForTasks();

//--Consumer Example
// $consumer = new Consumer($connection, 'newTube');
// $newTasks = $consumer->checkForTasks();
// $consumer->process($newTasks);
//--Producer Example
// $producer = new Producer($connection, 'myTube');
// $job = $producer->put(new Payload(['payload_key' => 'payload_val']));

// $product = (new Product($config))->findOne([
// 	'_id' => new MongoDB\BSON\ObjectId('55ae5452caae525c138b48e7'),
// ]);

// $queueTask = new QueueTask($config);

// $insertOneResult = $queueTask->insertOne([
// 	'created' => [
// 		'time' => time(),
// 	],
// 	'title' => '',
// 	'task' => '\Search\Models\Algolia\BoomiOrders::syncMyOrders',
// 	'batch' => 'testing',
// 	'sales_channel' => 'rally-sport-use',
// 	'arguments' => [
// 		'product_id' => $product->_id,
// 	],
// ]);

// var_dump($insertOneResult);

// var_dump($producer->statsTube('myTube'));

// $product = new Product($config);
// var_dump($product->count());
