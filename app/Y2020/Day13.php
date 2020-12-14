<?php
namespace App\Y2020;

class Day13
{
	public static function A($input)
	{
		[$timestamp, $schedules] = explode(PHP_EOL, $input);

		$timestamp = intval($timestamp);
		$schedules = str_replace('x,', '', $schedules);
		$schedules = explode(',', $schedules);

		$scheduleMap = [];

		foreach ($schedules as $schedule) {
			$departs = (floor($timestamp / $schedule) + 1) * $schedule;
			$waiting = $departs - $timestamp;

			$scheduleMap[$schedule] = $waiting;
		}

		return array_search(min($scheduleMap), $scheduleMap) * min($scheduleMap);
	}

	public static function B($input)
	{
	}
}