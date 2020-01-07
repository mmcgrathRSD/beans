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


	public function jsonSerialize()
	{
		$payload = [
			'title' => $this->array['title'],
			'parameters' => $this->array['parameters'],
			'sales_channel' => $this->array['sales_channel'],
		];

		return array_merge($payload, $this->with());
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
				"current_time" => time(),
				"task_created" => $this->array['created'],
			],
		];
	}
}
