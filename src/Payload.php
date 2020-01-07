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
		return array_merge($this->array, $this->with());
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
			],
		];
	}
}
