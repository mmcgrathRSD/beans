<?php

namespace Popcorn\Beans\Models;

use Popcorn\Beans\Models\Model;

class QueueTask extends Model
{
	protected $collectionName = 'queue.tasks';

	public static function make($task, array $parameters, array $data)
	{
		return [
			'created' => self::getDate('now'),
			'title' => $task,
			'parameters' => $parameters,
			'when' => time(),
			'priority' => isset($data['priority']) ? $data['priority'] : null,
			'batch' => $data['batch'],
			'locked_by' => null,
			'locked_at' => null,
			'sales_channel' => $data['sales_channel'],
			'options' => $data,
		];
	}
}
