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

	//Todo: implement adding custom or default metadata for job payload
	public function with()
	{
		return [
			"metadata" => [
				"key1" => "val1",
			],
		];
	}
}
