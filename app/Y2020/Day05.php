<?php
namespace App\Y2020;

class Day05
{
	private static function calculatePattern($pattern, $max, $lesserChar, $greaterChar)
	{
		$binMax = $max;
		$binMin = 0;

		for ($i = 0; $i < strlen($pattern); $i++) {
			switch ($pattern[$i]) {
				case $lesserChar: 	$binMax = floor( $binMax - ( $binMax - $binMin ) / 2 ); break;
				case $greaterChar: 	$binMin = ceil( $binMin + ( $binMax - $binMin)  / 2 ); break;
			}
		}

		return [$binMin, $binMax];
	}

	private static function calculateIDs($input)
	{
		$lines = explode(PHP_EOL, $input);
		$idlst = [];

		foreach ($lines as $line) {

			$rowInput = substr($line, 0, 7);
			$colInput = substr($line, 7, 3);

			[$rowValue, $_] = self::calculatePattern($rowInput, 127, 'F', 'B');
			[$_, $colValue] = self::calculatePattern($colInput, 7, 'L', 'R');

			$idlst[] = $rowValue * 8 + $colValue;
		}

		return $idlst;
	}

  public static function A($input)
  {
  	return max(self::calculateIDs($input));
  }

  public static function B($input)
  {
  	$ids = self::calculateIDs($input);
  	sort($ids);

  	for ($i = 0; $i < count($ids) - 1; $i++) {
  		if ($ids[$i + 1] - $ids[$i] > 1) {
  			return $ids[$i] + 1;
			}
		}

  	return null;
  }
}