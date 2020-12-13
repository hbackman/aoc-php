<?php
namespace App\Y2020;

use Exception;

class Day10
{
	private static function getNextAdapters($input, $min, $max)
	{
		sort($input);

		for ($i = 0; $i < count($input); $i++) {

			$val = intval($input[$i]);

			if ($val < $min + 1 ||
					$val > $max) {
				continue;
			}

			yield $i => $val;
		}
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
			$newAdapter = self::getNextAdapters($input, $curAdapter, ($curAdapter + 3));
			$newAdapter = $newAdapter->current();

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
		$input = explode(PHP_EOL, $input);
		$input = array_map('intval', $input);

		sort($input);

		$diffs = [];

		for ($i = 0; $i < count($input); $i++) {
			$prev = $input[$i - 1] ?? 0;
			$next = $input[$i];
			$diffs[$i] = $next - $prev;
		}

		$chunks = [];
		$chunkI = 0;

		for ($i = 0; $i < count($diffs); $i++) {
			if ($diffs[$i] == 3) {
				$chunkI++;
				continue;
			}
			$chunks[$chunkI] = $chunks[$chunkI] ?? 0;
			$chunks[$chunkI]++;
		}

		$values = array_count_values($chunks);

		return (
			(7 ** $values[4]) *
			(4 ** $values[3]) *
			(2 ** $values[2])
		);
	}
}