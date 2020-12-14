<?php
namespace App\Y2020;

class Day11
{
	private static function getGeneratedMap($input)
	{
		$output = '';

		for ($x = 0; $x < count($input); $x++) {
			for ($y = 0; $y < count($input[$x]); $y++) {
				$output .= $input[$x][$y];
			}
			$output .= PHP_EOL;
		}
		return $output;
	}

	private static function getNumOccupiedSeats($input, $x, $y, $ignoreFloor = false)
	{
		$getFirst = function ($x, $y, $dx, $dy) use($input, $ignoreFloor) {
			while (true) {
				$x += $dx;
				$y += $dy;

				$symbol = $input[$x][$y] ?? null;

				if ($ignoreFloor && $symbol == '.') {
					continue;
				}

				return $symbol;
			}
		};

		$checkSymbol = function ($dx, $dy) use ($x, $y, &$getFirst) {
			return intval($getFirst($x, $y, $dx, $dy) == '#');
		};

		return (
			$checkSymbol(-1, -1) +
			$checkSymbol(-1, +0) +
			$checkSymbol(-1, +1) +

			$checkSymbol(+0, -1) +
			$checkSymbol(+0, +1) +

			$checkSymbol(+1, -1) +
			$checkSymbol(+1, +0) +
			$checkSymbol(+1, +1)
		);
	}

	private static function getNextState($input, $leaveLimit, $includeFloor = false)
	{
		$output = $input;

		for ($x = 0; $x < count($input); $x++) {
			for ($y = 0; $y < count($input[$x]); $y++) {

				if ($input[$x][$y] == '.') {
					continue;
				}

				$numAdjacentOccupied = self::getNumOccupiedSeats($input, $x, $y, $includeFloor);

				if ($input[$x][$y] == 'L') {
					// If there's no adjacent occupied seats, then
					// this seat becomes occupied.
					if ($numAdjacentOccupied <= 0) {
						$output[$x][$y] = '#';
					}
				}

				if ($input[$x][$y] == '#') {
					// If there's more than four occupied seats,
					// then this seat becomes empty.
					if ($numAdjacentOccupied >= $leaveLimit) {
						$output[$x][$y] = 'L';
					}
				}
			}
		}

		return $output;
	}

	public static function A($input)
	{
		$input = explode(PHP_EOL, $input);
		$input = array_map('str_split', $input);

		$isSameState = function ($a, $b) {
			return serialize($a) == serialize($b);
		};

		while (true) {
			$prevState = $nextState ?? $input;
			$nextState = self::getNextState($prevState, 4, false);

			if ($isSameState($prevState, $nextState)) {
				break;
			}
		}

		return substr_count(self::getGeneratedMap($nextState), '#');
	}

	public static function B($input)
	{
		$input = explode(PHP_EOL, $input);
		$input = array_map('str_split', $input);

		$isSameState = function ($a, $b) {
			return serialize($a) == serialize($b);
		};

		while (true) {
			$prevState = $nextState ?? $input;
			$nextState = self::getNextState($prevState, 5, true);

			if ($isSameState($prevState, $nextState)) {
				break;
			}
		}

		return substr_count(self::getGeneratedMap($nextState), '#');
	}
}