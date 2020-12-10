<?php
namespace App\Y2020;

class Day08
{
	private static function getParsedInstruction(string $instruction)
	{
		$ins = substr($instruction, 0, 3);
		$val = substr($instruction, 3, strlen($instruction) - 3);

		return [$ins, $val];
	}

	private static function isValidBootSequence(array $input, &$acc = 0)
	{
		$ops = [];
		$loc = 0;

		while ( ! array_key_exists($loc, $ops) ) {
			$ops[$loc] = true;

			[ $ins, $val ] = self::getParsedInstruction($input[$loc]);

			switch ($ins) {
				case 'jmp': $loc += intval($val); break;
				case 'acc': $acc += intval($val);
				case 'nop':
					$loc++;
			}

			// Program terminated successfully
			if ( ! array_key_exists($loc, $input) ) {
				return true;
			}
		}

		return false;
	}

	private static function getCorrectedInstruction($ins)
	{
		switch (substr($ins, 0, 3)) {
			case 'jmp': return str_replace('jmp', 'nop', $ins);
			case 'nop': return str_replace('nop', 'jmp', $ins);
		}
		return $ins;
	}

	public static function A($input)
	{
		$input = explode(PHP_EOL, $input);
		$found = 0;

		self::isValidBootSequence($input, $found);

		return $found;
	}

	public static function B($input)
	{
		$input = explode(PHP_EOL, $input);

		for ($i = 0; $i < count($input); $i++) {
			[$ins, $_] = self::getParsedInstruction($input[$i]);

			$acc = 0;

			if ($ins == 'jmp' || $ins == 'nop') {
				$newInput = $input;
				$newInput[$i] = self::getCorrectedInstruction($newInput[$i]);

				if (self::isValidBootSequence($newInput, $acc)) {
					return $acc;
				}
			}
		}

		return 0;
	}
}