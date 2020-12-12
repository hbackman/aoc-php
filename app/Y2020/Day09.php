<?php
namespace App\Y2020;

class Day09
{
	private static function isValidSeries($val, $series)
	{
		for ($i = 0; $i < count($series); $i++) {
			for ($j = 0; $j < count($series); $j++) {

				$a = intval($series[$i]);
				$b = intval($series[$j]);

				$sum = $a + $b;

				if ($sum == $val) {
					return true;
				}
			}
		}

		return false;
	}

	private static function getInvalidValue($input)
	{
		for ($i = 1; $i < count($input); $i++) {

			$val = intval($input[$i]);
			$key = intval($i);

			if ($key > 24) {

				$splice = $input;
				$splice = array_splice($splice, $key - 25, 25);

				if ( ! self::isValidSeries($val, $splice) ) {
					return $val;
				}
			}
		}
		return false;
	}

	public static function A($input)
	{
		$input = explode(PHP_EOL, $input);
		$found = self::getInvalidValue($input);
		return $found;
	}

	public static function B($input)
	{
		$input = explode(PHP_EOL, $input);
		$found = self::getInvalidValue($input);

		$length = count($input);

		for ($x = 0; $x < $length; $x++) {
			for ($y = 0; $y < $length; $y++) {

				// We can skip reading the data if we know that
				// the range will be outside of the can.
				if ($x + $y > $length) {
					continue;
				}

				$splice = $input;
				$splice = array_splice($splice, $x, $y);
				$splice = array_map('intval', $splice);

				if (array_sum($splice) != $found) {
					continue;
				}

				return min($splice) + max($splice);
			}
		}

		return false;
	}
}