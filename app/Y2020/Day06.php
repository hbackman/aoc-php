<?php
namespace App\Y2020;

class Day06
{
	public static function A($input)
	{
		$input = preg_split("#\n\s*\n#Uis", $input);
		$found = 0;

		foreach ($input as $group) {
			$values = str_split($group);
			$values = array_filter(array_map('trim', $values), 'strlen');
			$values = array_values($values);
			$values = array_unique($values);
			$found += count($values);
		}

		return $found;
	}

	public static function B($input)
	{
		$input = preg_split("#\n\s*\n#Uis", $input);
		$found = 0;

		foreach ($input as $group) {

			$groupSize = substr_count($group, PHP_EOL) + 1;
			$groupCount = [];
			$groupChars = str_split($group);

			foreach ($groupChars as $value) {
				if ( trim($value) == "" ) {
					continue;
				}
				$groupCount[$value] = $groupCount[$value] ?? 0;
				$groupCount[$value]++;
			}

			foreach ($groupCount as $key => $count) {
				if ($count >= $groupSize) {
					$found++;
				}
			}
		}

		return $found;
	}
}