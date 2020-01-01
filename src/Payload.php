<?php

namespace Popcorn\Beans;

use JsonSerializable;

class Payload implements JsonSerializable
{
	protected $array;

	public function __construct(array $array)
	{
		$this->array = $array;
	}

	//Todo: implement array merging metadata via with method
	public function jsonSerialize()
	{
		return array_merge($this->array, $this->with());
	}

	public function toArray()
	{
		return [
			'_id' => new \MongoDB\BSON\ObjectID,
			'params' => [
				'product_id' => $this->array[0]['_id'],
			],
			'task' => 'Some\Namespaced\Task::callIt'
		];
	}

	//Todo: implement adding custom or default metadata for job payload
	/**
	 * Add meta data to the payload
	 *
	 * @param array $meta
	 * @return array
	 */
	public function with(array $meta = [])
	{
		return [
			"metadata" => [
				"time" => time(),
			],
		];
	}
}
