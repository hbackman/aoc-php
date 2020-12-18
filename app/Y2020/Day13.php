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
    $schedules = explode(PHP_EOL, $input)[1];
    $schedules = explode(',', $schedules);

	  $inc = (int)$schedules[0];
	  $cur = 0;

	  for ($t = 1; $t < count($schedules); $t++) {
	    // There's no restrictions of "x" schedules
	    if ($schedules[$t] == 'x') {
	      continue;
      }

	    $first = 0;

	    while (true) {
	      $bus = (int)$schedules[$t];
	      // If the carry + the position is divisible
        // by the schedule, then we might've found
        // our answer.
	      if ( ($cur + $t) % $bus == 0) {

	        if ($first == 0) {
	          // If we've reached the loop limit, then
            // we have found our answer.
	          if ($t == count($schedules) - 1) {
	            break;
            }

	          // Our first value becomes the current
            // incremental value.
	          $first = $cur;
          }
	        else {
	          $inc = $cur - $first;
	          break;
          }
        }

	      $cur += $inc;
      }
    }

	  return $cur;
	}
}