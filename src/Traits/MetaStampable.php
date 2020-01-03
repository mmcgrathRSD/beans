<?php

namespace Popcorn\Beans\Traits;


trait MetaStampable
{
	/**
	 * Converts a datetime string into an array of useful info
	 * great for storing in a Mongo document when you need to write very specific reports
	 * 
	 * Modeled after https://github.com/sporkd/\MongoDB\BSON\ObjectID-metastamp
	 * 
	 * @param datetime $time
	 */
	public static function getDate($time)
	{
		$time = trim($time);

		if (is_numeric($time)) {
			$strtotime = $time;
		} else {
			$strtotime = strtotime($time);
		}

		$array = array(
			'time' => (int) $strtotime,
			'ttl' =>  new \MongoDB\BSON\UTCDateTime(),
			'local' => date('Y-m-d H:i:s', $strtotime),
			'utc' => gmdate('Y-m-d H:i:s', $strtotime),
			'offset' => date('P', $strtotime)
		) + getdate($strtotime);

		unset($array['weekday']);
		unset($array['month']);
		unset($array[0]);

		return $array;
	}
}
