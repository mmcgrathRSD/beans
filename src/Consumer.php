<?php

namespace Popcorn\Beans;

use Popcorn\Beans\Payload;
use Popcorn\Beans\Models\QueueTask;
use xobotyi\beansclient\Connection;
use xobotyi\beansclient\BeansClient;
use xobotyi\beansclient\Serializer\JsonSerializer;

class Consumer extends BeansClient
{
	/** @var string $tubename */
	protected $tubeName;

	/** @var \xobotyi\beansclient\BeansClient */
	protected $beansClient;

	/**
	 * Initializes a consumer, requires a xobotyi\beanclient\Connection 
	 * And optionally accepts a tube name (can also be passed in via method injection)
	 *
	 * @param Connection $connection
	 * @param string $tubeName
	 */
	public function __construct(Connection $connection, $tubeName = null)
	{
		parent::__construct($connection, new JsonSerializer());

		$this->tubeName = $tubeName;
	}

	/**
	 * Get normalized information about current jobs in tube
	 *
	 * @param string $tubeName
	 * @return mixed|array
	 */
	public function getJobs($tubeName): array
	{
		if (is_array($this->statsTube($tubeName))) {
			return [
				'jobs' 			=> (int) $this->statsTube($tubeName)['total-jobs'],
				'jobs-ready' 	=> (int) $this->statsTube($tubeName)['current-jobs-ready'],
			];
		}
		return [
			'jobs' 			=> 0,
			'jobs-ready' 	=> 0,
		];
	}

	/**
	 * Get normalized count about jobs in a specific tube
	 *
	 * @param string $tubeName
	 * @return mixed|array
	 */
	public function countJobs($tubeName): int
	{
		if (is_array($this->statsTube($tubeName))) {
			return (int) $this->statsTube($tubeName)['current-jobs-ready'];
		}

		return 0;
	}

	/**
	 * Check to see if there are any new tasks in mongo
	 *
	 * @return mixed|array
	 */
	public function checkForTasks()
	{
		$tasks = [];
		$newTasks = (new QueueTask(['database' => 'rally-local']))->find();

		foreach ($newTasks as $task) {
			$tasks[] = $task;
		}

		return $tasks;
	}

	/**
	 * Accepts all the new tasks from mongo and writes them to the beanstalk queue (tube)
	 *
	 * @param array $tasksCollection
	 * @return void
	 */
	public function process(array $tasksCollection)
	{
		//---- Todo
		//1. Accept the task array as an argument
		//2. Transform data to a Payload Object
		//3. Loop through all tasks, and write them to a tube via a Producer
		foreach ($tasksCollection as $task) {
			$this->useTube($this->tubeName)
				->put(
					new Payload((array) $task)
				);
		}
	}
}
