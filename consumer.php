<?php

require "./vendor/autoload.php";

use Popcorn\Beans\Consumer;
use xobotyi\beansclient\Connection;

//Connection to be passed to both types
$connection = new Connection('127.0.0.1', 11300, 2, true);

//Make a consumer
$consumer = new Consumer($connection);


while (true) {
	//Creats a stats tube object, which contains various info about the current jobs (if any)
	$stats = $consumer->statsTube('myTube');

	//Check to see if the current jobs is set, and has a value
	if (
		isset($stats['current-jobs-ready']) &&
		(int) $stats['current-jobs-ready'] > 0
	) {
		$job = $consumer->watchTube('myTube')->reserve();

		echo "JobID: {$job->id} \n";
		echo "Job Payload \n";
		echo $job->payload;
		echo "\n";
		echo "Deleting Job.. \n";
		$job->delete();
	}
}
