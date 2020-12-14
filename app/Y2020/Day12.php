<?php
namespace App\Y2020;

class Day12
{
	private static function values($op)
	{
		$opt = substr($op, 0, 1);
		$val = substr($op, 1, strlen($op) - 1);
		$val = intval($val);

		return [$opt, $val];
	}

	public static function A($input)
	{
		$input = explode(PHP_EOL, $input);

		$d = 270;
		$x = 0;
		$y = 0;

		foreach ($input as $op) {
			[$opt, $val] = self::values($op);

			switch ($opt) {
				case 'N': $y -= $val; break;
				case 'S': $y += $val; break;
				case 'E': $x -= $val; break;
				case 'W': $x += $val; break;

				case 'L': $d -= $val; break;
				case 'R': $d += $val; break;

				case 'F': {
					$x += sin(deg2rad($d)) * $val;
					$y += cos(deg2rad($d)) * $val;
				}
				break;
			}
		}

		return $x + $y;
	}

	public static function B($input)
	{
		$input = explode(PHP_EOL, $input);

		$wpx = -10;
		$wpy = -1;

		$shx = 0;
		$shy = 0;

		$rotate = function ($delta) use(&$wpx, &$wpy, $shx, $shy) {
			if ($delta % 360 < 0) {
				$delta = 360 + $delta;
			}

			switch ($delta) {
				case   0: break;
				case  90: [$wpx, $wpy] = [$wpy, 			$wpx * -1	]; break;
				case 180: [$wpx, $wpy] = [$wpx * -1,	$wpy * -1 ]; break;
				case 270: [$wpx, $wpy] = [$wpy * -1,	$wpx			]; break;
			}
		};

		$move = function ($dist) use (&$wpx, &$wpy, &$shx, &$shy) {
			$shx += $wpx * $dist;
			$shy += $wpy * $dist;
		};

		foreach ($input as $op) {
			[$opt, $val] = self::values($op);

			switch ($opt) {
				case 'N': $wpy -= $val; break;
				case 'S': $wpy += $val; break;
				case 'E': $wpx -= $val; break;
				case 'W': $wpx += $val; break;

				case 'L': $rotate(-$val); break;
				case 'R': $rotate(+$val); break;

				case 'F': $move($val); break;
			}
		}

		return abs($shx) + abs($shy);
	}
}