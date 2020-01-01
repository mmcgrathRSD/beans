<?php

require dirname(__DIR__) . '/vendor/autoload.php';

use Popcorn\Beans\Consumer;
use xobotyi\beansclient\Connection;

//Create a tube for examples
$tubeName = 'newTube';

//Connection to be passed to both types
$connection = new Connection('127.0.0.1', 11300, 2, true);

//Make a consumer
$consumer = new Consumer($connection);

//Change this to whatever you like, timer, cron etc..
while (true) {

	//Check to see if the current jobs is set, and has a value
	if ($consumer->countJobs($tubeName) >= 1) {
		$job = $consumer->watchTube($tubeName)->reserve();

		echo "JobID: {$job->id} \n";
		echo "Job Payload \n";
		echo json_encode($job->payload);
		echo "\n";
		echo "Deleting Job.. \n";
		$job->delete();
	} else {
		echo 'No Jobs!';
	}

	sleep(10);
	echo "\n";
}
