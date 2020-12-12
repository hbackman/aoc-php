<?php
namespace App\Y2020;

class Day10
{
	private static function getNextAdapter($input, $min, $max)
	{
		sort($input);

		for ($i = 0; $i < count($input); $i++) {

			$val = intval($input[$i]);

			if ($val < $min + 1 ||
					$val > $max) {
				continue;
			}

			return $val;
		}

		return null;
	}

	public static function A($input)
	{
		$input = explode(PHP_EOL, $input);
		$input = array_map(function ($v) {
			return intval($v);
		}, $input);

		$curAdapter = 0;
		$num1Diff 	= 0;
		$num3Diff 	= 0;

		while (true) {
			$newAdapter = self::getNextAdapter(
				$input,
				$curAdapter,
				$curAdapter + 3
			);

			if ($newAdapter - $curAdapter == 1) $num1Diff++;
			if ($newAdapter - $curAdapter == 3) $num3Diff++;

			$curAdapter = $newAdapter;

			if ( ! $curAdapter ) {
				break;
			}
		}

		return $num1Diff * ($num3Diff + 1);
	}

	public static function B($input)
	{

	}
}